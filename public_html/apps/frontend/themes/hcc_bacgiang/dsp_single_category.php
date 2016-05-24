<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array('single_cat');
print_r();
$VIEW_DATA['arr_script'] = array('my_js/right_sidebar/right_sidebar', 'my_js/category/category');

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<script>
    var website_id = '<?php echo $this->website_id;?>';
    var cat_id = '<?php echo get_request_var('category_id','')?>';
    var rows_per_page = '<?php echo _CONST_DEFAULT_ROWS_PER_PAGE;?>';
</script>
<section>
    <div class="content">
        <div class="container" id="categoy-details">
            <div class="row">
                <div class="col-md-9 left_sidebar_cat">
                    <div class="row n1">
                        <div class="col-md-8 lsc_head">
                            <h3>Tin tức</h3>
                        </div>
                        <div class="col-md-4 lsc_content">
                            <input type="text" class="form-control" id="txt_searh" placeholder="Nhập từ khóa...">
                            <div class="i_search">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div_all_art">
                    </div>
                    <div class="row xem_them text-center">
                        <button type="button" value="1" class="btn btn-primary">Xem thêm</button>
                    </div>
                </div>
                <?php
                $this->render('dsp_right_sidebar', $VIEW_DATA, $this->theme_code);
                ?>
            </div>
        </div>
    </div>
    <div class="clearfix" style="height: 10px;">
    </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);