<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class saviss_service extends abstract_services{
    
    private $soap_client;
    
    private $url       = 'http://motcuadientu.bacgiang.gov.vn/OnegateBGService.asmx';
    private $devKey    = "onegatebg";
    private $password  = "onegate@2016"; 
    private $namespace = 'http://tempuri.org/';        
            
    function __construct() {
        $auth    = new HeaderAuth($this->devKey, $this->password); 
        $header  = new SoapHeader($this->namespace, "Header", $auth, false);
        
        $this->soap_client = new soap_client($this->url,$this->namespace, $header);
        $this->soap_client->init();
    }
    /**
     * lay danh sach member
     * @return type
     */
    public function member_list(){
        $arr_result = $this->soap_client->call("GetListOrganization",array());
        $xml = (string) $arr_result->GetListOrganizationResult->any;
        $obj = simplexml_load_string($xml);
        $arr_return = $obj->xpath('//row');
        return $arr_return;    
    }
    
    /**
     * tong hop ho so
     * @param type $begin_date
     * @param type $end_date
     * @param type $member_code
     * @return type
     */
    public function synthesis($begin_date,$end_date,$member_code){
        $arr_return = array();
        
        if(!empty($begin_date) && !empty($end_date))
        {
            $arr_result = $this->soap_client->call("GetDataProcess", array('GetDataProcess'=>array(
                                                                                                    'input'=>array(
                                                                                                                'FromDate'=>$begin_date
                                                                                                                ,'ToDate'=>$end_date
                                                                                                                ,'DataOrg'=>$member_code
                                                                                                    )
                                                                                                )
                                                                        ));
            $xml = (string) $arr_result->GetDataProcessResult->any;
            $obj = simplexml_load_string($xml);
            $arr_return = xpath($obj, '//row', XPATH_DOM);
        }
        
        return $arr_return;
    }
    
    /**
     * tra cuu ho so qua ma ho so
     * @param type $record_id
     * @return type
     */
    public function lookup_record_by_id($record_id){
        $arr_return = array();
        if(!empty($record_id))
        {
            $arr_result = $this->soap_client->call('GetInfoHoSo',array('GetInfoHoSo'=>array('MaHoSo'=> $record_id)));
            $xml = (string) $arr_result->GetInfoHoSoResult->any;
            $obj = simplexml_load_string($xml);
            if(!empty($obj))
            {
                //convert to array
                $arr_return = $this->convert_obj_to_array($obj);
                $arr_return['chi_tiet']['buoc_xu_ly'] = array_reverse($arr_return['chi_tiet']['buoc_xu_ly']);
            }
        }
        
        return $arr_return;
    }
            
    public function send_internet_record(){}
            
    public function guide(){}
            
    public function lookup_record($record_status, $record_code = '', $member_code = '', $receive_from, $receive_to, $name = '', $page, $row_per_page){
        $arr_return = array();
        
        $arr_result = $this->soap_client->call('GetListHoSo',array('GetListHoSo'=>array('input'=> array(
                                                                                                        'tinh_trang_ho_so' => $record_status,
                                                                                                        'ma_ho_so' => $record_code,
                                                                                                        'ma_don_vi'=> $member_code,
                                                                                                        'tiep_nhan_tu' => $receive_from,
                                                                                                        'tiep_nhan_den' => $receive_to,
                                                                                                        'ho_ten_nguoi_nop' => $name,
                                                                                                        'so_trang' => $page,
                                                                                                        'so_ban_ghi_tren_trang' => $row_per_page
                                                                                                        ))));
        $xml = (string) $arr_result->GetListHoSoResult->any;
        $obj = simplexml_load_string($xml);
        $arr_return = $obj->xpath('//row');
        
        return $arr_return;
    }
    
    /**
     * lay linh vuc theo don vi
     * @param type $member_code
     * @return type
     */
    public function spec($member_code){
        
        $arr_return = array();
        if(!empty($member_code))
        {
            $arr_result = $this->soap_client->call('GetListLinhVuByOrgCode',array('GetListLinhVuByOrgCode'=>array('orgCode'=> $member_code)));
            $xml = (string) $arr_result->GetListLinhVuByOrgCodeResult->any;
            $obj = simplexml_load_string($xml);
            $arr_return = $obj->xpath('//row');
        }
        
        return $arr_return;
        
    }
    
    public function record_type($member_code, $spec_code)
    {
        $arr_return = array();
        if(!empty($member_code) && !empty($spec_code))
        {
            $arr_result = $this->soap_client->call('GetGuidForTTHC',array('GetGuidForTTHC'=>array('input' => 
                                                                                                        array('OrgCode'=> $member_code, 'MaLinhVuc'=> $spec_code)
                                                                                                    )));
            $xml = (string) $arr_result->GetGuidForTTHCResult->any;
            $obj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
            $arr_return = $obj->xpath('//row');
        }
        
        return $arr_return;
    }
    
    /**
     * chuyen doi obj thanh array
     * @param type $obj
     * @return type
     */
    public function convert_obj_to_array($obj){
        $json_encode = json_encode($obj);
        return json_decode($json_encode,true);
    }
}

class HeaderAuth 
{ 
    public $User; 
    public $Password; 

    public function __construct($key, $pass) 
    { 
        $this->User = $key; 
        $this->Password = $pass; 
    } 
} 