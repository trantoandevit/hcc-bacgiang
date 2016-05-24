<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array("list_tthc");
$VIEW_DATA['arr_script'] = array("my_js/list_tthc/list_tthc");

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<script>
    var _CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT = '<?php echo _CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT?>';
</script>
<section>
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-md-12 l_right">
                    <div class="lr_top">
                        <h3>Tìm kiếm</h3>
                        <form action="" class="form">
                            <div class="row qrf_row">
                                <label class="col-sm-2 control-label text-right">Từ khóa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="" id="txt_tu_khoa">
                                </div>
                            </div>
                            <div class="row qrf_row">
                                <label class="col-sm-2 control-label text-right">Cơ quan thực hiện</label>
                                <div class="col-sm-4">
                                    <select class='form-control' id="sel-tthc-member">
                                        <option value="-1">--- Tất cả ---</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 control-label text-right">Lĩnh vực</label>
                                <div class="col-sm-4">
                                    <select class='form-control' id="sel-tthc-spec" disabled>
                                    </select>
                                </div>
                            </div>

                            <div class="row qrf_row">
                                <label class="col-sm-2 control-label text-right">Mức độ</label>
                                <div class="col-sm-4">
                                    <div class="btn_r_search">
                                        <select class='form-control ' id="sel_muc_do" >
                                            <option value="-1">--- Tất cả ---</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div class="btn_r_search">
                                        <button type="button" class="btn btn-primary qrf_row_btn" id="btn-tthc-filter">Tìm kiếm thủ tục <i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="lr_bottom">
                    <div class="row">
                        <div class="col-md-12 lrb_content">
                            <table class='table table-striped table-bordered' id="table-list-tthc">
                                <colgroup>
                                    <col width="3%"/>
                                    <col width="50%"/>
                                    <col width="20%"/>
                                    <col width="20%"/>
                                    <col width="7%"/>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th class="text-center">Tên thủ tục</th>
                                        <th class="text-center">Tên lĩnh vực</th>
                                        <th class="text-center">Cơ quan thực hiện</th>
                                        <th class="text-center">Mức độ</th>
                                    </tr>
                                </thead>
                                <colgroup>
                                    <col width="3%"/>
                                    <col width="50%"/>
                                    <col width="20%"/>
                                    <col width="20%"/>
                                    <col width="7%"/>
                                </colgroup>
                            </table>
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
</div>
</section>
<div class="modal fade" id="myModalTTHC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog md_tra_cuu">
        <div class="modal-content">
            <div class="modal-header mh_header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center tc_header" id="myModalLabel">Hướng dẫn TTHC</h4>
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

