<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require SERVER_ROOT . 'libs' . DS . 'services' . DS . 'base' . DS . 'mycurl.php';
require get_model_filepath('admin', 'synchronize');
require_once(SERVER_ROOT . DS . 'libs' . DS . 'recaptcha-php-1.11/recaptchalib.php');

class api_data_Controller extends Controller
{

    private $synchronize_model;

    public function __construct()
    {
        parent::__construct('frontend', 'api_data');

        header("Content-Type: application/json");

        $this->model->db->debug = 0;

        $this->synchronize_model = new synchronize_Model();
    }

    /**
     * lay du lieu tong hop cua tinh theo nam
     */
    public function synthesis_year_province()
    {
        $year = get_request_var('year', DATE('Y'));
        //lay du lieu tong hop
        $result = $this->model->qry_synthesis_year_province($year);
        echo json_encode($result);
    }

    /**
     * tong hop du lieu theo thang
     */
    public function synthesis_month()
    {
        $month = get_request_var('month', DATE('m'));
        $year = get_request_var('year', DATE('Y'));
        $member = get_request_var('member', '-1');

        $check = $this->model->check_synthesis_month($month, $year);

        //neu chua co du lieu => lay du lieu tu api_service
        if ($check < 1)
        {
            $begin_date_of_month = "$year-$month-01";
            $end_date_of_month = "$year-$month-" . jwdate::daysInMonth($month, $year);

            $url = _CONST_API_SERVICE_GET_SYNTHESIS;
            $mycurl = new mycurl($url);
            $result = $mycurl
                    ->call(http_build_query(array('begin_date' => $begin_date_of_month,
                        'end_date' => $end_date_of_month)))
                    ->get_result();
            $arr_data = json_decode($result, true);
            $this->synchronize_model->do_insert_synthesis($arr_data, $end_date_of_month, 't_ps_record_history_stat');
        }

        //lay du lieu tong hop
        $result = $this->model->qry_synthesis_month($month, $year, $member);
        echo json_encode($result);
    }

    /**
     * tong hop du lieu theo quy
     */
    public function synthesis_quarter()
    {
        $quarter = get_request_var('quarter', DATE('m'));
        $year = get_request_var('year', DATE('Y'));
        $member = get_request_var('member', '-1');
        $begin_date = '';
        $end_date = '';

        if ((int) $quarter < 1 OR (int) $quarter > 4)
        {
            echo json_encode(array());
        }

        switch ($quarter)
        {
            case '1':
                $begin_date = "$year-01-01";
                $end_date = "$year-03-" . jwdate::daysInMonth('03', $year);
                break;
            case '2':
                $begin_date = "$year-04-01";
                $end_date = "$year-06-" . jwdate::daysInMonth('06', $year);
                break;
            case '3':
                $begin_date = "$year-07-01";
                $end_date = "$year-09-" . jwdate::daysInMonth('09', $year);
                break;
            case '4':
                $begin_date = "$year-10-01";
                $end_date = "$year-12-" . jwdate::daysInMonth('12', $year);
                break;
        }

        $check = $this->model->check_synthesis_by_date($end_date, 't_ps_record_history_stat_quarter');

        //neu chua co du lieu => lay du lieu tu api_service
        if ($check < 1)
        {
            $url = _CONST_API_SERVICE_GET_SYNTHESIS;
            $mycurl = new mycurl($url);
            $result = $mycurl
                    ->call(http_build_query(array('begin_date' => $begin_date,
                        'end_date' => $end_date)))
                    ->get_result();
            $arr_data = json_decode($result, true);
            $this->synchronize_model->do_insert_synthesis($arr_data, $end_date, 't_ps_record_history_stat_quarter');
        }

        //lay du lieu tong hop
        $result = $this->model->qry_synthesis_by_date($end_date, $member, 't_ps_record_history_stat_quarter');
        echo json_encode($result);
    }

