<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class product_model extends CI_Model {

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
	
	function add_product($product_name, $product_des, $product_price, $product_cate_id, $product_qty, $product_waranty, $product_img_id) {
        $data = array('name' => $product_name, 'des' => $product_des, 'price' => $product_price, 'cate_id' => $product_cate_id, 'qty' => $product_qty, 'waranty'=> $product_waranty, 'img_id' => $product_img_id);
        $this->db->insert($this->product, $data);
    }

    function update_product($product_id, $product_name, $product_des, $product_price, $product_cate_id, $product_qty, $product_waranty, $product_img_id) {
        $data = array('name' => $product_name, 'des' => $product_des, 'price' => $product_price, 'cate_id' => $product_cate_id, 'qty' => $product_qty, 'waranty'=> $product_waranty, 'img_id' => $product_img_id);
        $this->db->where('id', $product_id);
        $this->db->update($this->product, $data);
    }
	
	function delete_product($product_id) {
        $this->db->where('id', $product_id);
        $this->db->delete($this->product);
    }

}