<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array('list_tthc', 'danhgia_cb', 'theme-krajee-svg', 'star-rating');
$VIEW_DATA['arr_script'] = array('my_js/dgia_cbo/get_data_canbo', 'my_js/dgia_cbo/danhgia_cb', 'my_js/dgia_cbo/star-rating', 'my_js/dgia_cbo/star-rating_locale_LANG');
//$VIEW_DATA['arr_script'] = array('my_js/dgia_cbo/danhgia_cb', 'my_js/dgia_cbo/get_data_canbo');
$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<script>
    var CONST_SITE_THEME_ROOT = '<?php echo CONST_SITE_THEME_ROOT ?>';
</script>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 dgc_left">
                    <div class="dg_left">
                        <div class="list-group dgl_all">
                            <a href="javascript:void(0)" class="list-group-item a_all">Tất cả</a>
                        </div>
                        <div class="list-group dgl_so">
                            <a href="javascript:void(0)" class="list-group-item a_cap_so">Cấp sở, ban ngành </a>
                            <button class=" btn btn-primary fa fa-angle-double-up btn_up"></button>
                            <button class=" btn btn-primary fa fa-angle-double-down btn_down"></button>
                            <div class="so">                        
                            </div>
                        </div>
                        <div class="list-group dgl_huyen">
                            <a href="javascript:void(0)" class="list-group-item a_cap_huyen">Cấp huyện, thành phố </a>
                            <button class=" btn btn-primary fa fa-angle-double-up btn_up_h"></button>
                            <button class=" btn btn-primary fa fa-angle-double-down btn_down_h"></button>
                            <div class="huyen"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 dgc_right">
                    <div class="dg_right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="qri_search">
                                    <input type="text" id="key_search_cb" class="form-control" aria-describedby="inputSuccess2Status" placeholder="Nhập từ khóa tìm kiếm...">
                                    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row dg_slim_scroll">
                            <div class="dgs_box_list">
                                <div class="col-md-12 dgr_list">
                                </div>
                            </div>
                        </div> <!-- end class dg_slim_scroll -->
                        <div class="col-md-12 text-right pag_bottom" style="margin-top:10px">
                            <ul class="list-unstyled list-inline ul_pag"></ul>
                        </div>
                    </div>
                </div>  <!-- end class dgc_right --> 
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="canboModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog md_can_bo">
        <div class="modal-content">
            <div class="modal-header mh_header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center tc_header" id="myModalLabel">Đánh giá cán bộ</h4>
            </div>
            <div class="modal-body">
                <div class="row loading" style="display: none; text-align: center">
                    <div class="col-lg-12">
                        <img src="<?php echo SITE_ROOT . 'public/images/loading.gif' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 detail">
                        <div class="row rdg_info">
                            <div class="col-md-4 col-sm-4 col-xs-4 dg_img">
                                <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/user-icon.png" alt="" />
                            </div>
                            <div class="col-md-8 col-sm-4 col-xs-8 dg_info">
                                <div class="p_info">
                                    <ul  class="list-unstyled">
<!--                                        <li><span>Tên : </span><span id="modal_cb_name"></span></li>
                                        <li><span>Đơn vị:</span><span id="modal_member_name"></span></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row rdg_action">
                            <div class="col-md-12">
                                <ul class="list-unstyled list-inline">                                
                                </ul>
                            </div>

                        </div>
                        <div class="row f_input">
                            <div class="col-md-8 col-sm-8 col-xs-8">
                                <input type="text" class="form-control" name="" id="txt_record_code" class="" placeholder="Nhập mã hồ sơ"/>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <button class="btn btn-primary" id="btn_danh_gia">Đánh giá</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alertModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header mh_header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center tc_header" id="myModalLabel">Thông báo</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
