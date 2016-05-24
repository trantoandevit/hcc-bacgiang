var obj_all_canbo = {};
var canbo_function = {};
var canbo_config = {};

//cau hinh 
canbo_config.id_modal = 'myModal';
canbo_config.filter = {
    id: '',
    keyword: '',
    page: 1
};

canbo_config.pagging = {
    first: 1,
    last: "",
    count: "",
    active: 1
};
canbo_config.id_list_cq = 'list_cq';

canbo_config.class_list_member = 'dg_left';
canbo_config.class_unit_so = "dgl_so";
canbo_config.class_unit_huyen = "dgl_huyen";
canbo_config.class_unit_all = "dgl_all";
canbo_config.cur_canbo = '';

//function dung chung
canbo_function.render_can_bo = function (data) {
    var html = "";
    if (data == "") {
        html += "<h2>Xin lỗi hệ thống không tìm thấy dữ liệu bạn yêu cầu !!!</h2>";
    }
    html += "<div class='row'>";
    for (var i in data) {
        var object = data[i];
        var arrQuestion = object.C_QUESTION;
        html += '<div class="col-md-12 col-sm-12 col-xs-12 dgr_box" id="employment' + i + '">';
        html += "<div class='row'>";
        html += '<div class="col-md-3 col-sm-12 col-xs-12 dg_img">';
        html += '<a href="" data-toggle="modal" data-id="' + object.PK_EMPLOYMENT + '">';
        if (object.C_AVATAR_FILE_PATH == null || object.C_AVATAR_FILE_PATH == '')
        {
            html += '<img class="img_employment" src="' + CONST_SITE_THEME_ROOT + 'img/user-icon.png" alt="" />';
        }
        else
        {
            html += '<img class="img_employment" src="' + object.C_AVATAR_FILE_PATH + '" alt="" />';
        }
        html += '</a>';
        html += '</div>';
        html += '<div class="col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 dg_info">';
        html += '<div class="info_person">';
        html += '<ul class="list-unstyled">';
        html += '<li><span>Tên : </span>' + object.C_NAME + '</li>';
        html += '<li><span>Đơn vị : </span>' + object.MEMBER_NAME + '</li>';
        html += '<li><span>Chức vụ : </span>' + checkNull(object.C_JOB_TITLE) + '</li>';
        html += '<li><span>Email : </span>' + checkNull(object.C_EMAIL) + '</li>';
        html += '<li><span>Số điện thoại : </span>' + checkNull(object.C_PHONE) + '</li>';
        html += '</ul>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 dg_info">';
        html += '<ul class="list-unstyled info_person">';
        html += '<li>Tiêu chí đánh giá</li>';
        for (var q in arrQuestion) {
            var question = arrQuestion[q];
            var rate = Math.round10(question.C_RATE / 100 * 5, -1);
            if (rate == null)
            {
                rate = 0;
            }
            html += '<li>';
            html += '<span class="rating-label">' + question.C_CRITERIA + ':</span>';
            html += '<input class="rate rating rating-loading" value="' + rate + '" type="number" min=0 max=5 step=0.1 stars=5 size=xs >';
            html += '</li>';
        }
        html += '</ul>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
    }
    html += "</div>";
    $('.dgr_list').html(html);
    $('input.rate.rating.rating-loading').each(function () {
        $(this).rating(
                'create',
                {disabled: true,
                    size: 'xs',
                    starCaptions: function (val) {
                        if (val == 0)
                        {
                            return "Chưa có";
                        }
                        return (val * 20 + ' %');
                    },
                    clearCaption: ''
                }
        );
    });
    canbo_function.fill_data_modal();
};


//add điểm cho từng câu hỏi
canbo_function.add_point = function () {
    $('#canboModal .rating_value').each(function () {
        $(this).on('rating.change', function () {
            var object = obj_all_canbo[canbo_config.cur_canbo];
            var list_question = object.C_QUESTION;
            for (var i in list_question)
            {
                var question = list_question[i];
                var selector = '#canboModal .rating_value[question-id=' + question.PK_EVALUATION_QUESTION + ']';
                question.C_POINT = $(selector).val();
            }
        });
    });
};

