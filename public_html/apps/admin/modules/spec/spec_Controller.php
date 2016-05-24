<?php

class spec_Controller extends Controller
{
    function __construct() {
        parent::__construct('admin','spec');
        $this->check_login();
        $this->model->goback_url = $this->view->get_controller_url();
        $this->view->show_left_side_bar = FALSE;
        //$this->view->template->show_div_website = FALSE;
        
        session::init();
        $v_lang_id = session::get('session_lang_id');
        $this->view->arr_all_lang = $this->model->qry_all_lang();
        $this->view->arr_all_grant_website = $this->model->gp_qry_all_website_by_user($v_lang_id);
        
        $this->view->template->arr_all_grant_website = $this->view->arr_all_grant_website;
        $this->view->template->arr_count_article  = $this->view->arr_count_article;
        $this->view->template->arr_all_lang  = $this->view->arr_all_lang;
        
//        if(session::check_permission('QL_LINH_VUC_THONG_KE')==FALSE)
//        {
//            die('Bạn không có quyền thực hiện chức năng này !!!');
//        }
    }
    public function main(){
        $this->dsp_all_spec();
    }
    
    public function dsp_all_spec(){
        $VIEW_DATA['data'] = $_POST;
        $VIEW_DATA['arr_all_spec'] = $this->model->qry_all_spec($_POST);
        $VIEW_DATA['arr_all_member'] = $this->model->qry_all_member();
        $this->view->render('dsp_all_spec',$VIEW_DATA);
    }
    public function dsp_single_spec(){
        $v_spec_id = get_post_var('hdn_item_id');
        $v_spec_id = (is_id_number($v_spec_id) > 0 ) ? $v_spec_id : 0;
        $VIEW_DATA['arr_single_spec'] = $this->model->qry_single_spec($v_spec_id);
        $VIEW_DATA['arr_all_member'] = $this->model->qry_all_member();
        $this->view->render('dsp_single_spec', $VIEW_DATA);
    }
    public function delete_spec() {
        $this->model->delete_spec();
    }

    public function update_spec() {
        $this->model->update_spec();
    }
}