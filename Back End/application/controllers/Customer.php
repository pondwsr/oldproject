<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct() { 
	
         parent::__construct(); 
	 
         //เรียกใช้งาน Customer_Model	 
	 $this->load->model('Customer_Model');

	 //เรียกใช้งาน Class helper	 
         $this->load->helper('url'); 
		 
	  $this->load->helper('form');

	 //เรียกใช้งาน Class database	 
         $this->load->database(); 
    } 
        //แสดงข้อมูล Customer ทั้งหมด     
	public function index()
	{
		$query = $this->db->get("customer"); 
		 
                $data['result'] = $query->result(); 
		
		$this->load->view('header');
		
		$this->load->view('customer/customer_data',$data);
		
		$this->load->view('footer');
	}

	public function add_customer_form(){
		
		$this->load->view('header');
		
		$this->load->view('customer/customer_add_form');
		
		$this->load->view('footer');
	}
	
	public function save_customer(){
		
	$data = array( 
            'first_name' => $this->input->post('first_name'), 
            'last_name' => $this->input->post('last_name') 
         ); 
			
         $this->Customer_Model->insert($data); 
		
		 redirect('customer/index');
	}
	
	public function edit_customer_form(){
		
		 $id = $this->uri->segment('3'); 
		 
		 $data['result'] = $this->Customer_Model->selectOne($id);
		 
		 $this->load->view('header');
		 
         $this->load->view('customer/customer_edit_form',$data);
		 
		 $this->load->view('footer');
		
	}
	
	public function save_edit_customer(){
		
		 $data = array( 
            'first_name' => $this->input->post('first_name'), 
            'last_name' => $this->input->post('last_name'),
         ); 
		 
		 $id = $this->input->post('id');
			
         $this->Customer_Model->update($data,$id); 
		
		 redirect('customer/index');

	}
	
	public function delete_customer(){
		
		 $id = $this->uri->segment('3'); 
		 
		 $this->Customer_Model->delete($id); 
		 
		 redirect('customer/index');
	}
	
	
}