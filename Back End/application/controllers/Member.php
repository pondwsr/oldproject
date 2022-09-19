<?php

defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	
	exit;
}

//required for REST API
require(APPPATH . '/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Member extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('member_model', 'wm');
    }
	
	function members_get() {
        $members = $this->wm->get_member_list();

        if ($members) {
            $this->response($members, 200);
        } else {
            $this->response(array(), 200);
        }
    }


 function member_login_get()
    {
        $result = $this->wm->login_member($_POST['email'], $_POST['password']);
        echo json_encode($result);
    }

   function member_get() {
        if (!$this->get('id')) { //query parameter, example, members?id=1
            $this->response(NULL, 400);
        }

        $member = $this->wm->get_member($this->get('id'));

        if ($member) {
            $this->response($member, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	  public function login_member_post(){
   
         $member_email = $this->post('email');
         $member_password = $this->post('password');
	
        
        $result = $this->wm->login_member($member_email,$member_password);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
        
    }
	
	function add_member_post() {
        $member_name = $this->post('name');
        $member_email = $this->post('email');
        $member_password = $this->post('password');
        $member_tel = $this->post('tel');
        
        $result = $this->wm->add_member($member_name, $member_email,$member_password,$member_tel);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    function update_member_put() {
        $member_name = $this->post('name');
        $member_email = $this->post('email');
        $member_password = $this->post('password');
        $member_tel = $this->post('tel');

        $result = $this->wm->update_member($member_name, $member_email,$member_password,$member_tel);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
	function delete_member_delete($member_id) { //path parameter, example, /delete/1

        $result = $this->wm->delete_member($member_id);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }


	
}