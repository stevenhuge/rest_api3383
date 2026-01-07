<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Account extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('account_model');
    }

    // ... fungsi index_post biarkan tetap ...

    public function index_put() {
        // PERBAIKAN: Gunakan $this->put() untuk method PUT
        $username = $this->put('username');
        $name     = $this->put('name');
        $level    = $this->put('level');
        $password = $this->put('password');

        $validasi_message = [];

        if (empty($username)) {
            array_push($validasi_message, 'Username is required');
        }

        if (!empty($username) && !filter_var($username, FILTER_VALIDATE_EMAIL)) {
            array_push($validasi_message, 'Username must be a valid email address');
        }

        if (empty($name)) {
            array_push($validasi_message, 'Name is required');
        }

        if (empty($level)) {
            array_push($validasi_message, 'Level is required');
        }

        if (empty($password)) {
            array_push($validasi_message, 'Password is required');
        }

        if (count($validasi_message) > 0) {
            $output = array(
                'success' => false,
                'message' => 'Update data failed, data not valid',
                'data' => $validasi_message
            );
            $this->response($output, REST_Controller::HTTP_OK);
        } else {
            // Data untuk diupdate
            $data = array(
                'name'     => $name,
                'level'    => $level,
                'password' => md5($password) // Pastikan enkripsi sama dengan saat register
            );

            // Eksekusi Update
            $this->db->where('username', $username);
            $update = $this->db->update('account', $data);

            if ($update) {
                $output = array(
                    'success' => true,
                    'message' => 'Update data success',
                    'data'    => $data
                );
            } else {
                $output = array(
                    'success' => false,
                    'message' => 'Database update failed',
                    'data'    => null
                );
            }

            $this->response($output, REST_Controller::HTTP_OK);
        }
    }
}
