<?php
$VIEW_DATA['title'] = $this->website_name . ' - ' . __('van_ban_phap_quy');
$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array("list_tthc");
$VIEW_DATA['arr_script'] = array('my_js/doc/doc');
$this->render('dsp_header', $VIEW_DATA, $this->theme_code);


$keywords = $v_title;
$txt_tim_nang_cao = get_request_var('txt_tim_nang_cao', 0);
?>    
<section>
    <div class="content page-van-ban">
        <div class="container">
            <div class="row">
                <div class="clearfix" style="height: 15px;"></div>
                <div class="col-md-3 l_left">
                    <div class="row">
                        <div id="box_no_1">
                            <div class="panel panel-default">
                                <div class="widget-title"><a ><span style="line-height:17px;"><img src="<?php echo SITE_ROOT . "public/images/slider/icon_2.png" ?>" /></span> Cơ quan ban hành</a></div>
                                <div class="panel-body  no-padding-left" id="coQuanBanHanh">
                                </div>
                            </div>
                        </div>
                        <div id="box_no_2">
                            <div class="panel panel-default">
                                <div class="widget-title"><a ><span style="line-height:17px;"><img src="<?php echo SITE_ROOT . "public/images/slider/icon_2.png" ?>" /></span> Lĩnh vực thống kê</a></div>
                                <div class="panel-body no-padding-left" id="linhVuc">                             
                                </div>
                            </div>
                        </div>
                        <div id="box_no_3">
                            <div class="panel panel-default">
                                <div class="widget-title"><a><span style="line-height:17px;"><img src="<?php echo SITE_ROOT . "public/images/slider/book.png" ?>" /></span> Văn bản pháp quy mới</a></div>
                                <div class="panel-body no-padding-left" id="doc">
                                    <ul >
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 l_right">

                    <div id="box_main" >
                        <div class="panel panel-default" style="border: 0">
                            <fieldset>
                                <legend>Tìm kiếm</legend>
                                <div class="col-md-12">
                                    <div class="col-sm-12 no-padding" id="frm_search">
                                        <div class="col-sm-12">
                                            <div id="txt_help" class="vbpq_search_form_help_content <?php echo $txt_tim_nang_cao == 1 ? 'hide' : '' ?>"> 
                                                <span class="search_form_title">Tìm kiếm văn bản chỉ đạo điều hành</span> <br> 
                                                <span class="help_content"> Nhập số hiệu văn bản,tên văn bản hoặc từ khóa liên quan đến nội dung văn bản vào ô tìm kiếm dưới đây. 
                                                    <br> Chọn tìm kiếm nâng cao để có thêm công cụ. 
                                                </span> 
                                            </div>
                                            <div id="form-search">
                                                <form class="form-horizontal" id="searchDocumentForm">
                                                    <input type="hidden" value="<?php echo $txt_tim_nang_cao ?>" id="txt_tim_nang_cao" name="txt_tim_nang_cao" />
                                                    <div class="form-group">
                                                        <div class="col-xs-12 no-padding">
                                                            <div class="col-sm-8  no-padding-right"><input type="text" class="form-control" value="<?php echo get_request_var('txt_title', '') ?>" id="txt_title" name="txt_title" placeholder="Tiêu đề/Số hiệu văn bản"></div>
                                                            <div class="col-sm-4 no-padding">
                                                                <button type="button" class="btn btn-default" id="btnSearchDocument">Tìm kiếm</button>
                                                                <span class="show_advanced_search_form" style="float: right"> 
                                                                    <div class="show_advanced"> 
                                                                        <a  href="javascript:;" onclick="show_hidden_frm_search(this)" style="line-height: 30px;"><?php echo ($txt_tim_nang_cao == 1) ? 'Tìm kiếm cơ bản' : 'Tìm kiếm nâng cao'; ?></a> 
                                                                    </div> 
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="frm-hide" class="<?php echo $txt_tim_nang_cao == 1 ? '' : 'hide' ?>">
                                                        <div class="form-group">
                                                            <div class="col-sm-12 no-padding">
                                                                <div class="col-sm-8 no-padding-right">
                                                                    <select name="sel_cqbh" id="sel_cqbh" class="form-control ">
                                                                        <option value="">-- Cơ quan ban hành --</option>
