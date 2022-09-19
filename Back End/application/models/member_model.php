<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

    private $member = 'member';
	
	function get_member_list() {
        $query = $this->db->get($this->member);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function get_member($id) {
        $query = $this->db->get_where($this->member, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
	
	 function login_member($member_email, $member_password)
    {
        $sql = "SELECT *
        FROM member
        WHERE email='" . $member_email . "'
        AND password ='" . $member_password . "' ";

        $query = $this->db->query($sql);
        $result = $query->result();
        $rows = count($query->result());
        if ($rows > 0) {
            return $result;
        } else {
            return $rs = array([
                "name" => "",
                "email" => "",
                "tel" => "",
            ]);
        }

    }

	
	

	
	function add_member($member_name, $member_email , $member_password  , $member_tel) {
        $data = array('name' => $member_name, 'email' => $member_email,  'tel' => $member_tel , 'password' => $member_password);
        $this->db->insert($this->member, $data);
    }

    function update_member($member_name, $member_email , $member_password  , $member_tel) {
       $data = array('name' => $member_name, 'email' => $member_email,  'tel' => $member_tel , 'password' => $member_password);
        $this->db->where('id', $member_id);
        $this->db->update($this->member, $data);
    }
	
	function delete_member($member_id) {
        $this->db->where('id', $member_id);
        $this->db->delete($this->member);
    }

}