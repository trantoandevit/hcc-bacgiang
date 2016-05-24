(function () {
    $(document).ready(function ()
    {
        if ($('#vanban').length == 1)
        {
            //Load danh sách văn bản mới nhất
            sv.data.LoadDocByPage(0, function (resp)
            {
                var html = "";
//                html += "<div id='slimScrollDiv_1'>";
                html += "<ul>";
                $.each(resp, function (i, item) {
                    html += '<p><span class="glyphicon glyphicon-paperclip">&nbsp;</span>';
                    html += '<a href="javascript:void(0)" class="doc" data-doc="' + item.PK_VAN_BAN + '" title="' + item.C_TITLE + '">';
                    html += item.C_TITLE;
                    html += '</a></p></li>';
                });
                html += '</ul>';
                $('#slimScrollDiv_1').append(html);

            }, false);
            $('#slimScrollDiv_1').slimScroll({
                height: '130px'
            });
        }

        //Xem chi tiết văn bản
        $('#vanban a.doc').click(function () {
            var docId = $(this).attr('data-doc') || 0;
            sv.data.getSingleDoc(docId, function (resp)
            {
                $('#documentModalTitle').html(resp.document.C_TITLE);
                $('#modalSoHieuVanBan').html(resp.document.C_SO_HIEU_VAN_BAN);
                $('#modalCoQuanBanHanh').html(resp.coquan.C_NAME);
                $('#modalLinhVucThongKe').html(resp.linhvuc.C_NAME);
                $('#modalLoaiVanBan').html(resp.document.C_LOAI_VAN_BAN);
                var date = new Date(resp.document.C_NGAY_BAN_HANH);
                var ngayBanHanh = date.getFullYear()+'-' + (date.getMonth()+1) + '-'+date.getDate();
                $('#modalNgayBanHanh').html(ngayBanHanh);
                var date = new Date(resp.document.C_NGAY_HIEU_LUC);
                var ngayHieuLuc = date.getFullYear()+'-' + (date.getMonth()+1) + '-'+date.getDate();
                $('#modalNgayHieuLuc').html(ngayHieuLuc);
                $('#docModal').modal({
                    backdrop: true
                });
            }
            , false);
        });

    });


})();