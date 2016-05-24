var dvc_service = {};

$(function () {

//    $('.b2 a').click(function () {
//        return false;
//    });
//    $('.b3 a').click(function () {
//        return false;
//    });
//    $('.b4 a').click(function () {
//        return false;
//    });

    $('#form_b1').submit(function (event) {
        event.preventDefault();
        $(".b2>span").addClass('b_span_d_block');
        $(".b2>span").removeClass('b_span_d_none');
        $(".b2>span").addClass('b2_span_active');
        $(".b2").addClass('b2_active');
        $(".b3").removeClass('b3_active');
        $(".b1>span,.b3>span,.b4>span").addClass('b_span_d_none');
        $(".b1>span").removeClass('b1_span_db');
        $('#buoc1').removeClass('active');
        $('#buoc2').addClass('active');
        $('.b1').removeClass('active');
        $('.b2').addClass('active');
    });

    $('#form_b2').submit(function (event) {
        event.preventDefault();
        if ($('#chkConfirm').is(":checked"))
        {
            $('#txtNameHS').val($('#txtName').val());
            $('#txtPhoneHS').val($('#txtPhone').val());
            $('#txtCmtHS').val($('#txtCmt').val());
            $('#txtEmailHS').val($('#txtCmt').val());
            $('#txtAddressHS').val($('#txtAddress').val());
        }
        $(".b3>span").addClass('b_span_d_block');
        $(".b3>span").removeClass('b_span_d_none');
        $(".b2>span").addClass('b2_span_active');
        $(".b3>span").addClass('b3_span_active');
        $(".b2").addClass('b2_active');
        $(".b3").addClass('b3_active');
        $(".b2>span,.b1>span,.b4>span").addClass('b_span_d_none');
        $(".b1>span").removeClass('b1_span_db');
        $('#buoc2').removeClass('active');
        $('#buoc3').addClass('active');
        $('.b2').removeClass('active');
        $('.b3').addClass('active');
    });

    $('#form_b3').submit(function (event) {
        event.preventDefault();
        $(".b3>span").addClass('b_span_d_block');
        $(".b3>span").removeClass('b_span_d_none');
        $(".b2>span").addClass('b2_span_active');
        $(".b3>span").addClass('b3_span_active');
        $(".b2").addClass('b2_active');
        $(".b3").addClass('b3_active');
        $(".b2>span,.b1>span,.b4>span").addClass('b_span_d_none');
        $(".b1>span").removeClass('b1_span_db');
        $('#buoc3').removeClass('active');
        $('#buoc4').addClass('active');
        $('.b3').removeClass('active');
        $('.b4').addClass('active');
    });

    $(".b2>span,.b3>span,.b4>span").addClass('b_span_d_none');
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

    $('#bt1Back').click(function () {
        $('.b1').addClass('active');
        $('.b1').addClass('b1_span_db');
        $('.b1>span').removeClass('b_span_d_none');
        $(".b2").removeClass('b2_active active');
        $('.b2>span').removeClass('b2_span_active');
        $('.b2>span').addClass('b_span_d_none');
        $('#buoc2').removeClass('active');
        $('#buoc1').addClass('active');
        $('.b2').removeClass('active');
        $('.b1').addClass('active');
    });
    $('#bt2Back').click(function () {
        $('.b2').addClass('active');
        $('.b2').addClass('b1_span_db');
        $('.b2>span').removeClass('b_span_d_none');
        $(".b3").removeClass('b3_active active');
        $('.b3>span').removeClass('b3_span_active');
        $('.b3>span').addClass('b_span_d_none');
        $('#buoc3').removeClass('active');
        $('#buoc2').addClass('active');
        $('.b3').removeClass('active');
        $('.b2').addClass('active');
    });
    $('#bt3Back').click(function () {
        $('.b4').addClass('active');
        $('.b4').addClass('b1_span_db');
        $('.b3>span').removeClass('b_span_d_none');
        $(".b4").removeClass('b3_active active');
        $('.b4>span').removeClass('b3_span_active');
        $('.b4>span').addClass('b_span_d_none');
        $('#buoc4').removeClass('active');
        $('#buoc3').addClass('active');
        $('.b4').removeClass('active');
        $('.b3').addClass('active');
    });

    sv.data.all_member('', function (resp) {
        var html = '<option value="">-- Chọn đơn vị --</option>';
        $.each(resp, function (i, item) {
            html += '<option value="' + i + '">' + item + '</option>';
        });
        $('#selMember').html(html);
    });
    $('#selMember').change(function () {
        var data = {'C_MEMBER_CODE': $(this).val()};
        sv.data.get_all_linh_vuc(data, function (resp) {
            var html = '<option value="">-- Chọn lĩnh vực --</option>';
            $.each(resp, function (i, item) {
                html += '<option value="' + item.C_CODE + '">' + item.C_NAME + '</option>';
            });
            $('#selSta').html(html);
        });
    });
    $('#selSta').change(function () {
        var data = {'C_SPEC_CODE': $(this).val(), 'C_MEMBER_CODE': $('#selMember').val()};
        sv.data.get_record_type_by_spec(data, function (resp) {
            console.log(resp);
            var html = '<option value="">-- Chọn hồ sơ --</option>';
            $.each(resp, function (i, item) {
                html += '<option value="' + item.PK_RECORD_TYPE + '">' + item.C_NAME + '</option>';
            });
            $('#selType').html(html);
        });
    });
//    $('#btnAddRecord').click(function () {
//        var form1_data = $('#form_b1').serialize();
//        var form2_data = $('#form_b2').serialize();
//        var form3_data = $('#form_b3').serialize();
//        var data = form1_data + '&' + form2_data + '&' + form3_data;
//        sv.data.add_record(data, function (resp) {
//            console.log(resp);
//        });
//    });
    $('#form_b4').submit(function (event) {
        event.preventDefault();
        var form1_data = $('#form_b1').serialize();
        var form2_data = $('#form_b2').serialize();
        var form3_data = $('#form_b3').serialize();
        var form4_data = $('#form_b4').serialize();
        var form_data = form1_data + '&' + form2_data + '&' + form3_data + '&' + form4_data;
//        var data = {'FORM_DATA' : form_data, 'CAPCHA' : $(this).serialize()};
        sv.data.add_record(form_data, function (resp) {
            jQuery("#recaptcha_reload").click();
            if (resp.stt == 'done') {
                alert(resp.msg_error);
                $("#frmCQ")[0].reset();
                $("#msg_error_captchar").html("");
            } else {
                if (respone.stt == 'false_captcha') {
                    $("#msg_error_captchar").html(resp.msg_error)
                } else {
                    alert(resp.msg_error);
                }
            }
            console.log(resp);
        });
    });
});