
<?php
$this->count_video = 0;
Session::init();
?>
<?php
//du lieu header
$VIEW_DATA['title']                 = isset($arr_single_article['C_TITLE']) ? $arr_single_article['C_TITLE'] : $this->website_name;
$VIEW_DATA['v_banner']              = $v_banner;
$VIEW_DATA['arr_all_website']       = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['v_keywords']            = isset($arr_single_article['C_KEYWORDS']) ? $arr_single_article['C_KEYWORDS'] : '';
$VIEW_DATA['v_description']         = isset($arr_single_article['C_SUMMARY']) ? remove_html_tag($arr_single_article['C_SUMMARY']) : '';
//du lieu content
$v_article_sub_title                = isset($arr_single_article['C_SUB_TITLE']) ? $arr_single_article['C_SUB_TITLE'] : '';
$v_article_title                    = isset($arr_single_article['C_TITLE']) ? $arr_single_article['C_TITLE'] : '';
$v_begin_date                       = isset($arr_single_article['C_BEGIN_DATE']) ? $arr_single_article['C_BEGIN_DATE'] : '';

$v_article_sumary                   = isset($arr_single_article['C_SUMMARY']) ? $arr_single_article['C_SUMMARY'] : '';
$v_article_sumary = htmlspecialchars_decode($v_article_sumary);

$v_article_content                  = isset($arr_single_article['C_CONTENT']) ? $arr_single_article['C_CONTENT'] : '';
$v_article_content = htmlspecialchars_decode($v_article_content);

$v_xml_other_news                   = isset($arr_single_article['C_XML_OTHER_NEWS']) ? $arr_single_article['C_XML_OTHER_NEWS'] : '';
$v_category_slug                    = isset($arr_single_article['C_SLUG_CAT']) ? $arr_single_article['C_SLUG_CAT'] : '';
$v_pen_name                         = isset($arr_single_article['C_PEN_NAME']) ? $arr_single_article['C_PEN_NAME'] : '';
$article_slug                       = isset($arr_single_article['C_SLUG_ARTICLE']) ? $arr_single_article['C_SLUG_ARTICLE'] : '';
$v_media_file_name                  = isset($arr_single_article['C_FILE_NAME']) ? $arr_single_article['C_FILE_NAME'] : '';
$v_article_tags                     = isset($arr_single_article['C_TAGS']) ? $arr_single_article['C_TAGS'] : '';
//vote
$rating_result                      = isset($arr_single_article['C_CACHED_RATING']) ? $arr_single_article['C_CACHED_RATING'] : 0;
$rating_count                       = isset($arr_single_article['C_CACHED_RATING_COUNT']) ? $arr_single_article['C_CACHED_RATING_COUNT'] : 0;
$v_type                             = isset($arr_single_article['C_TYPE']) ? $arr_single_article['C_TYPE'] : '';

$website_id        = get_request_var('website_id', 0);
$category_id       = get_request_var('category_id', 0);
$article_id        = get_request_var('article_id', 0);



$VIEW_DATA['arr_css']               = array();
$VIEW_DATA['arr_script'] = array();
$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<div class="row single-article" style="    min-height: 568px;">
    
    <div class="col-sm-3 " id="left-side-bar">
        <?php 
            render_widget('widget_left_to_chuc_bo_may',$arr_all_widget_position);
        ?>
    </div>
    
    
    
    
    <div class="col-sm-9 block"  style="    border: 1px solid #d2d2d2;border-top:none;padding: 0;min-height: 300px">
        <div class="news-title">
            <a  >
                <span style="line-height:17px;">
                    <img src="<?php echo CONST_SITE_THEME_ROOT?>images/icon-title-article-tcbm.png">
                </span>
                <?php echo "<span>$v_article_title</span>";?>
            </a>
            <span class="bg-cat-title-left"></span>
            <span class="bg-cat-title-right"></span>
        </div>
        
        <div class="pageContent" style="padding: 0 10px"> 
            <div id="divArticleContent">
                <?php echo $v_article_content; ?>
                <?php if (count($arr_attachment) >0 ): ?>
                        <div class="div_file_attach">
                            <div>
                                <label><?php echo __('Tập tin đính kèm:') ?></label>
                            </div>
                            <br>
                            <?php foreach ($arr_attachment as $file_attach): ?>
                            <a title="<?php echo strval($file_attach['C_FILE_NAME']); ?>" style="color: transparent;" target="_blank" class="attacment" href="<?php echo SITE_ROOT . "upload/" . strval($file_attach['C_FILE_NAME']); ?>">
                                <img src="<?php echo CONST_SITE_THEME_ROOT; ?>images/attachment.png" />
                            </a>
                                <br>
                            <?php endforeach; ?>
                            <br/>
                        </div>
                <?php endif; ?>
                <?php if ($v_article_tags != ''): ?>
                    <div id="div_tags">
                        <h2 class="h2Acticle"></span></h2>
                        <?php
                        $arr_tags = explode(',', $v_article_tags);
                        ?>
                        <?php echo __('tag: '); ?>
                        <?php foreach ($arr_tags as $row_tags): ?>
                            <a href="<?php echo build_url_tags($website_id, $row_tags) ?>"><?php echo $row_tags; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
               
                <div class="clear" style="height: 10px;"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

</div>

<script>
    function print_onclick()
    {
        str="<?php echo build_url_print($v_category_slug, $article_slug, $website_id, $category_id, $article_id) ?>";
        window.open(str,"",'scrollbars=1,width=700,height=600');
    }
</script>
<?php
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
?>