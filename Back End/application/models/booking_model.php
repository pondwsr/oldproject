<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    private $booking = 'booking';
	
	function get_booking_list() {
        $query = $this->db->get($this->booking);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function get_booking($id) {
        $query = $this->db->get_where($this->booking, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
	
    
	function add_booking($booking_cus, $booking_date,$booking_breakdown,$booking_name,$booking_status,$booking_breakdowntech,$booking_price,$booking_tech) {
        $data = array('cus' => $booking_cus, 'date' => $booking_date , 'breakdown' => $booking_breakdown , 'name' => $booking_name , 'status' => $booking_status, 'breakdowntech' => $booking_breakdowntech, 'price' => $booking_price, 'tech' => $booking_tech);
        $this->db->insert($this->booking, $data);
    }
	
    function update_booking($booking_date,$booking_breakdown,$booking_name) {
          $data = array('cus' => $booking_cus, 'date' => $booking_date , 'breakdown' => $booking_breakdown , 'name' => $booking_name , 'status' => $booking_status);
        $this->db->where('id', $booking_id);
        $this->db->update($this->booking, $data);
    }
	
	function delete_booking($booking_id) {
        $this->db->where('id', $booking_id);
        $this->db->delete($this->booking);
    }

}