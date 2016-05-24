<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class api_service_Model extends Model{
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function qry_list_member($developer_code)
    {
        $sql = "SELECT GROUP_CONCAT(C_CODE) FROM t_ps_member WHERE C_DEVELOPER = ?";
        return $this->db->getOne($sql,array($developer_code));
    }
    
}