//fill câu hỏi ra modal
canbo_function.render_modal = function (data) {
    var html = "";
    var canbo = obj_all_canbo[canbo_config.cur_canbo];
    if (data != "")
    {
        var question = {};

        //lay phan tu dau tien
        for (var key in data)
        {
            question = data[key].C_QUESTION;
            break;
        }
        for (var i in question)
        {
            var object = question[i];
            html += '<li class="col-md-12 col-sm-12 col-xs-12">';
            html += '<div class="col-md-12 question-group">';
            html += '<div class="r_question">';
            html += '<h3>' + object.C_QUESTION + '</h3>';
            html += '</div>';
            html += '<div class="rate">';
            html += '<div class="row">';
            html += '<div class="col-md-12 text-center">';
            html += '<input class="rating rating_value" type="number" class="rating" step=1 min=0 max=5 stars=5 data-size="md" question-id="' + object.PK_EVALUATION_QUESTION + '">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</html>';
            html += '</li>';
        }
        $('.rdg_action ul.list-unstyled.list-inline').html(html);
        $('input.rating').each(function () {
            $(this).rating();
        });
    }
};

//fill thông tin các bộ ra modal
canbo_function.fill_data_modal = function () {
    $('.img_employment').parent('a').click(function (e) {
        e.preventDefault();
        canbo_config.cur_canbo = $(this).attr('data-id');
        $('.dg_info .p_info .list-unstyled').html('');
        $('#canboModal').modal('show');
    });
    $('#canboModal').on('show.bs.modal', function () {
        $('#canboModal .caption').css('display', 'none');
        var object = obj_all_canbo[canbo_config.cur_canbo];
        var name = object.C_NAME;
        var member_name = object.MEMBER_NAME;
        var avatar = '';
        if (object.C_AVATAR_FILE_PATH == null || object.C_AVATAR_FILE_PATH == '')
        {
            avatar = CONST_SITE_THEME_ROOT + 'img/user-icon.png';
        }
        else
        {
            avatar = object.C_AVATAR_FILE_PATH;
        }
        var arr_question = object.C_QUESTION;
        var html = '';
        html += '<li><span>Tên : </span><span>' + name + '</span></li>';
        html += '<li><span>Đơn vị : </span><span>' + member_name + '</span></li>';
        for (var i in arr_question)
        {
            question = arr_question[i];
            if (question.C_RATE != null)
            {
                html += '<li><span>' + question.C_CRITERIA + ' : </span><span>' + question.C_RATE + '%</span></li>';
            }
            else
            {
                html += '<li><span>' + question.C_CRITERIA + ' : </span><span>Chưa có đánh giá</span></li>';
            }
        }
        $('.dg_info .p_info .list-unstyled').html(html);
        html = '';
        $('.col-md-4.col-sm-4.dg_img img').attr('src', avatar);
        $('#txt_record_code').val('');
    });
};


// hiện đang đang hiển thị
canbo_function.show_active_page = function () {
    $('.ul_pag li > button.item').each(function () {
        $(this).removeClass("active");
    });

    $('.ul_pag li > button.item[value="' + canbo_config.pagging.active + '"]').addClass('active');
};


