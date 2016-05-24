$(function () {
    $(".b2>span,.b3>span,.b4>span").addClass('b_span_d_none');
    $(".div_ghstt, .div_tchs").hide();
    $(".b1").click(function () {
        $(".b2>span, .b3>span").removeClass('b2_span_active');
        $(".b2>span,.b3>span").addClass('b_span_d_none');
        $(".b2").removeClass('b2_active');
        $(".b3").removeClass('b3_active');
        $(".b1>span").addClass('b1_span_db');
    });
    $(".b2").click(function () {
        $(".b2>span").addClass('b_span_d_block');
        $(".b2>span").removeClass('b_span_d_none');
        $(".b2>span").addClass('b2_span_active');
        $(".b2").addClass('b2_active');
        $(".b3").removeClass('b3_active');
        $(".b1>span,.b3>span,.b4>span").addClass('b_span_d_none');
        $(".b1>span").removeClass('b1_span_db');
    });
    $(".b3").click(function () {
        $(".b3>span").addClass('b_span_d_block');
        $(".b3>span").removeClass('b_span_d_none');
        $(".b2>span").addClass('b2_span_active');
        $(".b3>span").addClass('b3_span_active');
        $(".b2").addClass('b2_active'); 
        $(".b3").addClass('b3_active');
        $(".b2>span,.b1>span,.b4>span").addClass('b_span_d_none');
        $(".b1>span").removeClass('b1_span_db');
    });



    $(".dk_tk").click(function () {
        $(".div_dktk").show();
        $(".div_ghstt").hide();
        $(".div_tchs").hide();
    });
    $(".g_hstt").click(function () {
        $(".div_dktk").hide();
        $(".div_ghstt").show();
        $(".div_tchs").hide();
    });
    $(".tc_hs").click(function () {
        $(".div_tchs").show();
        $(".div_dktk").hide();
        $(".div_ghstt").hide();
    });
    
});
