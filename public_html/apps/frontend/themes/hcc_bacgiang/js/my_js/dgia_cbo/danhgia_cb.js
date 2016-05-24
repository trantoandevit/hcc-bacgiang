$(function () {
    $(document).ready(function () {
        $('button#btn_danh_gia').click(function () {
            var object = obj_all_canbo[canbo_config.cur_canbo];
            var data = {FK_EMPLOYMENT: object.PK_EMPLOYMENT, QUESTION: object.C_QUESTION, FK_MEMBER: object.FK_MEMBER};
            var record_code = $('#txt_record_code').val();
            var check_has_record = 0;
            sv.data.record_info(object.C_DEVELOPER, record_code, function (response) {
                if (Object.keys(response).length > 0)
                    check_has_record = 1;
            }, false);

            if (check_has_record == 1)
            {
                sv.data.doDanhGiaCanBo(data, function (resp) {
                    var html = "";
                    if (resp)
                    {
                        $('#canboModal').modal('hide');
                        html +="<h4>Cám ơn bạn đã giúp chúng tôi đánh giá cán bộ, mọi ý kiến đánh giá của bạn sẽ được lưu lại .</h4>";
                        sv.data.getAllDanhGiaCanBo('', function (resp) {
                            obj_all_canbo = resp;
                            canbo_function.render_can_bo(resp);
                            canbo_function.render_modal(resp);
                            canbo_function.init_pagging(resp);
                            canbo_function.add_point();
                        }, false);
                    }
                    else
                    {
                        html +="<h4>Đã xảy ra lỗi, vui lòng thực hiện lại</h4>";
                        sv.data.getAllDanhGiaCanBo('', function (resp) {
                            obj_all_canbo = resp;
                            canbo_function.render_can_bo(resp);
                            canbo_function.render_modal(resp);
                            canbo_function.init_pagging(resp);
                            canbo_function.add_point();
                        }, false);
                    }
                    $('#alertModal').modal('show');
                    $('#alertModal').on('shown.bs.modal', function () {
                        $('#alertModal .modal-body').html(html);
                    });
                }, false);
            }
            else
            {
                alert('Xin lỗi Mã hồ sơ của bạn không đúng!!');
                $('#txt_record_code').focus();
            }

        });

        // with plugin options
        sv.data.all_member('1', function (respone) {
            var scope = '';
            var selector = '.' + canbo_config.class_list_member + ' .' + canbo_config.class_unit_so;

            for (var index in respone)
            {
                canbo_function.show_item(respone[index]);
            }

            $(selector).find('.a_list').each(function () {
                $(this).click(function () {
                    var record_type_id = $(this).attr('id');
                    var member_name = $(this).html();
                    $('#member_name').html(member_name);
                    canbo_config.filter.id = record_type_id;
                    canbo_config.filter.page = 1;
                    canbo_config.filter.keyword = "";
                    $('#key_search_cb').val('');
                    sv.data.list_cb(canbo_config.filter, function (respone) {
                        canbo_function.render_can_bo(respone);
                        canbo_function.render_modal(respone);
                        canbo_function.add_point();
                    });
                    canbo_config.filter.page = "";
                    sv.data.list_cb(canbo_config.filter, function (respone) {
                        console.log(canbo_config.filter);
                        canbo_function.init_pagging(respone);
                        canbo_config.pagging.active = 1;
                        canbo_function.show_active_page();
                    });
                });

            });

            $('.a_list').click(function (e) {
                $('.dg_left a').removeClass("active");
                $(this).addClass("active");
                canbo_config.pagging.active = 1;
                canbo_function.show_active_page();
            });

            $('.huyen a.a_list').each(function () {
                $(this).click(function () {
                    var record_type_id = $(this).attr('id');
                    canbo_config.filter.id = record_type_id;
                    canbo_config.filter.page = 1;
                    canbo_config.filter.keyword = "";
                    $('#key_search_cb').val('');
                    sv.data.list_cb(canbo_config.filter, function (respone) {
                        canbo_function.render_can_bo(respone);
                        canbo_function.render_modal(respone);
                        canbo_function.add_point();
                    });
                    canbo_config.filter.page = "";
                    sv.data.list_cb(canbo_config.filter, function (respone) {
                        canbo_function.init_pagging(respone);
                    });
                    canbo_config.pagging.active = 1;
                    canbo_function.show_active_page();
                });
            });

            $('.dg_right').css('height', '750px');
            $('.dg_slim_scroll').slimScroll({
                height: '640px'
            });
            $('.dg_left').slimScroll({
                height: '750px'
            });
            $('.so').hide();
            $('.huyen').hide();
        });

        $('.list-group.dgl_all').click(function () {
            $('.dg_left a').removeClass("active");
            canbo_config.pagging.active = 1;
            var data = {};
            canbo_config.filter = {
                id: '',
                keyword: '',
                page: 1
            };
            sv.data.list_cb(data, function (respone) {
                canbo_function.render_can_bo(respone);
                canbo_function.render_modal(respone);
                canbo_function.init_pagging(respone);
                canbo_function.add_point();
            });
            canbo_function.show_active_page();
        });
        $('.rdg_action li a').click(function (e) {
            $('.rdg_action li').removeClass("a_action");
            $(this).parent().addClass("a_action");
        });

        $('#key_search_cb').keypress(function (e) {
            var key = e.which;
            if (key == 13)  // the enter key code
            {
                var keyword = $('#key_search_cb').val();
                canbo_config.filter.keyword = keyword;
                canbo_config.filter.page = 1;
                sv.data.list_cb(canbo_config.filter, function (respone) {
                    canbo_function.render_can_bo(respone);
                    canbo_function.render_modal(respone);
                    canbo_function.add_point();
                });
                canbo_config.filter.page = "";
                sv.data.list_cb(canbo_config.filter, function (respone) {
                    canbo_function.init_pagging(respone);
                });
            }
        }).trigger("click");
        $(".input-2").rating(
                'create', {disabled: true}
        );

        $('.btn_down').click(function () {
            $('.btn_down').hide();
            $('.so').toggle();
            $('.btn_up').show();
        });
        $('.btn_up').click(function () {
            $('.btn_up').hide();
            $('.so').toggle();
            $('.btn_down').show();
        });
        $('.btn_down_h').click(function () {
            $('.btn_down').hide();
            $('.huyen').toggle();
            $('.btn_up').show();
        });
        $('.btn_up_h').click(function () {
            $('.btn_up').hide();
            $('.huyen').toggle();
            $('.btn_down').show();
        });
    });
});