<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array("dangky_hoso");
$VIEW_DATA['arr_script'] = array("dangky_hoso");

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 signup_left">
                    <div class="row title_head">
                        <div class="col-md-12 lu_head">
                            <ul class="list-unstyled list-inline bh_head">
                                <li><i class="fa fa-home"></i></li>
                                <li class="li_home">Trang chủ</li>
                                <li>Dịch vụ công</li>
                                <li>Đăng ký hồ sơ trực tuyến</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row su_top">
                        <div class="col-md-12">
                            <ul class="list-unstyled">
                                <li><strong>Đơn vị đăng ký:</strong> <i>UBND Thành Phố Bắc Giang</i></li>
                                <li><strong>Đăng ký thủ tục:</strong> <i>Danh sách đơn vị</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row su_content">
                        <div class="col-md-12">

                            <ul class="nav nav-tabs" >
                                <li class="active nn1">
                                    <a href="#a" data-toggle="tab">Thông tin người nộp</a>
                                </li>
                                <li class="nn2">
                                    <a href="#b" data-toggle="tab">Thông tin chủ hồ sơ</a>
                                </li>
                                <li class="nn3">
                                    <a href="#c" data-toggle="tab">Thông tin chi tiết hồ sơ</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="a" class="tab-pane fade in active tt_nguoinop">
                                    <div class="ql_content">
                                        <form action="#" class="form">
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Họ và tên:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Số điện thoại:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">CMTND:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Địa chỉ:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Email:</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="" id="">
                                                    <label class="lbl_chuhoso control control--checkbox">Người nộp là chủ hồ sơ
                                                        <input type="checkbox" checked="true" class="check_chuhoso"/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row qrf_row_btn">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-primary btnXac_nhan">Xác nhận <i class="glyphicon glyphicon-share-alt"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="b" class="tab-pane fade tt_chuhoso">
                                    <div class="ql_content">
                                        <form action="#" class="form">
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Họ và tên:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Số điện thoại:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">CMTND:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Địa chỉ:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row">
                                                <label class="col-sm-4 control-label text-right">Email:</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row_btn">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-primary btnXac_nhan">Xác nhận <i class="glyphicon glyphicon-share-alt"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="c" class="tab-pane fade chi_tiet">
                                    <div class="ql_content">
                                        <form action="#" class="form">
                                            <div class="row qrf_row ctr">
                                                <div class="col-sm-12">
                                                    <div class="check_col">
                                                        <label class="control control--checkbox">Tôi muốn nhận thông báo kết quả qua SMS
                                                            <input type="checkbox"/>
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                        <label class="control control--checkbox">Tôi muốn nhận kết quả giải quyết qua đường bưu điện
                                                            <input type="checkbox"/>
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row qrf_row ctr">
                                                <label class="col-sm-4 control-label text-right">Danh sách giấy tờ:</label>
                                                <div class="col-sm-8">
                                                    <label class="control-label">1. Giấy tờ quy định A</label>
                                                    <input type="file" name="" id="">
                                                </div>
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-8">
                                                    <label class="control-label">2. Giấy tờ quy định B</label>
                                                    <input type="file" name="" id="">
                                                </div>
                                            </div>
                                            <div class="row qrf_row ctr">
                                                <label class="col-sm-4 control-label text-right">Nội dung mô tả giấy tờ khác:</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" rows="4" name="" id=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row qrf_row ctr">
                                                <label class="col-sm-4 control-label text-right">Đính kèm giấy tờ khác:</label>
                                                <div class="col-sm-8">
                                                    <label class="control-label">1. Ảnh chụp chứng mình nhân dân mặt trước</label>
                                                    <div class="row">
                                                        <div class="col-sm-6 dinh_kem">
                                                            <input type="file" name="" id="">
                                                            <div class="add_dinh_kem"></div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <ul class="list-unstyled btn_x_t">
                                                                <li><button class="btn btn-primary btn_Xoa" onclick="btn_remove()"><i class="glyphicon glyphicon-remove"></i> Xóa</button></li>
                                                                <li><button class="btn btn-primary btn_Them_moi" onclick="btn_add()"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row qrf_row_btn ctr">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Gửi hồ sơ</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-3 r2 right_sidebar">
                    <div class="col-md-12 col-sm-6 col-xs-12 sb-r1" id="sb-r1-1">
                        <div class="sb-1">
                            <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Vector-Smart-Object3.png">
                        </div>
                        <div id="statistic-1" class="text-center notice_1">
                            <p class="text-center notice_1_1">NĂM 2016</p>
                            <p class="text-center notice_1_2">10939</p>
                            <p class="text-center notice_1_3">hồ sơ</p>
                            <p class="text-center notice_1_4">ĐÃ TIẾP NHẬN: 9789</p>
                            <p class="text-center notice_1_5">ĐÃ GIẢI QUYẾT: 5786</p>
                        </div>

                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-12 sb-r2" id="sb-r1-2">
                        <div class="sb-2">
                            <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Rectangle-2111.png">
                        </div>
                        <div id="statistic-2" class="text-center notice_2">
                            <p class="text-center notice_2_1">Một cửa điện tử</p>
                            <p class="text-center notice_2_2">Tháng 02/2016</p>
                            <p class="text-center notice_2_3">Tỉnh Bắc Giang giải quyết</p>
                            <p class="text-center notice_2_4">97,45%</p>
                            <p class="text-center notice_2_5">Hồ sơ đúng hạn</p>
                            <p class="text-center notice_2_6">(Tự động cập nhật: 07-04-2016)</p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-12 send_record">
                        <button class="btnSend">
                            <div class="icon_btn"><img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Shape_116.png"></div>
                            <div class="btn_text">
                                <h3>Gửi hồ sơ</h3>
                                <h3 class="h3_2">Trực tuyến</h3>
                            </div>
                        </button>
                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-12 sign_up btnSignUp">
                        <button class="btnSign_up">
                            <div class="btn_text_2">
                                <h3 class="h3_3">Đăng ký</h3>
                            </div>
                            <div class="icon_btn_2"><img src="<?php echo CONST_SITE_THEME_ROOT ?>img/icon_btnSign.png"></div>

                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);

