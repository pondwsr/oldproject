<?php
class User_Model extends CI_Model{

public function __construct(){
    parent::__construct();
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
?>