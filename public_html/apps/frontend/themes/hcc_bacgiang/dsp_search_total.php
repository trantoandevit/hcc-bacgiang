<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array('search_total');
$VIEW_DATA['arr_script'] = array('my_js/synthesis/synthesis', 'my_js/synthesis/chart');

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);

$member = get_request_var('member', '-1');
?>
<script>
    var cur_year = '<?php echo DATE('Y')?>';
    var cur_month = '<?php echo DATE('m')?>';
    var MEMBER = '<?php echo $member;?>';
</script>
<section>
    <div class="content">
        <div class="sec_table container">
            <div class="search_total">
                <div class="row box_search_content">
                    <div class="col-md-12">
                        <div class="bsc_head">
                            <h3>Thống kê tình trạng giải quyết hồ sơ theo đơn vị</h3>
                        </div>
                        <div class="bsc_content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="row s_left">
                                                <label class="col-sm-3 control-label">Đơn vị</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel_member">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row s_left">
                                                <label class="col-sm-3 control-label">Kỳ báo cáo</label>
                                                <div class="col-sm-9 kbc_rd">
                                                    <label>
                                                        <input type="radio" name="rad_period" id="inlineRadio1" value="month"> Tháng
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rad_period" id="inlineRadio2" value="quarter"> Quý
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rad_period" id="inlineRadio3" value="all"> Tất cả
                                                    </label>
                                                </div>


                                            </div>  
                                            <div class="row s_left period_month period_filter" >
                                                <label class="col-sm-3 control-label">Tháng</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel_month">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row s_left period_quarter period_filter">
                                                <label class="col-sm-3 control-label">Quý</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel_quarter">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="row s_right">

                                            </div>
                                            <div class="row s_right">
                                                <label class="col-sm-3 control-label">Năm</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sel_year">
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12 btn_search_bottom" id="div-action">
                                            <div class="bsb_btn">
                                                <button type="button" class="btn btn-primary filter"><i class="fa fa-search"></i> Tìm kiếm</button>
                                                <button type="button" class="btn btn-default clear-filter"><i class="fa fa-close"></i> Xóa điều kiện lọc</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-res">
                        <div class="tab_header">
                            <h3></h3>
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
                    <div class="chart_right" id="pie-chart-content">
                        <div class="cr_header text-center">
                            <h3>Biểu đồ kết quả xử lý hồ sơ năm <?php echo DATE('Y')?></h3>
                        </div>
                        <div class="cr_content">
                            <div id="pie-chart">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