    /**
     * tong hop du lieu theo quy
     */
    public function synthesis_year()
    {
        $year = get_request_var('year', DATE('Y'));
        $member = get_request_var('member', '-1');

        $begin_date = "$year-01-01";
        $end_date = "$year-12-31";

        $check = $this->model->check_synthesis_by_date($end_date, 't_ps_record_history_stat_year');

        //neu chua co du lieu => lay du lieu tu api_service
        if ($check < 1)
        {
            $url = _CONST_API_SERVICE_GET_SYNTHESIS;
            $mycurl = new mycurl($url);
            $result = $mycurl
                    ->call(http_build_query(array('begin_date' => $begin_date,
                        'end_date' => $end_date)))
                    ->get_result();
            $arr_data = json_decode($result, true);
            $this->synchronize_model->do_insert_synthesis($arr_data, $end_date, 't_ps_record_history_stat_year');
        }

        //lay du lieu tong hop
        $result = $this->model->qry_synthesis_by_date($end_date, $member, 't_ps_record_history_stat_year');
        echo json_encode($result);
    }

    /**
     * tổng hợp tình hình của tỉnh theo tháng
     */
    public function synthesis_month_province()
    {
        $month = get_request_var('month', DATE('m'));
        $year = get_request_var('year', DATE('Y'));
        $member = get_request_var('member', '-1');

        $check = $this->model->check_synthesis_month($month, $year);

        //neu chua co du lieu => lay du lieu tu api_service
        if ($check < 1)
        {
            $begin_date_of_month = "$year-$month-01";
            $end_date_of_month = "$year-$month-" . jwdate::daysInMonth($month, $year);

            $url = _CONST_API_SERVICE_GET_SYNTHESIS;
            $mycurl = new mycurl($url);
            $result = $mycurl
                    ->call(http_build_query(array('begin_date' => $begin_date_of_month,
                        'end_date' => $end_date_of_month)))
                    ->get_result();
            $arr_data = json_decode($result, true);
            $this->synchronize_model->do_insert_synthesis($arr_data, $end_date_of_month, 't_ps_record_history_stat');
        }

        $result = $this->model->qry_synthesis_month_province($month, $year, $member);
        echo json_encode($result);
    }

    /**
     * lay danh sach tin bai noi bat
     */
    public function get_sticky()
    {
        $website_id = get_request_var('website_id', 0);

        $result = $this->model->qry_sticky($website_id);

        echo json_encode($result);
    }

    /**
     * chi tiet tin bai
     */
    public function get_article()
    {

        $website_id = get_request_var('website_id', 0);
        $category_id = get_request_var('category_id', 0);
        $article_id = get_request_var('article_id', 0);

        $result = $this->model->qry_single_article($website_id, $category_id, $article_id);
        echo json_encode($result);
    }

    /**
     * tin khac
     */
    public function get_other_article()
    {

        $category_id = get_request_var('category_id', 0);
        $article_id = get_request_var('article_id', 0);

        $result = $this->model->qry_all_other_article($category_id, $article_id);
        echo json_encode($result);
    }

    /**
     * tra cuu ho so qua ma ho so
     */
    public function get_record_info()
    {
        $record_code = get_request_var('record_code', '');
        $developer_code = get_request_var('developer_code', '');
        
        $record_code = trim($record_code);
        $developer_code = trim($developer_code);
        
        $url = _CONST_API_SERVICE_GET_RECORD_INFO;
        $mycurl = new mycurl($url);
        $result = $mycurl
                ->call(http_build_query(array('record_code' => $record_code,
                    'developer_code' => $developer_code)))
                ->get_result();
        echo $result;
    }

    /**
     * lay danh sach thanh vien
     */
    public function get_all_member()
    {

        $all_info = get_request_var('all_info', 0);

        if ($all_info == 0)
        {
            $result = $this->model->qry_assoc_member();
        }
        else
        {
            $result = $this->model->qry_all_member();
        }
        echo json_encode($result);
    }

