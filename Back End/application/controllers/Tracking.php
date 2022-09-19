<?php
class Tracking extends CI_Controller{

    public function __construct(){
        header('Access-Control-Allow-Origin:*');
        header("Access-Control-Allow-Methods: GET,POST,OPTIONS,PUT,DELETE");
        parent::__construct();
        $this->load->model('Tracking_Model','track');
    }
    
    public function search(){
        $keyword = "";
        
        if(isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
        }

        $result = $this->track->search($keyword);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
?>