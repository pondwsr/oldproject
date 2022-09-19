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

class Booking extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('booking_model', 'wm');
    }
	
	function bookings_get() {
        $bookings = $this->wm->get_booking_list();

        if ($bookings) {
            $this->response($bookings, 200);
        } else {
            $this->response(array(), 200);
        }
    }

    function booking_get() {
        if (!$this->get('id')) { //query parameter, example, websites?id=1
            $this->response(NULL, 400);
        }

        $booking = $this->wm->get_booking($this->get('id'));

        if ($booking) {
            $this->response($booking, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	function add_booking_post() {
        $booking_cus = $this->post('cus');
        $booking_date = $this->post('date');
		$booking_breakdown = $this->post('breakdown');
		$booking_name = $this->post('name');
		$booking_status = $this->post('status');
		$booking_breakdowntech = $this->post('breakdowntech');
		$booking_price = $this->post('price');
		$booking_tech = $this->post('tech');
        
        $result = $this->wm->add_booking($booking_cus, $booking_date, $booking_breakdown,$booking_name,$booking_status,$booking_breakdowntech,$booking_price,$booking_tech);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }



    function update_booking_put() {
        $booking_cus = $this->post('cus');
        $booking_date = $this->post('date');
		$booking_breakdown = $this->post('breakdown');
		$booking_name = $this->post('name');
		$booking_status = $this->post('status');

        $result = $this->wm->update_booking($booking_cus, $booking_date, $booking_breakdown,$booking_name,$booking_status);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
	function delete_booking_delete($booking_id) { //path parameter, example, /delete/1

        $result = $this->wm->delete_booking($booking_id);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
}