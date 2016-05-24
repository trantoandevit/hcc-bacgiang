<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require get_model_filepath('admin','member');
require SERVER_ROOT . 'libs' . DS . 'services' . DS . 'base' . DS . 'mycurl.php';

class synchronize_Controller extends Controller
{
    public function __construct() {
        
       parent:: __construct('admin', 'synchronize');
        $this->check_login();
        $this->model->goback_url = $this->view->get_controller_url();
        $this->view->template->show_left_side_bar = FALSE;
        $this->view->template->arr_count_article = $this->model->gp_qry_count_article();
        //$this->view->template->show_div_website = FALSE;

        session::init();
        $v_lang_id = session::get('session_lang_id');
        $this->view->template->arr_all_lang = $this->model->qry_all_lang();
        $this->view->template->arr_all_grant_website = $this->model->gp_qry_all_website_by_user($v_lang_id);

        if (session::check_permission('QUYEN_ADMIN', FALSE) == FALSE)
        {
            die('Bạn không có quyền thực hiện chức năng này !!!');
        }
        
        set_time_limit(0);
        ini_set('memory_limit', '256M');
    }
    
    public function main(){
        $this->view->render('dsp_main');
    }
    
    /**
     * thuc hien dong bo hoa thanh vien
     */
    public function do_sync_member(){
        $url = _CONST_API_SERVICE_GET_ALL_MEMBER;
        $mycurl = new mycurl($url);
        $result = $mycurl
                ->call(http_build_query(array()))
                ->get_result();
        $arr_all_member = json_decode($result,true);
        
        foreach($arr_all_member as $developer_code => $arr_member)
        {
            $data = $arr_member['data'];
            $this->model->do_update_member($data, $developer_code);
        }
        
        $this->model->exec_done($this->model->goback_url);
        
    }
    
    /**
     * thuc hien dong bo hoa du lieu theo thang
     */
    public function synthesis_month()
    {
        $month = get_request_var('sel_month', DATE('m'));
        $year  = get_request_var('txt_year', DATE('Y'));
        
        $begin_date_of_month = "$year-$month-01";
        $end_date_of_month   = "$year-$month-" . jwdate::daysInMonth($month, $year);

        $url = _CONST_API_SERVICE_GET_SYNTHESIS;
        $mycurl = new mycurl($url);
        $result = $mycurl
                ->call(http_build_query(array('begin_date'=>$begin_date_of_month, 
                                                'end_date' => $end_date_of_month)))
                ->get_result();
        $arr_data = json_decode($result,true);
        
        $this->model->do_insert_synthesis($arr_data, $end_date_of_month, 't_ps_record_history_stat');
        
        $this->model->exec_done($this->model->goback_url);
    }
    
    /**
     * dong bo du lieu theo quy
     */
    public function synthesis_quarter(){
        $quarter = get_request_var('sel_quarter', '1');
        $year  = get_request_var('txt_year_syn_quarter', DATE('Y'));
        $begin_date = '';
        $end_date = '';
        switch($quarter)
        {
            case '1':
                $begin_date = "$year-01-01";
                $end_date   = "$year-03-" . jwdate::daysInMonth('03', $year);
                break;
            case '2':
                $begin_date = "$year-04-01";
                $end_date   = "$year-06-" . jwdate::daysInMonth('06', $year);
                break;
            case '3':
                $begin_date = "$year-07-01";
                $end_date   = "$year-09-" . jwdate::daysInMonth('09', $year);
                break;
            case '4':
                $begin_date = "$year-10-01";
                $end_date   = "$year-12-" . jwdate::daysInMonth('12', $year);
                break;
        }
        
        if($begin_date != '' && $end_date != ''){
            $url = _CONST_API_SERVICE_GET_SYNTHESIS;
            $mycurl = new mycurl($url);
            $result = $mycurl
                    ->call(http_build_query(array('begin_date'=>$begin_date, 
                                                    'end_date' => $end_date)))
                    ->get_result();
            $arr_data = json_decode($result,true);
            $this->model->do_insert_synthesis($arr_data, $end_date, 't_ps_record_history_stat_quarter');
        }
        $this->model->exec_done($this->model->goback_url);
    }
    
