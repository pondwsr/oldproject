<?php
class Tracking_Model extends CI_Model{

    public function __construct(){
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: GET, POST,OPTIONS,PUT,DELETE");
        parent::__construct();
    }

    public function search($key){
        $this->db->where('name',$key);
        $result = $this->db->get('products');

        if($result){
            $strStatus = true;
        }else{
            $strStatus = false;
        }
        $result = [
            'status' => $strStatus,
            'data' => $result->result()
        ];
        
        return $result;
    }
}
?>