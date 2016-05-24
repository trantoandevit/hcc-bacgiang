<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templatese
 * and open the template in the editor.
 */
require SERVER_ROOT . 'libs' . DS . 'services' . DS . 'base' . DS . 'abstract_services.php';
require SERVER_ROOT . 'libs' . DS . 'services' . DS . 'base' . DS . 'soap_client.php';

require SERVER_ROOT . 'libs' . DS . 'services' . DS . 'member' . DS . 'saviss_service.php';
require SERVER_ROOT . 'libs' . DS . 'services' . DS . 'member' . DS . 'tamviet_service.php';

class api_service_Controller extends Controller{
    
    private $saviss_service;
    private $tamviet_service;
    
    public function __construct() {
        parent::__construct('admin', 'api_service');
        
        $this->saviss_service = new saviss_service();
        $this->tamviet_service = new tamviet_service();
        set_time_limit(0);
        ini_set('memory_limit','512M');
        
        header("Content-Type: application/json");
        
        $this->model->db->debug = 0;
    }
    
    /**
     * lay danh sach toan bo don vi
     */
    public function get_all_member(){
        //lay don vi cua saviss
        $arr[_CONST_DEVELOPER_SAVISS_CODE]['data'] = $this->saviss_service->member_list();
        //them pham vi don vi cho saviss
        foreach($arr[_CONST_DEVELOPER_SAVISS_CODE]['data'] as $index => $item)
        {
            $arr[_CONST_DEVELOPER_SAVISS_CODE]['data'][$index]->pham_vi_don_vi = '0';
        }
        
        //lay don vi cua tam viet
        $arr[_CONST_DEVELOPER_TAM_VIET_CODE]['data'] = $this->tamviet_service->member_list();
        
        echo json_encode($arr);
    }
    
    /**
     * tong hop du lieu
     */
    public function get_synthesis(){
        $arr = array();
        
        $begin_date  = get_request_var('begin_date','2016-04-01');
        $end_date    = get_request_var('end_date','2016-04-30');
        
        $list_saviss_member = $this->model->qry_list_member(_CONST_DEVELOPER_SAVISS_CODE);
        
        if(!empty($list_saviss_member))
        {
            $arr_member = explode(',', $list_saviss_member);
            foreach($arr_member as $member_code)
            {
                $arr[_CONST_DEVELOPER_SAVISS_CODE][$member_code] = $this->saviss_service->synthesis($begin_date,$end_date,$member_code);
            }
        }
        
        $list_tamviet_member = $this->model->qry_list_member(_CONST_DEVELOPER_TAM_VIET_CODE);
        
        if(!empty($list_tamviet_member))
        {
            $arr_member = explode(',', $list_tamviet_member);
            foreach($arr_member as $member_code)
            {
                $arr[_CONST_DEVELOPER_TAM_VIET_CODE][$member_code] = $this->tamviet_service->synthesis($begin_date,$end_date,$member_code);
            }
        }
        
        echo json_encode($arr);
    }
    
    /**
     * tra cuu ho so
     */
    public function get_record_info()
    {
        $arr = array();
        $record_code = get_request_var('record_code','');
        $devloper_code = get_request_var('devloper_code','');
        
        if(!empty($record_code))
        {
            switch ($devloper_code)
            {
                case _CONST_DEVELOPER_SAVISS_CODE:
                    $arr = $this->saviss_service->lookup_record_by_id($record_code);
                    break;
                case _CONST_DEVELOPER_TAM_VIET_CODE:
                    $arr = $this->tamviet_service->lookup_record_by_id($record_code);
                    break;
                default:
                    $arr = $this->saviss_service->lookup_record_by_id($record_code);
            
                    if(empty($arr))
                    {
                        $arr = $this->tamviet_service->lookup_record_by_id($record_code);
                    }
                    break;
            }
        }
        
        echo json_encode($arr);
    }
    
    public function get_spec(){
        $arr = array();
        //lay danh sach linh vuc cua saviss
        $list_saviss_member = $this->model->qry_list_member(_CONST_DEVELOPER_SAVISS_CODE);
        $arr_member = explode(',', $list_saviss_member);
        foreach($arr_member as $member_code)
        {
            $arr[_CONST_DEVELOPER_SAVISS_CODE][$member_code] = $this->saviss_service->spec($member_code);
        }
        
        //lay danh sach linh vuc cua tam viet
        $arr[_CONST_DEVELOPER_TAM_VIET_CODE][_CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT] = $this->tamviet_service->spec(_CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT);
        
        echo json_encode($arr);
    }
    /**
     * lay tthc thong qua thanh vien va linh vuc
     */
    public function get_record_type_by_member_and_spec(){
        $arr = array();
        $member_code = get_request_var('member_code','');
        $spec_code = get_request_var('spec_code','');
        $developer_code = get_request_var('developer_code','');
        
        if(!empty($member_code) && !empty($spec_code) && !empty($developer_code))
        {
            if($developer_code == _CONST_DEVELOPER_SAVISS_CODE)
            {
                $arr = $this->saviss_service->record_type($member_code, $spec_code);
            }
            else if($developer_code == _CONST_DEVELOPER_TAM_VIET_CODE)
            {
                $arr = $this->tamviet_service->record_type($member_code, $spec_code);
            }
        }
        
        echo json_encode($arr);
    }
    
    /**
     * lay danh sach ho so co ket qua moi nhat
     */
    public function get_lookup_record(){
        $arr = array();
        $record_status = get_request_var('record_status', '0'); 
        $record_code = get_request_var('record_code', '');
        $member_code = get_request_var('member_code', ''); 
        $receive_from = get_request_var('receive_from', DATE('Y-m-d'));
        $receive_to = get_request_var('receive_to', DATE('Y-m-d'));
        $name = get_request_var('name', '');
        $page = get_request_var('page', '1'); 
        $row_per_page = get_request_var('row_per_page', _CONST_DEFAULT_ROWS_PER_PAGE);
        
        $arr[_CONST_DEVELOPER_SAVISS_CODE] = $this->saviss_service->lookup_record($record_status, $record_code, $member_code, $receive_from, $receive_to, $name, $page, $row_per_page);
        
        //lay danh sach cua tam viet
        $list_member = $this->model->qry_list_member(_CONST_DEVELOPER_TAM_VIET_CODE);
        $arr_all_member_tamviet = explode(',', $list_member);
        $arr_tmp = array();
        foreach($arr_all_member_tamviet as $member_code)
        {
            $arr_tmp = array_merge($arr_tmp, $this->tamviet_service->lookup_record($record_status, $record_code, $member_code, $receive_from, $receive_to, $name, $page, $row_per_page));
        }
        $arr[_CONST_DEVELOPER_TAM_VIET_CODE] = $arr_tmp;
        echo json_encode($arr);
    }
}