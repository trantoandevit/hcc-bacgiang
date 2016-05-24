<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array("list_unit");
$VIEW_DATA['arr_script'] = array('my_js/right_sidebar/right_sidebar', 'my_js/list_unit/list_unit');

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 c_left" id="list-member">
                    <div class="row">
                        <div class="col-md-12 lu_top">
                            <div class="lut_head">
                                <h3>Cấp sở - Ban ngành</h3>
                            </div>
                            <div class="lut_content">
                                <div class="row">
                                    <div class="list_unit">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 lu_bottom">
                            <div class="lub_head">
                                <h3>Cấp huyện - Thành phố</h3>
                            </div>
                            <div class="lub_content">
                                <div class="row">
                                    <div class="list_unit_huyen">
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $this->render('dsp_right_sidebar', $VIEW_DATA, $this->theme_code);
                ?>
            </div>

        </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
