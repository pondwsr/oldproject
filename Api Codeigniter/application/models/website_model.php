<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    private $product = 'product';
	
	function get_product_list() {
        $query = $this->db->get($this->product);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function get_product($id) {
        $query = $this->db->get_where($this->product, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
	
	function add_product($product_title, $product_url) {
        $data = array('title' => $product_title, 'url' => $product_url);
        $this->db->insert($this->product, $data);
    }

    function update_product($product_id, $product_title, $product_url) {
        $data = array('title' => $product_title, 'url' => $product_url);
        $this->db->where('id', $product_id);
        $this->db->update($this->product, $data);
    }
	
	function delete_product($product_id) {
        $this->db->where('id', $product_id);
        $this->db->delete($this->product);
    }

}