<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Food extends REST_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Food_model');
	}

	function index_get() {
		$data = $this->Food_model->getFood();
		$result = $data;
		$this->response($result, REST_Controller::HTTP_OK);
	}
}

?>
