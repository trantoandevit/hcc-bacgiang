var doc = {};
doc.pagging = {
    first: 1,
    last: "",
    count: "",
    active: 1
};
doc.post_data = {
    txt_title: '',
    sel_cqbh: '',
    sel_lvtk: '',
    sel_loai_vb: '',
    page: 1
};
$(document).ready(function () {
    doc.post_data = {
        txt_title: '',
        sel_cqbh: '',
        sel_lvtk: '',
        sel_loai_vb: '',
        page: 1
    };

//    load cơ quan ban hành
    sv.data.LoadOrgan(function (resp) {
        var html = '<ul>';
        $.each(resp, function (i, item) {
            html += '<li>';
            html += '<i class="fa fa-angle-double-right">&nbsp;</i><a href="javascript:void(0)" onclick="showDocumentByOrgan(' + item.FK_CO_QUAN_BAN_HANH + ')">' + item.C_NAME + ' (' + item.C_TOTAL + ')' + '</a><li>'
        });
        html += '</ul>';
        $('#coQuanBanHanh').html(html);
    });


// load lĩnh vực thống kê
    sv.data.LoadStatistics(function (resp) {
        var html = '<ul>';
        $.each(resp, function (i, item) {
            html += '<li>';
            html += '<i class="fa fa-angle-double-right">&nbsp;</i><a href="javascript:void(0)" onclick="showDocumentBySta(' + item.FK_LINH_VUC_VAN_BAN + ')">' + item.C_NAME + ' (' + item.C_TOTAL + ')' + '</a><li>'
        });
        html += '</ul>';
        $('#linhVuc').html(html);
    });

//    sv.data.getDocument(post_data, function (resp) {
//        renderTable(resp);
//        get_pagging(resp);
//    });


    $('#searchDocumentForm').submit(function (e) {
        e.preventDefault();
        searchDocument();
    });

//    sv.data.getAllDoc(function (resp) {
//        var count_all_data = resp[0]['TOTAL_RECORD'];
//        pagging.count = count_all_data
//        init_pagging();
//    });

    sv.data.getDocument(doc.post_data, function (resp) {
        var html = "<ul>";
        $.each(resp, function (i, item) {
            var title = item.C_TITLE;
            var titleArray = title.split(" ");
            var c_title = '';
            var date = new Date(item.C_NGAY_BAN_HANH);
            var ngayBanHanh = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            if (titleArray.length > 15)
            {
                for (i = 0; i <= 15; i++)
                {
                    c_title += titleArray[i] + " ";
                }
                c_title += "...";
            }
            else
            {
                for (i = 0; i < titleArray.length; i++)
                {
                    c_title += titleArray[i] + " ";
                }
            }
            html += '<li>';
            html += '<i class="fa fa-angle-double-right">&nbsp;</i><a href="javascript:void(0)" class="doc" data-doc="' + item.PK_VAN_BAN + '" title="' + item.C_TITLE + '">' + c_title + '</a>';
            html += '<p>( ' + ngayBanHanh + ' )</p></li>';
        });
        html += "</ul>";
        $('#box_no_3 #doc').html(html);
        addClickEvent('doc');
    });

    if ($('#tbl_list_doc tr').length == 1)
    {
//        var post_data = {
//            txt_title: '',
//            sel_cqbh: '',
//            sel_lvtk: '',
//            sel_loai_vb: '',
//            page: 1
//        };
        doc.post_data.page = 1;
        sv.data.getDocument(doc.post_data, function (resp)
        {
            renderTable(resp);
        }, false);
//        var post_data = {
//            txt_title: '',
//            sel_cqbh: '',
//            sel_lvtk: '',
//            sel_loai_vb: '',
//            page: ''
//        };
        doc.post_data.page = '';
        sv.data.getDocument(doc.post_data, function (resp)
        {
            get_pagging(resp);
        }, false);
    }

    $("#btnSearchDocument").click(function () {
        searchDocument();
    });


});

/**
 * Comment
 */
function showDocumentByOrgan(id)
{
    doc.post_data.page = 1;
    doc.post_data.sel_lvtk = "";
    doc.post_data.sel_cqbh = id;
    sv.data.getDocument(doc.post_data, function (resp) {
        renderTable(resp);
    },false);
    doc.post_data.page = '';
    sv.data.getDocument(doc.post_data, function (resp)
    {
        console.log(resp);
        get_pagging(resp);
    }, false);
}

/**
 * show
 */
function showDocumentBySta(id)
{
    doc.post_data.sel_lvtk = id;
    doc.post_data.sel_cqbh = "";
    doc.post_data.page = 1;
    sv.data.getDocument(doc.post_data, function (resp) {
        renderTable(resp);
    },false);
    doc.post_data.page = '';
    sv.data.getDocument(doc.post_data, function (resp)
    {
        get_pagging(resp);
    }, false);
}

/**
 * ad
 */
