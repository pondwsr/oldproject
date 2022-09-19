<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

    private $member = 'member';
	
	function get_website_list() {
        $query = $this->db->get($this->member);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    function get_website($id) {
        $query = $this->db->get_where($this->bookings, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
	
	function add_website($member_name,$member_password,$member_tel) {
        $data = array('name' => $member_name, 'password' => $member_password , 'tel' => $member_tel);
        $this->db->insert($this->member, $data);
    }
   public function searchuserlogin($user,$pass){
    $sql = "select email , password  from member where email = '".$user."' and password = '".$pass."'";
    $result = $this->db->query($sql);

    if($result->result()){
            $status = true;
    }else{
            $status = false;
    }
    
    $rs = [
    'status' => $status,
    'data' => $result->result()
    ];
    return $rs;
    
}

}