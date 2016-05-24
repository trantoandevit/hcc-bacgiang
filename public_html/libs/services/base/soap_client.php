<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class soap_client{
    private $client;

    private $url;
    private $wsdl;
    private $namespace;
    private $header;
    private $had_header = 0;
    
    function __construct($url, $namespace = '', $header = '') {
        
        $this->url = $url;
        $this->wsdl = $url . '?WSDL';
        $this->namespace = $namespace;
        $this->header = $header;
        
        if(!empty($header))
        {
            $this->had_header = 1;
        }
    }
    
    function init(){
        try {
            $this->client = new SoapClient($this->wsdl, array()); 
        } catch (Exception $exc) {
            echo __FILE__ . ' không thể kết nối với service!!!';
            exit();
        }
    }
    
    function call($function_name,$arr_param)
    {
        if($this->had_header == 1)
        {
            $result = $this->client->__soapCall($function_name, $arr_param, NULL, $this->header);
        }
        else
        {
            $result = $this->client->__soapCall($function_name, $arr_param, NULL);
        }
        
        return $result;
    }
}