function addClickEvent(id)
{
    $('#' + id + ' a.doc').click(function () {
        var docId = $(this).attr('data-doc') || 0;
        sv.data.getSingleDoc(docId, function (resp)
        {
            $('#documentModalTitle').html(resp.document.C_TITLE);
            $('#modalSoHieuVanBan').html(resp.document.C_SO_HIEU_VAN_BAN);
            $('#modalCoQuanBanHanh').html(resp.coquan.C_NAME);
            $('#modalLinhVucThongKe').html(resp.linhvuc.C_NAME);
            $('#modalLoaiVanBan').html(resp.document.C_LOAI_VAN_BAN);
            var date = new Date(resp.document.C_NGAY_BAN_HANH);
            var ngayBanHanh = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            $('#modalNgayBanHanh').html(ngayBanHanh);
            var date = new Date(resp.document.C_NGAY_HIEU_LUC);
            var ngayHieuLuc = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            $('#modalNgayHieuLuc').html(ngayHieuLuc);
            $('#docModal').modal({
                backdrop: true
            });
        }
        , false);
    });
}
/**
 * s
 */
function searchDocument()
{
    var data = $('#searchDocumentForm').serialize();
    sv.data.getDocument(data, function (resp) {
        renderTable(resp);
        get_pagging(resp);
    });
}

/**
 * r
 */
function renderTable(data)
{
    var index = 1;
    var html = '';
    $.each(data, function (i, item) {
        html += '<tr><td class="text-center" style="vertical-align:middle">' + index + '</td>';
        html += '<td class="text-center" style="vertical-align:middle">' + '<a href="javascript:void(0)" class="doc" data-doc=' + item.PK_VAN_BAN + ' title="' + item.C_TITLE + '">' + item.C_SO_HIEU_VAN_BAN + '</a>' + '</td>';
        html += '<td class="text-justify red" style="vertical-align:middle">';
        html += '<a href="javascript:void(0)" class="doc" data-doc=' + item.PK_VAN_BAN + ' title="' + item.C_TITLE + '">' + item.C_TITLE + '</a></td>';
        var date = new Date(item.C_NGAY_BAN_HANH);
        var ngayBanHanh = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
        html += '<td class="text-center red" style="vertical-align:middle">' + ngayBanHanh + '</td>';
        index++;
    });
    $('#tbl_list_doc>tbody').html(html);
    addClickEvent('tbl_list_doc');
}

function get_pagging(resp) {
    doc.pagging.count = $(resp).length;
    init_pagging();
}


function init_pagging() {
    doc.pagging.last = Math.ceil(doc.pagging.count / 10);
    var arr_pagging = [];
    if (doc.pagging.active >= 7) {

        if (parseInt(doc.pagging.active) >= parseInt(doc.pagging.last) - 8) {
            arr_pagging = [parseInt(doc.pagging.last) - 8, parseInt(doc.pagging.last) - 7, parseInt(doc.pagging.last) - 6, parseInt(doc.pagging.last) - 5, parseInt(doc.pagging.last) - 4, parseInt(doc.pagging.last) - 3, parseInt(doc.pagging.last) - 2, parseInt(doc.pagging.last) - 1, parseInt(doc.pagging.last)];
        }
        else {
            arr_pagging = [parseInt(doc.pagging.active) - 4, parseInt(doc.pagging.active) - 3, parseInt(doc.pagging.active) - 2, parseInt(doc.pagging.active) - 1, parseInt(doc.pagging.active), parseInt(doc.pagging.active) + 1, parseInt(doc.pagging.active) + 2, parseInt(doc.pagging.active) + 3, parseInt(doc.pagging.active) + 4];
        }
    }

    else {

        if (doc.last >= 9) {
            var i = 0, a = [];
            for (i = 0; i < 9; i++) {
                a += arr_pagging.push(i);
            }
            arr_pagging = a;
        }
        else if (doc.pagging.last == 0) {
            arr_pagging = ["1"];
        }
        else {
            var i = 0, a = [];
            for (i = 0; i < doc.pagging.last; i++) {
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
            doc.active = $(this).val();
            show_active_page();
//            var post_data = {
//                txt_title: '',
//                sel_cqbh: '',
//                sel_lvtk: '',
//                sel_loai_vb: '',
//                page: $(this).attr("value")
//            };
            doc.post_data.page = $(this).attr("value");
            sv.data.getDocument(doc.post_data, function (resp)
            {
                renderTable(resp);
            }, false);
        });
    });

    doc.pagging.active = 1;
    show_active_page(doc.pagging.first);
//
    $('.ul_pag li > button.action').each(function () {
        $(this).click(function () {
            var type = $(this).val();
            if (type == 'first') {
                doc.pagging.active = doc.pagging.first;
            }
            else if (type == 'prev') {
                var next = parseInt(doc.pagging.active);
                if ((next - 1) <= 0)
                    next = 1;
                else
                    next -= 1;

                doc.pagging.active = next;
            }
            else if (type == 'next') {
                var next = parseInt($('.ul_pag li > button.item.active').val());
                if (next + 1 >= doc.pagging.last)
                    next = doc.pagging.last;
                else
                    next += 1;
                doc.pagging.active = next;
            }
            else if (type == 'last') {
                doc.pagging.active = doc.pagging.last;
            }
            //thuc hien lay du lieu
            show_active_page();
//            var post_data = {
//                txt_title: '',
//                sel_cqbh: '',
//                sel_lvtk: '',
//                sel_loai_vb: '',
//                page: doc.pagging.active
//            };
            doc.post_data.page = doc.pagging.active;
            sv.data.getDocument(doc.post_data, function (resp)
            {
                renderTable(resp);
            }, false);
        });
    });
}

function show_active_page() {
    $('.ul_pag li > button.item').each(function () {
        $(this).removeClass("active");
    });

    $('.ul_pag li > button.item[value="' + doc.pagging.active + '"]').addClass('active');
}
