<?php
class Past_Model extends CI_Model{

    public function __construct(){
		header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: GET, POST,OPTIONS,PUT,DELETE");

        parent::__construct();
        //$this->load->database();
    }

    public function fetchAll(){
        $result = $this->db->get('part');
        return $result->result();
    }
    public function insertPart($data){
        $this->db->insert('propart',$data);
        
    }
}
?>