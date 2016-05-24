<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['arr_css'] = array();
$VIEW_DATA['arr_script'] = array('my_js/article/article','my_js/right_sidebar/right_sidebar');

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);

$cat_id = get_request_var('category_id',0);
$art_id = get_request_var('article_id',0);
?>
<script>
    var cat_id = '<?php echo $cat_id?>';
    var art_id = '<?php echo $art_id?>';
</script>

<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 left_sidebar">
                    <div class="news_head">
                        <h2></h2>
                    </div>
                    <div class="news_date">
                        <h6></h6>
                    </div>
                    <div class="news-content">
                        <div class="intro_head">
                            <h4></h4>
                        </div>
                        <div class="news_fulltext">
                            
                        </div>
                    </div>
                    <div class="news_comment">
                        <div class="n_button">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="addthis_native_toolbox"></div>
                                </div>
                                <div class="col-md-2">
                                    <div class="n_in_trang">
                                        <i class="fa fa-print" onclick="window.print()">&nbsp;</i>
                                        <h3><button onclick="window.print()">In trang</button></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--        <div class="n_comment">
                                    <div class="row n_header">
                                        <div class="col-md-12 n_com_head">
                                            <div class="n_box"></div>
                                            <h3>Bình luận</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 col-sm-2 col-xs-2 n_com_acc n_com_acc">
                                            <div class="img_acc_com">
                                                <img src="<?php echo CONST_SITE_THEME_ROOT?>img/ng_comment.png">
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-sm-10 col-xs-10 n_com_con">
                                            <h5>Pham Long</h5>
                                            <p>Tôi thấy còn rất nhiều bộ phận, cá nhân dung túng trong việc dẹp nạn, lấn chiếm lòng và lề đường ở các tuyến đường TP HCM</p>
                                            <h6><i class="fa fa-thumbs-o-up"></i> 73 Thích</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 col-sm-2 col-xs-2 n_com_acc n_com_acc">
                                            <div class="img_acc_com">
                                                <img src="<?php echo CONST_SITE_THEME_ROOT?>img/ng_comment.png">
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-sm-10 col-xs-10 n_com_con">
                                            <h5>Phan Duc Hien</h5>
                                            <p>Rất hoan nghênh bí thư Thăng</p>
                                            <h6><i class="fa fa-thumbs-o-up"></i> 32 Thích</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                        
                                        </div>
                                        <div class="col-md-11 n_nhan_xet">
                                            <textarea class="form-control noresize" rows="3" placeholder="Ý kiến của bạn... (hỗ trợ kiểu gõ tiếng Việt Telex, VNI, VIQR,...)"></textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11 n_in">
                                            <ul class="list-unstyled list-inline">
                                                <li>
                                                    <i class="glyphicon glyphicon-check"></i> tối thiểu 10 chữ
                                                </li>
                                                <li>
                                                    <i class="glyphicon glyphicon-check"></i> tiếng việt có dấu
                                                </li>
                                                <li>
                                                    <i class="glyphicon glyphicon-check"></i> không chứa liên kết
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12 btn_gui_tin text-right">
                                            <button class="btn btn-default">Gửi bình luận</button>
                                        </div>
                                    </div>
                        
                                </div>-->
                    </div>
                </div>
                <?php
                    $this->render('dsp_right_sidebar', $VIEW_DATA, $this->theme_code);
                ?>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="sec_news">
        <div class="container best-news">
            <div class="row">
                <div class="col-md-9 new_header">
                    <h3>Tin tức mới nhất</h3>
                </div>
                <div class="col-md-3 see_more">
                    <a href="javascript:void(0)" >Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