    /**
     * lay danh sach thanh vien cap so
     */
    public function get_all_departments_member()
    {
        $scope = '0';
        $all_info = get_request_var('all_info', 0);

        if ($all_info == 0)
        {
            $result = $this->model->qry_assoc_member($scope);
        }
        else
        {
            $result = $this->model->qry_all_member($scope);
        }
        echo json_encode($result);
    }

    /**
     * lay danh sach linh vuc
     */
    public function get_all_spec()
    {
        $result = $this->model->qry_assoc_spec();
        echo json_encode($result);
    }

    /**
     * lay danh sach record type
     */
    public function get_record_type_by_page()
    {
        $page = (int) get_request_var('page', 1);
        $key_word = get_request_var('keyword', '');
        $member = get_request_var('member', '-1');
        $spec = get_request_var('spec', '-1');
        $level = get_request_var('level', '-1');

        $result = $this->model->qry_all_record_type($page, $key_word, $member, $spec, $level);
        echo json_encode($result);
    }

    public function get_list_cb()
    {
        $arr_return = array();
        $id = get_request_var('id', '');
        $keyword = get_request_var('keyword', '');
        $page = get_request_var('page', '');
        $arr_return = $this->model->get_list_cb($id, $keyword, $page);
        echo json_encode($arr_return);
    }

    /**
     * lay chi tiet tthc
     */
    public function get_record_type()
    {
        $arr_return = array();
        $record_type_id = get_request_var('record_type_id', '');
        if (!empty($record_type_id))
        {
            $arr_return = $this->model->qry_record_type($record_type_id);
        }

        echo json_encode($arr_return);
    }

    /**
     * lay danh sach cau hoi cong dan
     */
    public function get_all_cq()
    {
        $arr_return = array();
        $page = get_request_var('page', 1);
        $key_word = get_request_var('keyword', '');

        $arr_return = $this->model->qry_all_cq($page, $key_word);

        echo json_encode($arr_return);
    }

    public function get_all_year_has_data()
    {
        $arr_return = array();
        $arr_return = $this->model->qry_all_year_has_data();
        echo json_encode($arr_return);
    }

    public function get_all_month_has_data()
    {
        $arr_return = array();
        $arr_return = $this->model->qry_all_month_has_data();
        echo json_encode($arr_return);
    }

    public function do_insert_cq()
    {
        $name = get_post_var('txt_name', '');
        $title = get_post_var('txt_title', '');
        $phone = get_post_var('txt_phone', '');
        $email = get_post_var('txt_email', '');
        $content = get_post_var('txt_content', '');

        $privatekey = _CONST_SERVER_CAPTCHA_PRIVATE_KEY;
        $server_remote_addr = $_SERVER["REMOTE_ADDR"];
        $recaptcha_challenge_field = get_post_var("recaptcha_challenge_field");
        $recaptcha_response_field = get_post_var("recaptcha_response_field");
        $resp = recaptcha_check_answer($privatekey, $server_remote_addr, $recaptcha_challenge_field, $recaptcha_response_field);

        $data = array();
        if (!$resp->is_valid)
        {
            $data['stt'] = 'false_captcha';
            $data['msg_error'] = 'Mã xác thực không hợp lệ!';
        }
        else
        {
            $data = $this->model->do_insert_cq($name, $title, $phone, $email, $content);
        }

        echo json_encode($data);
    }

    /**
     * lay danh sach tin bai thuoc chuyen muc
     */
    public function get_art_of_cat_by_page()
    {
        $arr_return = array();

        $page = get_request_var('page', 1);
        $website_id = get_request_var('website_id', '218');
        $category_id = get_request_var('category_id', '1305');
        $key_word = get_request_var('key_word', '');

        if (!empty($website_id) && !empty($category_id))
        {
            $arr_return = $this->model->qry_art_of_cat_by_page($page, $website_id, $category_id, $key_word);
        }
        foreach ($arr_return['data'] as $index => $article)
        {
            $arr_return['data'][$index]['C_SUMMARY'] = get_leftmost_words($article[C_SUMMARY], 25);
        }
        echo json_encode($arr_return);
    }

