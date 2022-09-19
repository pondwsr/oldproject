<?php
class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('User_Model','user');
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods:GET, POST ,OPTIONS, PUT, DELETE");
        
    }
    

    public function checkLogin(){
   
        $user = $this->input->post('user');
        $pass =$this->input->post('pass');
        
        $result = $this->user->searchuserlogin($user,$pass);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
        
    }

   

}
?>