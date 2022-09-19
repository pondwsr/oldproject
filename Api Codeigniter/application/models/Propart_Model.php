<?php
class Propart_Model extends CI_Model{

    public function __construct(){
		header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: GET, POST,OPTIONS,PUT,DELETE");

        parent::__construct();
        //$this->load->database();
    }

    public function fetchAll(){
        $sql ="select * from products";
        $result = $this->db->query($sql);
        //$result = $this->db->get('propart');
        return $result->result();
    }
}
?>