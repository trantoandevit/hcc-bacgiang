$(function () {
    var id_modal = 'myModalTTHC';
    var filter = {
        page: 1,
        keyword: ''
    };
    var pagging = {
        first: 1,
        last: "",
        count: "",
        active: 1
    };
    var id_list_cq = 'list_cq';


    $('#list_cq').slimScroll({
        height: '490px'
    });

    $('#key_search_cq').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            pagging.active = 1;
            show_active_page(pagging.first);
            get_data();
        }
    });

    //Lay du lieu cau hoi
    get_data();
    function get_data() {
        filter.page = pagging.active;
        filter.keyword = $("#key_search_cq").val();

        sv.data.all_cq(filter, function (respone) {

            var html = '';
            var data = respone.data;
            var count_all_data = respone.count;
            var content = '';
            var date = '';
            var name = '';
            var title = '';
            var id = '';

            pagging.count = count_all_data;
            init_pagging();

            for (var index in data)
            {
                content = data[index].C_CONTENT;
                date = data[index].C_DATE_DDMMYYY;
                name = data[index].C_NAME;
                title = data[index].C_TITLE;
                id = data[index].PK_CQ;


                html += '<div class="col-md-12">';
                html += '   <div class="qrc_box">';
                html += '       <div class="row qrcb_head">';
                html += '           <div class="col-md-12">';
                html += '               <h3><i class="glyphicon glyphicon-question-sign"></i> ' + title + '</h3>';
                html += '           </div>';
                html += '       </div>';
                html += '       <div class="row qrcb_info_bottom">';
                html += '           <div class="col-md-12">';
                html += '               <h6>Người hỏi: ' + name + ' (' + date + ')</h6>';
                html += '           </div>';
                html += '       </div>';
                html += '       <div class="row qrcb_content">';
                html += '           <div class="col-md-12">' + htmlDecode(content) + '</div>';
                html += '       </div>';
                html += '       <div class="row qrcb_view">';
                html += '           <div class="col-md-12">';
                html += '               <h5><a href="javascript:void(0);" class="item_view_answer" data-id="' + id + '"><i class="fa fa-commenting-o"></i> Xem trả lời</a></h5>';
                html += '           </div>';
                html += '       </div>';
                html += '   </div>';
                html += '</div>';
            }
            $('#' + id_list_cq).html(html);

            $('#' + id_list_cq).find('.item_view_answer').each(function () {
                $(this).click(function (e) {
                    e.preventDefault();
                    var cq_id = $(this).attr('data-id');
                    $('#' + id_modal).modal('show');

                    sv.data.cq_detail(cq_id, function (respone) {
                        var html = "";
                        html += "<div class=\"row\">";
                        html += "<div class=\"col-md-12\">";
                        html += "    <ul class=\"list-unstyled\">";
                        html += "        <li><span class='a_head'>Trả lời ông/bà " + respone['C_NAME'] + " về việc:<\/span> " + respone['C_TITLE'] + "<\/li>";
                        html += "        <li><div class='row'><div class='col-md-6'><span>Email:<\/span> " + respone['C_EMAIL'] + "</div><div class='col-md-6'><span>Điện thoại:</span> " + respone['C_PHONE'] + "</div><\/li>";
                        html += "        <li><span>Ngày:<\/span> " + respone['C_DATE'] + "<\/li>";
                        html += "        <li>";
                        html += "            <h4>Hỏi:<\/h4> ";
                        html += "            <div class=\"content_question\">";
                        html += "                " + htmlDecode(respone['C_CONTENT']) + "";
                        html += "            <\/div>";
                        html += "        <\/li>";
                        html += "        <li>";
                        html += "            <h4>Trả lời:<\/h4> ";
                        html += "            <div class=\"content_answer\">";
                        html += "                " + htmlDecode(respone['C_ANSWER']) + "";
                        html += "            <\/div>";
                        html += "        <\/li>";
                        html += "    <\/ul>";
                        html += "<\/div>";
                        html += "<\/div>";


                        $('#' + id_modal).find('.detail').html(html);
                        show_detail();
                    });
                });
            });
        });
    }
    //thuc hien lay chi tiet tthc
    $('#' + id_modal).on('show.bs.modal', function () {
        show_modal_loading();
    });

    function show_modal_loading() {
        $('#' + id_modal).find('.modal-body .detail').hide();
        $('#' + id_modal).find('.modal-body .loading').show();
    }

    function show_detail() {
        $('#' + id_modal).find('.modal-body .detail').show();
        $('#' + id_modal).find('.modal-body .loading').hide();
    }

    $("#frmCQ").submit(function (e) {
        e.preventDefault();
        var data = $('#frmCQ').serialize();
        sv.data.do_insesrt_cq(data, function (respone) {
            jQuery("#recaptcha_reload").click();
            if (respone.stt == 'done') {
                alert(respone.msg_error);
                $("#frmCQ")[0].reset();
                $("#msg_error_captchar").html("");
            } else {
                if (respone.stt == 'false_captcha') {
                    $("#msg_error_captchar").html(respone.msg_error)
                } else {
                    alert(respone.msg_error);
                }
            }
        });

    });

    function show_active_page() {
        $('.ul_pag li > button.item').each(function () {
            $(this).removeClass("active");
        });

        $('.ul_pag li > button.item[value="' + pagging.active + '"]').addClass('active');
    }

    function init_pagging() {
        pagging.last = Math.ceil(pagging.count / 20);
        var arr_pagging = [];
        if (pagging.active >= 7) {

            if (parseInt(pagging.active) >= parseInt(pagging.last) - 8) {
                arr_pagging = [parseInt(pagging.last) - 8, parseInt(pagging.last) - 7, parseInt(pagging.last) - 6, parseInt(pagging.last) - 5, parseInt(pagging.last) - 4, parseInt(pagging.last) - 3, parseInt(pagging.last) - 2, parseInt(pagging.last) - 1, parseInt(pagging.last)];
            } else {
                arr_pagging = [parseInt(pagging.active) - 4, parseInt(pagging.active) - 3, parseInt(pagging.active) - 2, parseInt(pagging.active) - 1, parseInt(pagging.active), parseInt(pagging.active) + 1, parseInt(pagging.active) + 2, parseInt(pagging.active) + 3, parseInt(pagging.active) + 4];
            }
        } else {

            if (pagging.last >= 9) {
                var i = 0, a = [];
                for (i = 0; i < 9; i++) {
                    a += arr_pagging.push(i);
                }
                arr_pagging = a;
            } else if (pagging.last == 0) {
                arr_pagging = ["1"];
            } else {
                var i = 0, a = [];
                for (i = 0; i < pagging.last; i++) {
                    a += arr_pagging.push(i);
                }
                arr_pagging = a;
            }

        }
        var html = "";
        html += "<li><button class=\"btn btn-default action\" value=\"first\">Đầu<\/button><\/li>";
        html += "<li><button class=\"btn btn-default action\" value=\"prev\">Trước<\/button><\/li>";
        var i = 0;
        for (i = 0; i < arr_pagging.length; i++) {
            html += "<li><button class=\"btn btn-default item\" value=\"" + arr_pagging[i] + "\">" + arr_pagging[i] + "<\/button><\/li>";
        }

        html += "<li><button class=\"btn btn-default action\" value=\"next\">Sau<\/button><\/li>";
        html += "<li><button class=\"btn btn-default  action\" value=\"last\">Cuối<\/button><\/li>";
        $(".ul_pag").html(html);

        $('.ul_pag li > button.item').each(function () {
            $(this).click(function () {
                pagging.active = $(this).val();
                get_data();
            });
        });


        $('.ul_pag li > button.action').each(function () {
            $(this).click(function () {
                var type = $(this).val();
                if (type == 'first') {
                    pagging.active = pagging.first;
                } else if (type == 'prev') {
                    var next = parseInt(pagging.active);
                    if ((next - 1) <= 0)
                        next = 1;
                    else
                        next -= 1;

                    pagging.active = next;
                } else if (type == 'next') {
                    var next = parseInt($('.ul_pag li > button.item.active').val());
                    if (next + 1 >= pagging.last)
                        next = pagging.last;
                    else
                        next += 1;
                    pagging.active = next;
                } else if (type == 'last') {
                    pagging.active = pagging.last;
                }
                //thuc hien lay du lieu
                get_data();
            });
        });

        show_active_page();
    }

    function htmlDecode(input) {
        var e = document.createElement('div');
        e.innerHTML = input;
        return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
    }

});