    public function get_cq_detail()
    {
        $cq_id = get_request_var('cq_id', '');
        $result = $this->model->qry_cq_detail($cq_id);
        echo json_encode($result);
    }

    public function get_latest_record_has_result()
    {
        $result = array();
        $result = $this->model->qry_latest_record_has_result();
        echo json_encode($result);
    }

    public function getAllDoc()
    {
        $result = $this->model->qry_all_document();
        echo json_encode($result);
    }

    public function getSingleDoc()
    {
        $docId = get_post_var('docId', 0);

        $documentArray = $this->model->quy_single_document($docId);
        $coQuan = $documentArray['FK_CO_QUAN_BAN_HANH'];
        $linhVuc = $documentArray['FK_LINH_VUC_VAN_BAN'];
        $coQuanBanHanh = $this->model->qry_single_co_quan_ban_hanh($coQuan);
        $linhVucThongKe = $this->model->qry_single_linh_vuc_thong_ke($linhVuc);
        $attachment = $this->model->qry_all_attachment($docId);
        echo json_encode(array('document' => $documentArray, 'coquan' => $coQuanBanHanh, 'linhvuc' => $linhVucThongKe, 'attachment' => $attachment));
    }

    /**
     * 
     */
    public function getDocByPage()
    {
        $page = get_post_var('page', 1);
        if (!empty($page))
        {
            $from = ($page - 1) * _CONST_LIMIT_HOME_DOCUMENT;
            $condition .=" ORDER BY C_NGAY_BAN_HANH DESC limit " . $from . "," . _CONST_LIMIT_HOME_DOCUMENT;
        }
        $result = $this->model->qry_all_document($condition);
        echo json_encode($result);
    }

    public function getDocument()
    {
        $title = get_post_var('txt_title', '');
        $cqbh = get_post_var('sel_cqbh', '');
        $lvtk = get_post_var('sel_lvtk', '');
        $lvb = get_post_var('sel_loai_vb', '');
        $page = get_post_var('page', '');
        if (!empty($title))
        {
            $condition .= " AND (C_TITLE LIKE '%" . $title . "%' OR C_SO_HIEU_VAN_BAN LIKE '%" . $title . "%')";
        }

        if (!empty($cqbh))
        {
            $condition .= " AND FK_CO_QUAN_BAN_HANH = " . $cqbh . "";
        }

        if (!empty($lvtk))
        {
            $condition .= " AND FK_LINH_VUC_VAN_BAN = " . $lvtk . "";
        }
        if (!empty($lvb))
        {
            $condition .= " AND C_LOAI_VAN_BAN = " % '.$lvb.' % "";
        }
        $condition .=" ORDER BY C_NGAY_BAN_HANH DESC";
        if (!empty($page))
        {
            $from = ($page - 1) * _CONST_LIMIT_NEW_DOCUMENT;
            $condition .= " LIMIT " . $from . "," . _CONST_LIMIT_NEW_DOCUMENT . "";
        }
        $result = $this->model->search_document($condition);
        echo json_encode($result);
    }

    public function getAllOrgan()
    {
        $result = $this->model->qry_all_co_quan_ban_hanh();
        echo json_encode($result);
    }

    public function getAllStatistics()
    {
        $result = $this->model->qry_all_linh_vuc_thong_ke();
        echo json_encode($result);
    }

    public function loadDocumentByOrgan()
    {
        $organId = get_post_var('organId');
        $result = $this->model->qry_all_document_by_organ($organId);
        echo json_encode($result);
    }

    public function loadDocumentBySta()
    {
        $staId = get_post_var('staId');
        $result = $this->model->qry_all_document_by_sta($staId);
        echo json_encode($result);
    }

