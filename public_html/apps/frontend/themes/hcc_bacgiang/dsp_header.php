<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <!-- Bootstrap -->
        <link href="<?php echo CONST_SITE_THEME_ROOT ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo CONST_SITE_THEME_ROOT ?>css/font-opensans.css" rel="stylesheet">
        <link href="<?php echo CONST_SITE_THEME_ROOT ?>css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo CONST_SITE_THEME_ROOT ?>styles.css" media="screen" title="no title" charset="utf-8" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo CONST_SITE_THEME_ROOT ?>css/mobile.css" media="screen" title="no title" charset="utf-8">
        <link href="<?php echo CONST_SITE_THEME_ROOT ?>css/jquery.bxslider.css" rel="stylesheet">
        <script src="<?php echo CONST_SITE_THEME_ROOT ?>js/jquery-2.2.3.min.js"></script>
        <script src="<?php echo CONST_SITE_THEME_ROOT ?>js/jquery.js"></script>
        <script src="<?php echo CONST_SITE_THEME_ROOT ?>js/bootstrap.min.js"></script>
        <script src="<?php echo CONST_SITE_THEME_ROOT ?>js/slide.js"></script>
        <script src="<?php echo CONST_SITE_THEME_ROOT ?>js/jquery.bxslider.min.js"></script>
        <script src="<?php echo CONST_SITE_THEME_ROOT ?>js/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="<?php echo CONST_SITE_THEME_ROOT ?>js/loader.js"></script>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57203db1c54e39c4"></script>

        <script>
            var SITE_ROOT = '<?php echo SITE_ROOT ?>';
            var website_id = '<?php echo $this->website_id ?>';
            var _CONST_CLIENT_CAPTCHA_PUBLIC_KEY = '<?php echo _CONST_CLIENT_CAPTCHA_PUBLIC_KEY ?>';
            var _CONST_SERVER_CAPTCHA_PRIVATE_KEY = '<?php echo _CONST_SERVER_CAPTCHA_PRIVATE_KEY ?>';
        </script>
        <!--my js-->
        <script type="text/javascript" src="<?php echo CONST_SITE_THEME_ROOT ?>js/my_js/services.js"></script>
        <script type="text/javascript" src="<?php echo CONST_SITE_THEME_ROOT ?>js/my_js/header.js"></script>
        <script type="text/javascript" src="<?php echo CONST_SITE_THEME_ROOT ?>js/my_js/lookup_record.js"></script>

        <?php
        $arr_css = isset($arr_css) ? $arr_css : array();
        $arr_script = isset($arr_script) ? $arr_script : array();

        function add_css_javascript($arr_css, $arr_script) {
            //css
            $html_css = '';
            foreach ($arr_css as $value) {
                $html_css .= "<link rel='stylesheet' href='" . CONST_SITE_THEME_ROOT . 'css/' . $value . ".css'> \n";
            }
            echo $html_css;

            //javascript
            $html_javascript = '';
            foreach ($arr_script as $value) {

                $html_javascript .= "<script type='text/javascript' src='" . CONST_SITE_THEME_ROOT . "js/" . $value . ".js'></script>\n";
            }
            echo $html_javascript;
        }

        add_css_javascript($arr_css, $arr_script);
        ?>

    </head>
    <body>


        <div id="wrapper">
            <header>
                <div class="header container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="logo">
                                <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/logo.png" alt="Slide">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="contact">
                                <div class="bg_deco">
                                    <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/deco-bg.png" alt="">
                                </div>
                                <div class="box_contact">
                                    <div class="ct_icon"><i class="fa fa-phone fa-lg"></i> </div>
                                    <div class="ct_sdt">
                                        <h4>Điện thoại liên hệ</h4>
                                        <h3>0240.1234567</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="menu container">
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo FULL_SITE_ROOT ?>">Trang chủ</a></li>
                                    <li><a href="<?php echo FULL_SITE_ROOT ?>danh-sach-thu-tuc-hanh-chinh">Hướng dẫn TTHC</a></li>
                                    <li><a href="<?php echo FULL_SITE_ROOT ?>tra-cuu-tong-hop">Tra cứu tổng hợp</a></li>
                                    <li><a href="<?php echo FULL_SITE_ROOT ?>dich-vu-cong">Dịch vụ công</a></li>
                                    <li><a href="<?php echo FULL_SITE_ROOT ?>danh-gia-can-bo">Đánh giá cán bộ</a></li>
                                    <li><a href="<?php echo FULL_SITE_ROOT ?>hoi-dap">Hỏi đáp</a></li>

                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </nav>
                    </div>
                </div>
                <!--hien thi tin bai noi bat-->
                <div class="news container">
                    <div class="box_news" style="overflow: hidden;width:100%">
                        <div class="row">
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm" style="float:left" name="button">TIN MỚI</button>
                            </div>
                            <div class="col-md-11">
                                <div class="mar_quee">
                                    <marquee vspace="1" height="28px" behavior="scroll" valign="middle" direction="left"  scrolldelay="20" onmouseout="this.start()" onmouseover="this.stop()" style="height: 43px;">
                                         
                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>