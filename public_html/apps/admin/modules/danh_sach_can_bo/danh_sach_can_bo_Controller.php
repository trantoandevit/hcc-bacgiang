<?php

class danh_sach_can_bo_Controller extends Controller {

    public function __construct()
    {
        parent::__construct('admin', 'danh_sach_can_bo');
        $this->check_login();
        $this->model->goback_url = $this->view->get_controller_url();
        $this->view->template->show_left_side_bar = FALSE;
        $this->view->template->arr_count_article = $this->model->gp_qry_count_article();
        //$this->view->template->show_div_website = FALSE;

        session::init();
        $v_lang_id = session::get('session_lang_id');
        $this->view->template->arr_all_lang = $this->model->qry_all_lang();
        $this->view->template->arr_all_grant_website = $this->model->gp_qry_all_website_by_user($v_lang_id);

        if (session::check_permission('QL_DON_VI_TRUC_THUOC', FALSE) == FALSE)
        {
            die('Bạn không có quyền thực hiện chức năng này !!!');
        }
    }

    public function main() {
        $this->dsp_all_can_bo();
    }

    public function dsp_all_can_bo() {
        $condition = "";
        $sel_Coquan = get_post_var('sel_Coquan', '');
        $txt_Tukhoa = get_post_var('txt_Tukhoa', '');
        if ($sel_Coquan != '' && $txt_Tukhoa != ''){
            $condition .= ' WHERE a.C_STATUS = 1 AND a.FK_MEMBER = '.$sel_Coquan.' AND a.C_NAME like "%'.$txt_Tukhoa.'%"';
        }
        else if($sel_Coquan == '' && $txt_Tukhoa != ''){
            $condition .= ' WHERE a.C_STATUS = 1 AND a.C_NAME like %'.$txt_Tukhoa.'%';
        }
        else if($sel_Coquan != '' && $txt_Tukhoa == ''){
            $condition .= ' WHERE a.C_STATUS = 1 AND a.FK_MEMBER = '.$sel_Coquan;
        }
        else{
            $condition = ' WHERE a.C_STATUS = 1';
        }
        $txt_Pager = get_post_var('txt_Pager', 1);
        $txt_Show = get_post_var('txt_Show', _CONST_DEFAULT_ROWS_PER_PAGE);
        $from = ( $txt_Pager - 1) * $txt_Show;
        $condition .= " LIMIT " . $from . "," . $txt_Show;
        $VIEW_DATA['count'] = ceil($this->model->qry_count_can_bo()/(int)($txt_Show));
        $VIEW_DATA['arr_all_can_bo'] = $this->model->qry_all_can_bo($condition);
        $VIEW_DATA['arr_all_co_quan'] = $this->model->qry_all_co_quan();
        $this->view->render('dsp_all_can_bo', $VIEW_DATA);
    }

    public function dsp_single_can_bo($v_id_can_bo) {
        is_id_number($v_id_can_bo) OR $v_id_can_bo = 0;
        $VIEW_DATA['dsp_single_all_can_bo'] = $this->model->qry_single_can_bo($v_id_can_bo);
        $VIEW_DATA['arr_all_co_quan'] = $this->model->qry_all_co_quan();
        $this->view->render('dsp_single_all_can_bo', $VIEW_DATA);
    }

//    public function add_can_bo()
//    {
//        $this->model->update_can_bo();
//    }
    public function delete_can_bo() {
        $this->model->delete_can_bo();
    }

    public function update_can_bo() {
        $this->model->update_can_bo();
    }

}
