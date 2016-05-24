<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array("list_tthc");
$VIEW_DATA['arr_script'] = array();

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 l_left">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-12 l_menu">
                            <div class="lm_head">
                                <div class="bg_lm_head">
                                    <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/bg_list_tthc.png" alt="" />
                                </div>
                                <h3>Bộ TTHC cấp tỉnh</h3>
                                <a href=""><i class="fa fa-external-link-square"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 l_menu">
                            <div class="lm_head">
                                <div class="bg_lm_head">
                                    <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/bg_list_tthc.png" alt="" />
                                </div>
                                <h3>Bộ TTHC của cơ quan TW</h3>
                                <a href=""><i class="fa fa-external-link-square"></i></a>
                            </div>
                            <div class="lm_content">
                                <ul class="list-unstyled">
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Công an</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Quân đội</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Bảo hiểm xã hội</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Cục thuế tỉnh</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Kho bạc nhà nước</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Ngân hàng nhà nước</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Ngân hàng phát triển</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i> Ngân hàng chính sách</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 l_menu">
                            <div class="lm_head">
                                <div class="bg_lm_head">
                                    <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/bg_list_tthc.png" alt="" />
                                </div>
                                <h3>Bộ TTHC cấp huyện</h3>
                                <a href=""><i class="fa fa-external-link-square"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 l_menu">
                            <div class="lm_head">
                                <div class="bg_lm_head">
                                    <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/bg_list_tthc.png" alt="" />
                                </div>
                                <h3>Bộ TTHC cấp xã</h3>
                                <a href=""><i class="fa fa-external-link-square"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 sb-r1 list_left" id="sb-r1-1">
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
                        <div class="col-md-12 col-sm-4 col-xs-12 send_record">
                            <button class="btnSend">
                                <div class="icon_btn"><img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Shape_116.png"></div>
                                <div class="btn_text">
                                    <h3>Gửi hồ sơ</h3>
                                    <h3 class="h3_2">Trực tuyến</h3>
                                </div>
                            </button>
                        </div>
                        <div class="col-md-12 col-sm-4 col-xs-12 sign_up btnSignUp">
                            <button class="btnSign_up">
                                <div class="btn_text_2">
                                    <h3 class="h3_3">Đăng ký</h3>
                                </div>
                                <div class="icon_btn_2"><img src="<?php echo CONST_SITE_THEME_ROOT ?>img/icon_btnSign.png"></div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 l_right">
                    <div class="lr_head">
                        <div class="row title_head">
                            <div class="col-md-12">
                                <ul class="list-unstyled list-inline ul_head">
                                    <li><i class="fa fa-home"></i></li>
                                    <li class="li_home">Trang chủ</li>
                                    <li>Bộ thủ tục hành chính</li>
                                    <li>Chi tiết thủ tục hành chính</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="lrt_top">
                        <h4 class="text-center">Lĩnh vực tài chính kế hoạch</h4>
                    </div>
                    <div class="lr_bottom">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="lrbc_head">
                                    <h4>Thủ tục: Đăng ký kinh doanh</h4>
                                </div>

                            </div>
                            <div class="col-md-12 ">
                                <div class="lrbc_content">
                                    <ul class="list-unstyled">
                                        <li>1, Trình tự thực hiện
                                            <ul class="list-unstyled">
                                                <li>- Bước 1: Cán bộ chính sách cấp xã nộp hồ sơ tại Bộ phận tiếp nhận và trả kết quả của UBND cấp huyện. Cán bộ được giao nhiệm vụ thực hiện việc tiếp nhận và kiểm tra hồ sơ:
                                                    <ul class="list-unstyled">
                                                        <li>+ Nếu hồ sơ chưa đầy đủ hoặc chưa hợp lệ: Cán bộ trực tiếp hướng dẫn bổ sung, hoàn thiện hồ sơ theo quy định;</li>
                                                        <li>+ Nếu hồ sơ đầy đủ, hợp lệ: Ghi phiếu biên nhận và chuyển hồ sơ cho Phòng Lao động - Thương binh và xã hội.</li>
                                                    </ul>
                                                </li>
                                                <li>- Bước 2: Phòng Lao động - Thương binh và xã hội kiểm tra hồ sơ, tổng hợp, lập danh sách những người đủ điều kiện kèm các giấy tờ theo quy định gửi Sở Lao Động - Thương binh và xã hội xem xét, giải quyết.</li>
                                                <li>- Bước 3: Khi có kết quả từ Sở Lao động - Thương binh và xã hội, Phòng Lao động - Thương binh và xã hội chuyển bộ phận tiếp nhận và trả kết quả để trả cho cán bộ chính sách cấp xã.</li>
                                            </ul>
                                        </li>
                                        <li>2, Cách thức thực hiện
                                            <ul class="list-unstyled">
                                                <li>Trực tiếp tại trụ sở cơ quan hành chính nhà nước.</li>
                                            </ul>
                                        </li>
                                        <li>3, Thành phần, số lượng hồ sơ
                                            <ul class="list-unstyled">
                                                <li>a) Thành phần hồ sơ, bao gồm:
                                                    <ul class="list-unstyled">
                                                        <li>- Bản khai cá nhân</li>
                                                        <li>- Trường hợp bà mẹ đã từ trần thì đại diện thân nhân hoặc người thờ cúng lập khai bản khai kèm biên bản ủy quyền.</li>
                                                    </ul>
                                                </li>
                                                <li>b) Số lượng hồ sơ: <span>01 (bộ).</span></li>
                                            </ul>
                                        </li>
                                        <li>4, Thời hạn giải quyết
                                            <ul class="list-unstyled">
                                                <li>06 ngày làm việc kể từ ngày nhận đủ hồ sơ hợp lệ.</li>
                                            </ul>
                                        </li>
                                        <li>5, Đối tượng thực hiện thủ tục hành chính
                                            <ul class="list-unstyled">
                                                <li>Cá nhân</li>
                                            </ul>
                                        </li>
                                        <li>6, Cơ quan thực hiện TTHC:</li>
                                    </ul>
                                    <hr />
                                    <div class="dinh_kem">
                                        <h3>Tập tin đính kèm:</h3>
                                        <ul class="list-unstyled">
                                            <li>Chứng minh nhân dân <input type="file" /></li>
                                            <li>Chứng minh nhân dân <input type="file" /></li>
                                            <li>Chứng minh nhân dân <input type="file" /></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right pag_bottom">
                                <ul class="list-unstyled list-inline ul_pag">
                                    <li><button class="btn btn-default">Đầu</button></li>
                                    <li><button class="btn btn-default">Trước</button></li>
                                    <li><button class="btn btn-default">1</button></li>
                                    <li><button class="btn btn-default">2</button></li>
                                    <li><button class="btn btn-default">3</button></li>
                                    <li><button class="btn btn-default">4</button></li>
                                    <li><button class="btn btn-default">5</button></li>
                                    <li><button class="btn btn-default">6</button></li>
                                    <li><button class="btn btn-default">7</button></li>
                                    <li><button class="btn btn-default">8</button></li>
                                    <li><button class="btn btn-default">9</button></li>
                                    <li><button class="btn btn-default">Sau</button></li>
                                    <li><button class="btn btn-default">Cuối</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);

