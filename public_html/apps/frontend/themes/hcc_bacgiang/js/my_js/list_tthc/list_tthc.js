(function () {
    $(document).ready(function () {
        var id_sel_member = 'sel-tthc-member';
        var id_sel_spec = 'sel-tthc-spec';
        var id_table_content = 'table-list-tthc';
        var id_btn_filter = 'btn-tthc-filter';
        var id_modal = 'myModalTTHC';
        
        var all_spec = {};
        var filter = {
            page: 1,
            keyword: '',
            member: '-1',
            spec: '-1',
            level: '-1'
        };
        var pagging = {
            first: 1,
            last: "",
            count: "",
            active: 1
        };
        
        sv.data.all_departments_member('', function (respone) {
            var html = '';
            var name = '';
            html += '<option value="'+ _CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT +'">Quận/Huyện</option>';
            for (var code in respone) {
                name = respone[code];
                html += '<option value="' + code + '">' + name + '</option>';
            }

            $('#' + id_sel_member).append(html);
        });
        
        sv.data.all_spec(function (respone) {
            console.log(respone);
            all_spec = respone;
        });

        $('#' + id_sel_member).change(function () {
            var html = '';
            var member = $(this).val();
            var spec_name = '';
            var spec_code = '';

            //reset all option
            $('#' + id_sel_spec).html('');
            $('#' + id_sel_spec).attr('disabled', 'disabled');
            //kiem tra don vi co linh vuc ko 
            if (jQuery.isEmptyObject(all_spec[member]))
            {
                return false;
            }

            //enable sel_spec
            $('#' + id_sel_spec).removeAttr('disabled');
            html = '<option value="-1">--- Tất cả ---</option>';
            for (var index in all_spec[member]) {
                spec_name = all_spec[member][index].C_NAME;
                spec_code = all_spec[member][index].C_CODE;

                html += '<option value="' + spec_code + '">' + spec_name + '</option>';
            }

            $('#' + id_sel_spec).append(html);
        });

        $('#' + id_btn_filter).click(function () {
            pagging.active = 1;
            show_active_page(pagging.first);
            get_data();
        }).trigger("click");

        function get_data() {

            //lay du lieu loc
            filter.page = pagging.active;
            filter.keyword = $("#txt_tu_khoa").val();
            
            if ($("#sel-tthc-member").val() != "undefined") {
                filter.member = $("#sel-tthc-member").val();
            }
            else {
                filter.member = "-1";
            }
            if ($("#sel-tthc-spec").val()) {

                filter.spec = $("#sel-tthc-spec").val();
            }
            else {
                filter.spec = "-1";
            }
            if ($("#sel_muc_do").val()) {
                filter.level = $("#sel_muc_do").val();
            }
            else {
                filter.level = "-1";
            }

            sv.data.list_record_type(filter, function (respone) {
                var data = respone.data;
                var count_all_data = respone.count;
                var selector = $('#' + id_table_content);
                var record_type_name = '';
                var record_type_code = '';
                var record_type_id = '';
                var spec_name = '';
                var member_name = '';
                var level = '';
                var stt = ((filter.page - 1) * 20) + 1;
                var html = '';
                //gan tong so ban ghi cho pagging
                pagging.count = count_all_data;
                init_pagging();

                //reset table
                $(selector).find('.item').each(function () {
                    $(this).remove();
                });

                //include tr
                for (var index in data)
                {
                    record_type_name = data[index].C_RECORD_TYPE_NAME;
                    record_type_code = data[index].C_RECORD_TYPE_CODE;
                    record_type_id = data[index].C_RECORD_TYPE_ID;

                    member_name = data[index].C_MEMBER_NAME;
                    spec_name = data[index].C_SPEC_NAME;
                    level = data[index].C_LEVEL;

                    html += '<tr class="item">';
                    html += '   <td class="text-center">' + stt + '</td>';
                    html += '   <td><a href="javascript:void(0);" class="item-detail" data-id="' + record_type_id + '">' + record_type_name + '</a></td>';
                    html += '   <td>' + spec_name + '</td>';
                    html += '   <td>' + member_name + '</td>';
                    html += '    <td class="text-center">' + level + '</td>';
                    html += '</tr>';
                    stt++;
                }
                $(selector).append(html);

                $(selector).find('.item .item-detail').each(function () {
                    $(this).click(function (e) {
                        e.preventDefault();
                        var record_type_id = $(this).attr('data-id');
                        var record_type_name = $(this).html();

                        $('#' + id_modal).modal('show');

                        sv.data.record_type(record_type_id, function (respone) {
                            var content = respone.C_CONTENT;
                            var json_file_attach = respone.C_JSON_FILE_ATTACHMENT;
                            var obj_file_attach = jQuery.parseJSON(json_file_attach);
                            var length_of_obj = Object.keys(obj_file_attach).length;
                            var html = content;
                            var file_attach_name = '';
                            var file_attach_url = '';
                            
                            if(length_of_obj > 0)
                            {
                                html += '<div class="row"><div class="col-md-12"><b>File đính kèm:</b></div></div>';
                                html += '<div class="row"><div class="col-md-12"></ul>';
                                for(var key in obj_file_attach)
                                {
                                    file_attach_name = obj_file_attach[key].file_name;
                                    file_attach_url = obj_file_attach[key].url;
                                    
                                    html += '<li><a target="_blank" href="'+ file_attach_url +'">'+ file_attach_name +'</a></li>';
                                }
                                html += '</ul></div></div>';
                            }
                            
                            $('#' + id_modal).find('.detail').html(html);
                            $('#' + id_modal).find('#myModalLabel').html(record_type_name);
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
            $('#' + id_modal).find('#myModalLabel').html('');
        }

        function show_detail() {
            $('#' + id_modal).find('.modal-body .detail').show();
            $('#' + id_modal).find('.modal-body .loading').hide();
        }

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
                }
                else {
                    arr_pagging = [parseInt(pagging.active) - 4, parseInt(pagging.active) - 3, parseInt(pagging.active) - 2, parseInt(pagging.active) - 1, parseInt(pagging.active), parseInt(pagging.active) + 1, parseInt(pagging.active) + 2, parseInt(pagging.active) + 3, parseInt(pagging.active) + 4];
                }
            }

            else {

                if (pagging.last >= 9) {
                    var i = 0, a = [];
                    for (i = 0; i < 9; i++) {
                        a += arr_pagging.push(i);
                    }
                    arr_pagging = a;
                }
                else if (pagging.last == 0) {
                    arr_pagging = ["1"];
                }
                else {
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
                    }
                    else if (type == 'prev') {
                        var next = parseInt(pagging.active);
                        if ((next - 1) <= 0)
                            next = 1;
                        else
                            next -= 1;

                        pagging.active = next;
                    }
                    else if (type == 'next') {
                        var next = parseInt($('.ul_pag li > button.item.active').val());
                        if (next + 1 >= pagging.last)
                            next = pagging.last;
                        else
                            next += 1;
                        pagging.active = next;
                    }
                    else if (type == 'last') {
                        pagging.active = pagging.last;
                    }
                    //thuc hien lay du lieu
                    get_data();
                });
            });

            show_active_page();
        }
    });
})();