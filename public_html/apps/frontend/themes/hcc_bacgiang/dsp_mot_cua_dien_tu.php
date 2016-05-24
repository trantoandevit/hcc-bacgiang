<script type="text/javascript">
    var SITE_ROOT = '<?php echo SITE_ROOT; ?>';
    var _CONST_LIST_DELIM = '<?php echo _CONST_LIST_DELIM; ?>';
</script>
<script src="<?php echo CONST_SITE_THEME_ROOT ?>js/jquery-2.2.3.min.js"></script>
<script src="<?php echo CONST_SITE_THEME_ROOT ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo CONST_SITE_THEME_ROOT ?>js/my_js/services.js"></script>
<script type='text/javascript' src="<?php echo CONST_SITE_THEME_ROOT ?>js/my_js/mot-cua-dien-tu/mot-cua-dien-tu.js"></script>
<section>
    <link href="<?php echo CONST_SITE_THEME_ROOT ?>css/bootstrap.min.css" rel="stylesheet">
    <div class="content">
        <div class="col-xs-3 sb-r2" id="sb-r1-2">
            <div class="row">
                <div class="sb-2">
                    <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Rectangle-2111.png">
                </div>
                <div id="statistic-2" class="text-center notice_2">
                    <p class="text-center notice_2_1">Một cửa điện tử</p>
                    <p class="text-center notice_2_2">Tháng <?php echo DATE('m') . '/' . DATE('Y') ?></p>
                    <p class="text-center notice_2_3">Tỉnh Bắc Giang giải quyết</p>
                    <p class="text-center notice_2_4 statistic-percent" ></p>
                    <p class="text-center notice_2_5">Hồ sơ đúng hạn</p>
                    <p class="text-center notice_2_6 statistic-date">(Tự động cập nhật: 07-04-2016)</p>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    #statistic-2
    {
        color: #ffffff;
        position: absolute;
        z-index: 500;
        top: 20%;
        width: 100%;
    }
    .sb-2 img
    {
        width:100%;
    }
    p.text-center.notice_2_1 {
        font-size: 20px;
        text-transform: uppercase;
        font-weight: bold;
    }
    .notice_2_4 {
        font-size: 35px;
        line-height: 30px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .notice_2_2, .notice_2_3, .notice_2_5, .notice_2_6 {
        font-size: 14px;
        font-weight: 400 !important;
        line-height: 10px;
    }
</style>