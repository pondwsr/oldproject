<?php
class Propart extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Propart_Model','propart');
    }

    public function fetchAll(){
        $result = $this->propart->fetchAll();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

}
?>