<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array();

$VIEW_DATA['arr_script'] = array('my_js/home_page/home_page'
    , 'my_js/doc/home_page_doc'
    , 'my_js/home_page/chart'
    , 'my_js/home_page/notification');


$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
echo '<script> var FULL_SITE_ROOT = "' . FULL_SITE_ROOT . '"</script>';
?>
<script>
    var gl_cur_month = '<?php echo DATE('m') ?>';
    var gl_cur_year = '<?php echo DATE('Y') ?>';
</script>
<section>
    <div class="content">
        <div class="sec_slide container">
            <div class="row">
                <div class="col-md-9 r1">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item next left">
                                <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Layer-1.png" alt="Slide">
                            </div>
                            <div class="item">
                                <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Layer-1.png" alt="Slide">
                            </div>
                            <div class="item active left">
                                <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Layer-1.png" alt="Slide">
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 r2">
                    <div class="col-md-12 col-sm-6 col-xs-12 sb-r1" id="sb-r1-1">
                        <div class="sb-1">
                            <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Vector-Smart-Object3.png">
                        </div>
                        <div id="statistic-1" class="text-center notice_1">
                            <p class="text-center notice_1_1">NĂM <?php echo DATE('Y') ?></p>
                            <p class="text-center notice_1_2 total"></p>
                            <p class="text-center notice_1_3">hồ sơ</p>
                            <p class="text-center notice_1_4 receive"></p>
                            <p class="text-center notice_1_5 done"></p>
                        </div>

                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-12 sb-r2" id="sb-r1-2">
                        <div class="sb-2">
                            <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Rectangle-2111.png">
                        </div>
                        <div id="statistic-2" class="text-center notice_2">
                            <p class="text-center notice_2_1">Một cửa điện tử</p>
                            <p class="text-center notice_2_2">Tháng <?php echo DATE('m') . '/' . DATE('Y') ?></p>
                            <p class="text-center notice_2_3">Tỉnh Bắc Giang giải quyết</p>
                            <p class="text-center notice_2_4 statistic-percent" ></p>
                            <p class="text-center notice_2_5">Hồ sơ đúng hạn</p>
                            <p class="text-center notice_2_6 statistic-date">(Tự động cập nhật: 07-04-2016)</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
        $cur_month = (int) DATE('m');
        if ($cur_month > 1):
            ?>
            <div class="sec_month container">
                <div class="slider1" id="slide-content">
                    <?php
                    for ($i = $cur_month; $i > 0; $i--):
                        $month = ($i < 10) ? "0$i" : $i;
                        $year = DATE('Y');
                        ?>
                        <div class="slide2 slide-item" style="height:100px">
                            <div class="month-block">
                                <p class="text-center month_head">THÁNG</p>
                                <p class="text-center month_name"><?php echo $i ?></p>
                            </div>
                            <div class="icon_month">
                                <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/month.png">
                            </div>
                            <div class="statistic-block" data-month="<?php echo $month ?>" data-year="<?php echo $year ?>">
                                <div class="col-xs-12 no-padding">
                                    <p class="col-xs-8">Tổng số:</p>
                                    <p class="col-xs-4 text-right slide-total">0</p>
                                </div>
                                <div class="col-xs-12 no-padding">
                                    <p class="col-xs-8">Kỳ trước:</p>
                                    <p class="col-xs-4 text-right slide-ky-truoc">0</p>
                                </div>
                                <div class="col-xs-12 no-padding">
                                    <p class="col-xs-8">Đã tiếp nhận:</p>
                                    <p class="col-xs-4 text-right slide-da-tiep-nhan">0</p>
                                </div>
                                <div class="col-xs-12 no-padding">
                                    <p class="col-xs-8">Đã giải quyết:</p>
                                    <p class="col-xs-4 text-right slide-da-giai-quyet">0</p>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="sec_search container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 status">
                            <div class="status_header">
                                <h3 class="text-center">Tra cứu tình trạng hồ sơ</h3>
                            </div>
                            <div class="status_content">
                                <p>Để thực hiện tra cứu tình trạng hồ sơ cấp phép, xin vui lòng nhập mã số tra cứu trên giấy biên nhận.</p>
                                <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-8 tra-cuu-hs">
                                        <input type="text" id="txt_record_code_lookup">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <button class="btn btn-primary btn_tc" id="btn_lookup_record">
                                            Tra cứu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 result" id="latest-record-has-result">
                            <div class="result_header">
                                <h3 class="re_3">HỒ SƠ ĐÃ CÓ KẾT QUẢ TRONG NGÀY</h3>
                                <h5 class="Detail"><a href=""><span class="fa fa-angle-double-right"></span> Chi tiết</a></h5>
                            </div>
                            <div class="result_content">
                                <div class="table_result">
                                    <table class="table">
                                        <thead>
                                        </thead><colgroup>
                                            <col style="width:40%">
                                            <col style="width:60%">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th>Mã hồ sơ</th>
                                                <th>Họ tên</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id="tab_result">
                                        <table>
                                            <colgroup>
                                                <col style="width:40%">
                                                <col style="width:60%">
                                            </colgroup>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-0 search_box_right col-sm-12 notifi-doc">
                    <ul class="nav nav-tabs" >
                        <li class="active " title="Thông báo"><a href="#thongbao" href="#thongbao" aria-controls="thongbao" role="tab" data-toggle="tab">THÔNG BÁO</a></li>
                        <li class="" title="Văn bản"><a class="tab" href="#vanban" aria-controls="vanban" role="tab" data-toggle="tab">VĂN BẢN</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="thongbao" class="tab-pane active" id="thongbao">
                            <marquee  direction="up" height="135px" scrollamount="2" onmouseover="this.stop()" onmouseout="this.start()" style="height: 135px;">
                            </marquee>
                            <div class="thongbao-other">
                                <a href="">
                                    <span class="fa fa-angle-double-right"></span>
                                    Xem thêm
                                </a>
                            </div>
                        </div>
                        <div role="vanban" class="tab-pane" id="vanban">
                            <div id="slimScrollDiv_1">
                            </div>
                            <div class="documentDetail">
                                <a href="<?php echo FULL_SITE_ROOT ?>van-ban">
                                    <span class="fa fa-angle-double-right"></span>
                                    Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sec_table container">
            <div class="row">
                <div class="col-md-12 table-res">
                    <div class="tab_header">
                        <h3>Bảng tổng hợp giải quyết thủ tục hành chính tháng <?php echo DATE('m') . '/' . DATE('Y') ?></h3>
                    </div>
                    <div class="table_hidden">
                        <div class="tab_content">
                            <div class="div_tab_head">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead id="t_head">

                                    </thead><colgroup>
                                        <col span="2" style="width:100px;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                    </colgroup>
                                    <tbody><tr class="tab_head">
                                            <th rowspan="2" class=" text-center"><span class="ten_don_vi">Tên đơn vị</span></th>
                                            <th colspan="2" class="tiep_nhan text-center"><span>Tiếp nhận</span></th>
                                            <th colspan="3" class="dang_giai_quyet text-center"><span>Đang giải quyết</span></th>
                                            <th colspan="4" class="da_giai_quyet text-center"><span>Đã giải quyết</span></th>
                                            <th colspan="2" class="tam_dung text-center"><span>Tạm dừng</span></th>
                                            <th colspan="2" class="huy_ho_so text-center"><span>Hủy hồ sơ</span></th>
                                            <th colspan="3" class="cho_ket_qua text-center"><span>Chờ kết quả</span></th>
                                            <th class="ty_le text-center">Tỷ lệ giải quyết</th>
                                        </tr>
                                        <tr class="th_content">
                                            <th class="text-center">Kỳ trước</th>
                                            <th class="text-center">Tiếp nhận</th>
                                            <th class="text-center">Tổng số</th>
                                            <th class="text-center">Chưa đến hạn</th>
                                            <th class="text-center">Quá hạn</th>
                                            <th class="text-center">Tổng số</th>
                                            <th class="text-center">Sớm hạn</th>
                                            <th class="text-center">Đúng hạn</th>
                                            <th class="text-center">Quá hạn</th>
                                            <th class="text-center">Bổ sung hồ sơ</th>
                                            <th class="text-center">Thực hiện NVTC</th>
                                            <th class="text-center">Từ chối</th>
                                            <th class="text-center">Công dân rút</th>
                                            <th class="text-center">Tổng số</th>
                                            <th class="text-center">Trong kỳ</th>
                                            <th class="text-center">Kỳ trước</th>
                                            <th class="text-center"></th>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <div class="table_box" id="slim_scroll">
                                <table class="table table-bordered table-striped table-responsive" id="table-synthesis">
                                    <colgroup>
                                        <col style="width: 100px;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                    </colgroup>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                            <div class="div_tab_bottom">
                                <table class="table-bordered table-striped table-responsive" id="table-synthesis-footer">
                                    <tbody>
                                    </tbody><colgroup>
                                        <col style="width: 100px;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                    </colgroup>
                                    <tbody>
                                        <tr class="text-center tr_tong">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="sec_chart container">
            <div class="row">
                <div class="col-md-8">
                    <div class="chart_left">
                        <div class="cl_header text-center">
                            <h3>Tình hình giải quyết hồ sơ 6 tháng gần đây</h3>
                        </div>
                        <div class="cl_content">
                            <div id="combo-chart">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart_right">
                        <div class="cr_header text-center">
                            <h3>Biểu đồ kết quả xử lý hồ sơ tháng <?php echo DATE('m/Y')?></h3>
                        </div>
                        <div class="cr_content">
                            <div id="pie-chart">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