<?php foreach ($arrOrganization as $k => $Organization) : ?>
                                                                            <?php $selected = ($v_cqbh == $Organization['PK_CO_QUAN_BAN_HANH']) ? "selected='selected'" : ''; ?>
                                                                            <option <?php echo $selected; ?> value="<?php echo $Organization['PK_CO_QUAN_BAN_HANH'] ?>"><?php echo $Organization['C_NAME'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3 no-padding"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12 no-padding">
                                                                <div class="col-sm-8 no-padding-right">
                                                                    <select name="sel_lvtk" id="sel_lvtk" class="form-control ">
                                                                        <option value="">-- Lĩnh vực thống kê --</option>
<?php foreach ($arrStatistics as $key => $Statistics) : ?>
                                                                            <?php $selected = ($v_lvtk == $Statistics['PK_LINH_VUC_VAN_BAN']) ? "selected='selected'" : ''; ?>
                                                                            <option  <?php echo $selected; ?> value="<?php echo $Statistics['PK_LINH_VUC_VAN_BAN'] ?>"><?php echo $Statistics['C_NAME'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3 no-padding"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12 no-padding">
                                                                <div class="col-sm-8 no-padding-right">
                                                                    <select name="sel_loai_vb" id="sel_loai_vb" class="form-control ">
                                                                        <option value="">-- Loại văn bản --</option>
<?php foreach ($arrDocType as $col => $DocType) : ?>
                                                                            <?php $selected = ($v_loai_vb == $DocType['C_LOAI_VAN_BAN']) ? "selected='selected'" : ''; ?>
                                                                            <option <?php echo $selected; ?> value="<?php echo $DocType['C_LOAI_VAN_BAN'] ?>"><?php echo $DocType['C_LOAI_VAN_BAN'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3 no-padding"></div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                            <div class="panel-body">
                                <div class="row no-padding-left no-padding-right">
                                    <div class="col-xs-12 no-padding">
                                        <div class="col-xs-9 no-padding pull-left">
                                            <label class="control-label">Danh sách văn bản pháp quy</label>
                                        </div>
                                        <div class="col-xs-3 pull-right text-right">
                                            <a href="van-ban" class="btn btn_submit"><i class="fa fa-list"></i>&nbsp;Hiển thị toàn bộ</a>
                                        </div>
                                    </div>

                                    <table class="table table-bordered table-hover" id="tbl_list_doc" >
                                        <thead>
                                            <tr  class="rs_header">
                                                <th style="width:5%;vertical-align: middle;" class="text-center">#</th>
                                                <th style="width:15%;vertical-align: middle;" class="text-center">Số hiệu</th>
                                                <th style="width:60%;vertical-align: middle;" class="text-center">Tên văn bản</th>
                                                <th style="width:15%;vertical-align: middle;" class="text-center">Ngày ban hành</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="col-md-12 text-right pag_bottom">
                                        <ul class="list-unstyled list-inline ul_pag"></ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    var i = '<?php echo $txt_tim_nang_cao; ?>';
    function show_hidden_frm_search(anchor)
    {
        if ($(anchor).text() == 'Tìm kiếm cơ bản')
        {
            $(anchor).text('Tìm kiếm nâng cao');
        }
        else
        {
            $(anchor).text('Tìm kiếm cơ bản');
        }

        if (i == 0)
        {
            $("#txt_help").addClass('hide');
            $('#frm-hide').removeClass("hide");
            i++;
            $('#txt_tim_nang_cao').val(1);
        }
        else
        {
            $('#txt_tim_nang_cao').val(0);
            $("#frm-hide").addClass('hide');
            $('#txt_help').removeClass("hide");
            i = 0;
            $('#sel_cqbh').val('');
            $('#sel_lvtk').val('');
            $('#sel_loai_vb').val('');
        }
    }
</script>
<?php
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
