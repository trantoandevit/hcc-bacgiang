<div class="col-md-3 r2 right_sidebar">
    <div class="col-md-12 col-sm-12 col-xs-12 status s_r_top">
        <div class="status_header">
            <h3 class="text-center">Tra cứu tình trạng hồ sơ</h3>
        </div>
        <div class="status_content">
            <p>Để thực hiện tra cứu tình trạng hồ sơ cấp phép, xin vui lòng nhập mã số tra cứu trên giấy biên nhận.</p>
            <div class="row">
                <div class="col-md-8 col-sm-10 col-xs-8  tra-cuu-hs">
                    <input type="text" id="txt_record_code_lookup">
                </div>
                <div class="col-md-4 col-sm-2 col-xs-4 btn_tra_cuu">
                    <button type="button" class="btn btn-primary btn_tc" id="btn_lookup_record">
                        Tra cứu
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-4 col-xs-12 send_record">
        <button class="btnSend">
            <div class="icon_btn"><img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Shape_116.png"></div>
            <div class="btn_text">
                <h3>Gửi hồ sơ</h3>
                <h3 class="h3_2">Trực tuyến</h3>
            </div>
        </button>
    </div>
    <div class="col-md-12 col-sm-4 col-xs-12 thu-tuc-hanh-chinh">
        <a href="<?php echo FULL_SITE_ROOT ?>danh-sach-thu-tuc-hanh-chinh"><img src="<?php echo CONST_SITE_THEME_ROOT ?>img/thu-tuc-hanh-chinh.png"></a>

    </div>

    <div class="col-md-12 col-sm-6 col-xs-12 sb-r1" id="sb-r1-1">
        <div class="sb-1">
            <img src="<?php echo CONST_SITE_THEME_ROOT ?>img/Vector-Smart-Object3.png">
        </div>
        <div id="statistic-1" class="text-center notice_1">
            <p class="text-center notice_1_1">NĂM <?php echo DATE('Y') ?></p>
            <p class="text-center notice_1_2 total"></p>
            <p class="text-center notice_1_3">hồ sơ</p>
            <p class="text-center notice_1_4 receive"></p>
            <p class="text-center notice_1_5 done"></p>
        </div>

    </div>
    <div class="col-md-12 col-sm-6 col-xs-12 sb-r2" id="sb-r1-2">
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