    public function searchDocument()
    {
        $title = get_post_var('txt_title', '');
        $cqbh = get_post_var('sel_cqbh', '');
        $lvtk = get_post_var('sel_lvtk', '');
        $lvb = get_post_var('sel_loai_vb', '');
        $page = get_post_var('page', 1);
        if (!empty($title))
        {
            $condition .= " AND (C_TITLE LIKE '%" . $title . "%' OR C_SO_HIEU_VAN_BAN LIKE '%" . $title . "%')";
        }

        if (!empty($cqbh))
        {
            $condition .= " AND FK_CO_QUAN_BAN_HANH = " . $cqbh . "";
        }

        if (!empty($lvtk))
        {
            $condition .= " AND FK_LINH_VUC_VAN_BAN = " . $lvtk . "";
        }
        if (!empty($lvb))
        {
            $condition .= " AND C_LOAI_VAN_BAN = " % '.$lvb.' % "";
        }
        $condition .=" ORDER BY C_NGAY_BAN_HANH DESC";
        if (!empty($page))
        {
            $from = ($page - 1) * _CONST_DEFAULT_ROWS_PER_PAGE;
            $condition .= " LIMIT " . $from . "," . _CONST_DEFAULT_ROWS_PER_PAGE . "";
        }
        $result = $this->model->search_document($condition);
        echo json_encode($result);
    }

    /**
     * Lấy dữ liệu danh danh sách thông báo mới nhất
     */
    function getAllNotificationNew()
    {

        $view_data = $this->model->qry_all_nitification_new();
        if (!is_array($view_data))
        {
            $view_data['resp'] = 'fail';
            $view_data['msg'] = 'Xảy ra lỗi';
            $view_data['line'] = __LINE__;
        }
        echo json_encode($view_data);
        exit();
    }

    function getAllDanhGiaCanBo()
    {
        $id_co_quan = get_post_var('id_member', '');
        $name = get_post_var('txt_name', '');
        $condition = '';
        if ($id_co_quan != "")
        {
            $condition .= " AND PK_MEMBER = " . $id_co_quan . "";
        }
        if ($name != '')
        {
            $condition .= " AND a.C_NAME LIKE '%" . $name . "%'";
        }
        $result = $this->model->getAllDanhGiaCanBo($condition);
        echo json_encode($result);
    }

    function doDanhGiaCanBo()
    {
        $id_employment = get_post_var('FK_EMPLOYMENT', '');
        $id_member = get_post_var('FK_MEMBER', '');
        $arr_question = get_array_value($_POST, 'QUESTION', '');
        $result = $this->model->doDanhGiaCanBo($id_employment, $arr_question, $id_member);
        echo json_encode($result);
    }

    function get_all_linh_vuc()
    {
        $member_code = get_post_var('C_MEMBER_CODE');
        $result = $this->model->get_all_linh_vuc($member_code);
        echo json_encode($result);
    }

    function get_record_type_by_spec()
    {
        $member_code = get_post_var('C_MEMBER_CODE');
        $spec_code = get_post_var('C_SPEC_CODE');
        $result = $this->model->get_record_type_by_spec($member_code, $spec_code);
        echo json_encode($result);
    }

    function add_record()
    {
        $privatekey = _CONST_SERVER_CAPTCHA_PRIVATE_KEY;
        $server_remote_addr = $_SERVER["REMOTE_ADDR"];
        $recaptcha_challenge_field = get_post_var("recaptcha_challenge_field");
        $recaptcha_response_field = get_post_var("recaptcha_response_field");
        $resp = recaptcha_check_answer($privatekey, $server_remote_addr, $recaptcha_challenge_field, $recaptcha_response_field);
        
        $fk_record_type = get_post_var('selType');
        $c_return_phone_number = get_post_var('txtPhoneHS');
        $c_return_email = get_post_var('txtEmailHS','');
        $c_citizen_name = get_post_var('txtNameHS');
        $c_citizen_address = get_post_var('txtAddressHS');
        $c_note = get_post_var('txtDescribeHS');
        $data = array();
        if (!$resp->is_valid)
        {
            $data['stt'] = 'false_captcha';
            $data['msg_error'] = 'Mã xác thực không hợp lệ!';
        }
        else
        {
            $data = $_POST;
        }
        echo json_encode($data);
    }

}
