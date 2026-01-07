<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Food_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// Fetch all food items
	public function getFood() {
		$data = $this->db->get('food');
		return $data->result_array();
	}

	// // Fetch a single food item by ID
	// public function get_food_by_id($id) {
	// 	$query = $this->db->get_where('foods', array('id' => $id));
	// 	return $query->row_array();
	// }

	// // Add a new food item
	// public function add_food($data) {
	// 	return $this->db->insert('foods', $data);
	// }

	// // Update an existing food item
	// public function update_food($id, $data) {
	// 	$this->db->where('id', $id);
	// 	return $this->db->update('foods', $data);
	// }

	// // Delete a food item
	// public function delete_food($id) {
	// 	$this->db->where('id', $id);
	// 	return $this->db->delete('foods');
	// }
}

?>