    /**
     * dong bo du lieu theo quy
     */
    public function synthesis_year(){
        $year  = get_request_var('txt_year_sync_year', DATE('Y'));
        $begin_date = "$year-01-01";
        $end_date = "$year-12-31";
        
        if($begin_date != '' && $end_date != ''){
            $url = _CONST_API_SERVICE_GET_SYNTHESIS;
            $mycurl = new mycurl($url);
            $result = $mycurl
                    ->call(http_build_query(array('begin_date'=>$begin_date, 
                                                    'end_date' => $end_date)))
                    ->get_result();
            $arr_data = json_decode($result,true);
            $this->model->do_insert_synthesis($arr_data, $end_date, 't_ps_record_history_stat_year');
        }
        $this->model->exec_done($this->model->goback_url);
    }
    
    /**
     * dong bo linh vuc
     */
    public function sync_spec()
    {
        $url = _CONST_API_SERVICE_GET_GET_SPEC;
        $mycurl = new mycurl($url);
        $result = $mycurl
                ->call(http_build_query(array()))
                ->get_result();
        $arr_data = json_decode($result,true);
        
        $this->model->do_insert_spec($arr_data);
        $this->model->exec_done($this->model->goback_url);
    }
    
    /**
     * dong bo tthc
     */
    public function sync_record_type()
    {
        $url = _CONST_API_SERVICE_GET_RECORD_TYPE;
        $mycurl = new mycurl($url);
        //lay du lieu voi linh vuc cua saviss
        $arr_all_spec = $this->model->qry_all_spec_by_developer_code(_CONST_DEVELOPER_SAVISS_CODE);
        foreach($arr_all_spec as $arr_spec)
        {
            $spec_code = $arr_spec['C_CODE'];
            $developer_code = $arr_spec['C_DEVELOPER_CODE'];
            $member_code = $arr_spec['C_MEMBER_CODE'];
            
            $result = $mycurl
                ->call(http_build_query(array('member_code'=>$member_code, 
                                                'spec_code' => $spec_code,
                                                'developer_code' => $developer_code)))
                ->get_result();
            $arr_data = json_decode($result,true);
            $this->model->do_insert_record_type($arr_data,$spec_code, $developer_code, $member_code);
        } 
        //lay du lieu voi linh vuc cua tam viet
        $arr_all_spec = $this->model->qry_all_spec_by_developer_code(_CONST_DEVELOPER_TAM_VIET_CODE);
        foreach($arr_all_spec as $arr_spec)
        {
            $spec_code = $arr_spec['C_CODE'];
            $developer_code = $arr_spec['C_DEVELOPER_CODE'];
            $member_code = $arr_spec['C_MEMBER_CODE'];
            
            $result = $mycurl
                ->call(http_build_query(array('member_code'=>$member_code, 
                                                'spec_code' => $spec_code,
                                                'developer_code' => $developer_code)))
                ->get_result();
            $arr_data = json_decode($result,true);
            
            $this->model->do_insert_record_type($arr_data,$spec_code, $developer_code, $member_code);
        } 
        
        $this->model->exec_done($this->model->goback_url);
    }
    
    /**
     * lay ho so tra ket qua moi nhat
     */
    public function sync_latest_record_has_result(){
        $receive_from = get_request_var('receive_from', DATE('Y-01-01'));
        $receive_to   = get_request_var('receive_to', DATE('Y-m-d'));
        
        $record_status = '3';
        $row_per_page = '100';
        
        $url = _CONST_API_SERVICE_GET_LOOKUP_RECORD;
        $mycurl = new mycurl($url);
        $result = $mycurl
               ->call(http_build_query(array('receive_from'=>$receive_from, 
                                               'receive_to' => $receive_to,
                                               'record_status' => $record_status,
                                               'row_per_page' => $row_per_page)))
               ->get_result();
        $arr_data = json_decode($result,true);
        
        foreach($arr_data as $developer_code => $data)
        {
            $this->model->do_insert_latest_record_has_result($data, $developer_code);
        }
        
        $this->model->exec_done($this->model->goback_url);
    }
}