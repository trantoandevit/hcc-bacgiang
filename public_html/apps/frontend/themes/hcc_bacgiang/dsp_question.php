<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array('question', 'list_tthc');
$VIEW_DATA['arr_script'] = array('my_js/cq/cq', 'jquery.slimscroll.min');

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>

<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-5 q_left">

                    <div class="ql_head">
                        <h3><i class="fa fa-question-circle-o"></i> Gửi câu hỏi</h3>
                    </div>
                    <div class="ql_content">
                        <form action="#" class="form" id="frmCQ" data-toggle="validator" role="form" >
                            <div class="row qrf_row">
                                <label class="col-sm-4 control-label">Họ và tên: <span>(*)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="txt_name" id="txt_name" required>
                                </div>
                            </div>
                            <div class="row qrf_row">
                                <label class="col-sm-4 control-label">Tiêu đề câu hỏi:  <span>(*)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="txt_title" id="txt_title" required>
                                </div>
                            </div>
                            <div class="row qrf_row">
                                <label class="col-sm-4 control-label">Số điện thoại:  <span>(*)</span></label>
                                <div class="col-sm-8">
                                    <input type="text" data-minlength="10" pattern="^[_0-9]{1,}$" class="form-control" name="txt_phone" id="txt_phone" required>
                                </div>
                            </div>
                            <div class="row qrf_row">
                                <label class="col-sm-4 control-label">Email:  <span>(*)</span></label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="txt_email" id="txt_email" required>
                                </div>
                            </div>
                            <div class="row qrf_row">
                                <label class="col-sm-4 control-label">Mã xác nhận:  <span>(*)</span></label>
                                <div class="col-sm-8">
                                    <?php
                                    $publickey = _CONST_CLIENT_CAPTCHA_PUBLIC_KEY; // you got this from the signup page
                                    echo recaptcha_get_html($publickey);
                                    ?>
                                    <span id="msg_error_captchar" class="msg_error"></span>
                                </div>
                            </div>
                            <div class="row qrf_row">
                                <label class="col-sm-4 control-label">Nội dung:  <span>(*)</span></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="7" name="txt_content" id="txt_content" required></textarea>
                                </div>
                            </div>
                            <div class="row qrf_row_btn">
                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary" id="btn_send_question">Gửi câu hỏi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7 q_right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="qr_head">
                                <h3><i class="fa fa-book"></i> Danh sách câu hỏi</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="qr_content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="qri_search">
                                            <input type="text" id="key_search_cq" class="form-control" aria-describedby="inputSuccess2Status" placeholder="Nhập từ khóa tìm kiếm...">
                                            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="list_cq">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right pag_bottom">
                            <ul class="list-unstyled list-inline ul_pag">

                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModalTTHC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog md_tra_cuu">
        <div class="modal-content">
            <div class="modal-header mh_header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center tc_header" id="myModalLabel">Nội dung hỏi đáp</h4>
            </div>
            <div class="modal-body">
                <div class="row loading" style="display: none; text-align: center">
                    <div class="col-lg-12">
                        <img src="<?php echo SITE_ROOT . 'public/images/loading.gif' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 detail">


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
