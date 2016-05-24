<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php

$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array("guide","bootstrap-nav-wizard.min");
$VIEW_DATA['arr_script'] = array("guide");

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 l_left">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-12 l_menu">
                            <div class="lm_head">
                                <ul class="list-unstyled">
                                    <li>
                                        <button class="btn btn-default dk_tk">
                                            <i class="fa fa-arrows"></i> Hướng dẫn đăng ký tài khoản
                                        </button>
                                    </li>
                                    <li>
                                        <button class="btn btn-default g_hstt">
                                            <i class="fa fa-arrows"></i> Hướng dẫn gừi hồ sơ trực tuyến
                                        </button>
                                    </li>
                                    <li>
                                        <button class="btn btn-default tc_hs">
                                            <i class="fa fa-arrows"></i> Hướng dẫn tra cứu hồ sơ
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 l_right">
                    <div class="tab_content">
                        <div class="div_dktk">
                            <div class="lr_head">
                                <div class="row hd_head">
                                    <div class="col-md-12">
                                        <div class="hdh_head">
                                            <ul class="nav nav-tabs nav-wizard" >
                                                <li class="active b1">
                                                    <a href="#buoc1" data-toggle="tab">Bước <span>1</span></a>
                                                    <span>Truy cập vào trang hcc.bacgiang.gov.vn</span>
                                                </li>
                                                <!--<li class="li_hd">Truy cập vào trang hcc.bacgiang.gov.vn</li>-->
                                                <li class="b2">
                                                    <a href="#buoc2" data-toggle="tab">Bước <span>2</span></a>
                                                    <span>Tiếp bước 2</span>
                                                </li>
                                                <li class="b3">
                                                    <a href="#buoc3" data-toggle="tab">Bước <span>3</span></a>
                                                    <span>Tiếp bước 3</span>
                                                </li>
                                                <li class="b4">
                                                    <a href="#buoc4" data-toggle="tab">Bước <span>4</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="buoc1" role="tabpanel">
                                            <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/home_hd.png" alt="" />       
                                        </div>
                                        <div class="tab-pane" id="buoc2" role="tabpanel">Bước 2</div>
                                        <div class="tab-pane" id="buoc3" role="tabpanel">Bước 3</div>
                                        <div class="tab-pane" id="buoc4" role="tabpanel">Bước 4</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="div_ghstt">
                            <div class="lr_head">
                                <div class="row hd_head">
                                    <div class="col-md-12">
                                        <div class="hdh_head">
                                            <ul class="nav nav-tabs nav-wizard" >
                                                <li class="active b1">
                                                    <a href="#buoc11" data-toggle="tab">Bước <span>1</span></a>
                                                    <span>Truy cập vào trang hcc.bacgiang.gov.vn</span>
                                                </li>
                                                <li class="b2">
                                                    <a href="#buoc22" data-toggle="tab">Bước <span>2</span></a>
                                                    <span>Tiếp bước 2</span>
                                                </li>
                                                <li class="b3">
                                                    <a href="#buoc33" data-toggle="tab">Bước <span>3</span></a>
                                                    <span>Tiếp bước 3</span>
                                                </li>
                                                <li class="b4">
                                                    <a href="#buoc44" data-toggle="tab">Bước <span>4</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="buoc11" role="tabpanel">Bước 1</div>
                                        <div class="tab-pane" id="buoc22" role="tabpanel">Bước 2</div>
                                        <div class="tab-pane" id="buoc33" role="tabpanel">Bước 3</div>
                                        <div class="tab-pane" id="buoc44" role="tabpanel">Bước 4</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="div_tchs">
                            <div class="lr_head">
                                <div class="row hd_head">
                                    <div class="col-md-12">
                                        <div class="hdh_head">
                                            <ul class="nav nav-tabs nav-wizard" >
                                                <li class="active b1">
                                                    <a href="#buoc111" data-toggle="tab">Bước <span>1</span></a>
                                                    <span>Truy cập vào trang hcc.bacgiang.gov.vn</span>
                                                </li>
                                                <li class="b2">
                                                    <a href="#buoc222" data-toggle="tab">Bước <span>2</span></a>
                                                    <span>Tiếp bước 2</span>
                                                </li>
                                                <li class="b3">
                                                    <a href="#buoc333" data-toggle="tab">Bước <span>3</span></a>
                                                    <span>Tiếp bước 3</span>
                                                </li>
                                                <li class="b4">
                                                    <a href="#buoc444" data-toggle="tab">Bước <span>4</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="buoc111" role="tabpanel">Bước 1</div>
                                        <div class="tab-pane" id="buoc222" role="tabpanel">Bước 2</div>
                                        <div class="tab-pane" id="buoc333" role="tabpanel">Bước 3</div>
                                        <div class="tab-pane" id="buoc444" role="tabpanel">Bước 4</div>
                                    </div>
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