//tạo pagging
canbo_function.init_pagging = function (data) {
    var count_all_data = Object.keys(data).length;
    canbo_config.pagging.count = count_all_data;
    canbo_config.pagging.last = Math.ceil(canbo_config.pagging.count / 20);
    var arr_pagging = [];
    if (canbo_config.pagging.active >= 7) {

        if (parseInt(canbo_config.pagging.active) >= parseInt(canbo_config.pagging.last) - 8) {
            arr_pagging = [parseInt(canbo_config.pagging.last) - 8, parseInt(canbo_config.pagging.last) - 7, parseInt(canbo_config.pagging.last) - 6, parseInt(canbo_config.pagging.last) - 5, parseInt(canbo_config.pagging.last) - 4, parseInt(canbo_config.pagging.last) - 3, parseInt(canbo_config.pagging.last) - 2, parseInt(canbo_config.pagging.last) - 1, parseInt(canbo_config.pagging.last)];
        } else {
            arr_pagging = [parseInt(canbo_config.pagging.active) - 4, parseInt(canbo_config.pagging.active) - 3, parseInt(canbo_config.pagging.active) - 2, parseInt(canbo_config.pagging.active) - 1, parseInt(canbo_config.pagging.active), parseInt(canbo_config.pagging.active) + 1, parseInt(canbo_config.pagging.active) + 2, parseInt(canbo_config.pagging.active) + 3, parseInt(canbo_config.pagging.active) + 4];
        }
    } else {

        if (canbo_config.pagging.last >= 9) {
            var i = 0, a = [];
            for (i = 0; i < 9; i++) {
                a += arr_pagging.push(i);
            }
            arr_pagging = a;
        } else if (canbo_config.pagging.last == 0) {
            arr_pagging = ["1"];
        } else {
            var i = 0, a = [];
            for (i = 0; i < canbo_config.pagging.last; i++) {
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
            canbo_config.pagging.active = $(this).val();
            canbo_config.filter.page = canbo_config.pagging.active;
            canbo_config.filter.keyword = $("#key_search_cb").val();
            sv.data.list_cb(canbo_config.filter, function (respone) {
                canbo_function.render_can_bo(respone);
                canbo_function.render_modal(respone);
                canbo_function.add_point();
                canbo_function.show_active_page();
            });
        });
    });


    $('.ul_pag li > button.action').each(function () {
        $(this).click(function () {
            var type = $(this).val();
            if (type == 'first') {
                canbo_config.pagging.active = canbo_config.pagging.first;
            } else if (type == 'prev') {
                var next = parseInt(canbo_config.pagging.active);
                if ((next - 1) <= 0)
                    next = 1;
                else
                    next -= 1;

                canbo_config.pagging.active = next;
            } else if (type == 'next') {
                var next = parseInt($('.ul_pag li > button.item.active').val());
                if (next + 1 >= canbo_config.pagging.last)
                    next = canbo_config.pagging.last;
                else
                    next += 1;
                canbo_config.pagging.active = next;
            } else if (type == 'last') {
                canbo_config.pagging.active = canbo_config.pagging.last;
            }
            canbo_config.filter.page = canbo_config.pagging.active;
            canbo_config.filter.keyword = $("#key_search_cb").val();
            //thuc hien lay du lieu
            sv.data.list_cb(canbo_config.filter, function (respone) {
                canbo_function.render_can_bo(respone);
                canbo_function.render_modal(respone);
                canbo_function.show_active_page();
                canbo_function.add_point();
            });
        });
    });

    canbo_function.show_active_page();
};

function checkNull(data)
{
    if (data == '' || data == null)
    {
        return 'Chưa có';
    }
    else
    {
        return data;
    }
}

function decimalAdjust(type, value, exp) {
    // If the exp is undefined or zero...
    if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // If the value is not a number or the exp is not an integer...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}
if (!Math.round10) {
    Math.round10 = function (value, exp) {
        return decimalAdjust('round', value, exp);
    };
}
// Decimal floor
if (!Math.floor10) {
    Math.floor10 = function (value, exp) {
        return decimalAdjust('floor', value, exp);
    };
}
// Decimal ceil
if (!Math.ceil10) {
    Math.ceil10 = function (value, exp) {
        return decimalAdjust('ceil', value, exp);
    };
}

canbo_function.show_item = function (data) {
    var scope = data.C_SCOPE;
    var login_url = (data.C_LOGIN_URL == '') ? 'javascript:void(0)' : data.C_LOGIN_URL;
    var name = data.C_NAME;
    var selector = '';
    var html = '';
    if (scope == '0')
        selector = '.' + canbo_config.class_list_member + ' .' + canbo_config.class_unit_so + ' .so';
    else
        selector = '.' + canbo_config.class_list_member + ' .' + canbo_config.class_unit_huyen + ' .huyen';

    html += '<a href="javascript:void(0)" class="list-group-item a_list" id="' + data.PK_MEMBER + '">' + name + '</a>';
    $(selector).append(html);
};


(function () {
    $(document).ready(function () {
        sv.data.getAllDanhGiaCanBo('', function (resp) {
            obj_all_canbo = resp;
            canbo_function.render_can_bo(resp);
            canbo_function.render_modal(resp);
            canbo_function.init_pagging(resp);
            canbo_function.add_point();
        }, false);
    });
})();
