<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class tamviet_service extends abstract_services{
    
    private $soap_client;
    
    private $url       = 'http://113.190.246.170/hcc-bacgiang-dsdv/webservice?wsdl';

    private $namespace = '';        
            
    function __construct() {
        $this->soap_client = new soap_client($this->url,$this->namespace);
        $this->soap_client->init();
    }
    
    public function member_list(){
        $arr_result = $this->soap_client->call("GetListOrganization",array());
        $obj = simplexml_load_string($arr_result, "SimpleXMLElement", LIBXML_NOCDATA);
        $arr_return = $obj->xpath('//row');
        return $arr_return;    
    }
        
    public function synthesis($begin_date,$end_date,$member_code){
        $arr_return = array();
        if(!empty($begin_date) && !empty($end_date))
        {
            $arr_result = $this->soap_client->call("GetDataProcess", array(
                                                                                                    'FromDate'=>$begin_date
                                                                                                    ,'ToDate'=>$end_date
                                                                                                    ,'DataOrg'=>$member_code
                                                                                                )
                                                                        );
            $obj = simplexml_load_string($arr_result, "SimpleXMLElement", LIBXML_NOCDATA);
            $arr_return = xpath($obj, '//row', XPATH_DOM);
        }
        
        return $arr_return;
    }
            
    public function lookup_record_by_id($record_id){
        $arr_return = array();
        if(!empty($record_id))
        {
            $xml = $this->soap_client->call('GetInforHoSo',array('recordCode'=>$record_id));
            
            $arr_result = simplexml_load_string($xml, 'SimpleXMLElement',LIBXML_NOCDATA);
            if(isset($arr_result->status) && $arr_result->status == 'fail')
            {
                $arr_return = array();
            }
            else
            {
                $arr_return = $arr_result;
            }
        }
        return $arr_return;
    }
            
    public function send_internet_record(){}
            
    public function guide(){}
            
    public function lookup_record($record_status, $record_code, $member_code, $receive_from, $receive_to, $name, $page, $row_per_page){
        $arr_return = array();
        
        $xml = $this->soap_client->call('GetListHoSo',array(
                                                                'tinh_trang_ho_so' => $record_status,
                                                                'ma_don_vi'=> $member_code,
                                                                'ma_ho_so' => $record_code,
                                                                'tiep_nhan_tu' => $receive_from,
                                                                'tiep_nhan_den' => $receive_to,
                                                                'ho_ten_nguoi_nop' => $name,
                                                                'so_trang' => $page,
                                                                'so_ban_ghi_tren_trang' => $row_per_page
                                                                ));
        
        $arr_result = simplexml_load_string($xml, 'SimpleXMLElement',LIBXML_NOCDATA);
        if(isset($arr_result->status) && $arr_result->status == 'fail')
        {
            $arr_return = array();
        }
        else
        {
            $arr_return = $arr_result->xpath('//row');
        }
        
        return $arr_return;
    }
    
    public function convert_obj_to_array($obj){
        $json_encode = json_encode($obj);
        return json_decode($json_encode,true);
    }
    
    public function spec($member_code){
        $arr_return = array();
        if(!empty($member_code))
        {
            $xml = $this->soap_client->call('GetListLinhVuByOrgCode',array());
            $arr_result = simplexml_load_string($xml, 'SimpleXMLElement',LIBXML_NOCDATA);
            if(isset($arr_result->status) && $arr_result->status == 'fail')
            {
                $arr_return = array();
            }
            else
            {
                $arr_return = $arr_result->xpath('//row');
            }
        }
        
        return $arr_return;
    }
    
    public function record_type($unit_code, $spec_code){
        $arr_return = array();
        if(!empty($spec_code))
        {
            $xml = $this->soap_client->call('GetGuidForTTHC',array($unit_code, $spec_code));
            $arr_result = simplexml_load_string($xml, 'SimpleXMLElement',LIBXML_NOCDATA);
            if(isset($arr_result->status) && $arr_result->status == 'fail')
            {
                $arr_return = array();
            }
            else
            {
                $arr_return = $arr_result->xpath('//row');
            }
        }
        return $arr_return;
    }
}