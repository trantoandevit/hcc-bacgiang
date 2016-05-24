<?php 
class mycurl {
    
    private $url;
    private $result;
    private $status;
            
    public function __construct($url) {
        $this->url = $url;
    }
    
    public function set_url($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function call($postFields)
    {
        $s = curl_init(); 

        curl_setopt($s,CURLOPT_URL,$this->url); 
        curl_setopt($s,CURLOPT_HTTPHEADER,array('Expect:')); 
//        curl_setopt($s,CURLOPT_TIMEOUT,$this->_timeout);
//         curl_setopt($s,CURLOPT_MAXREDIRS,$this->_maxRedirects); 
        curl_setopt($s,CURLOPT_RETURNTRANSFER,true); 
//        curl_setopt($s,CURLOPT_FOLLOWLOCATION,$this->_followlocation); 
//        curl_setopt($s,CURLOPT_COOKIEJAR,$this->_cookieFileLocation); 
//        curl_setopt($s,CURLOPT_COOKIEFILE,$this->_cookieFileLocation); 
        
        
        curl_setopt($s,CURLOPT_POST,true); 
        curl_setopt($s,CURLOPT_POSTFIELDS,$postFields);
        
        $this->result  = curl_exec($s); 
        $this->status  = curl_getinfo($s,CURLINFO_HTTP_CODE); 
        curl_close($s);
        
        return $this;
    }
    
    public function get_result()
    {
        return $this->result;
    }
    
    public function get_status()
    {
        return $this->status;
    }
}