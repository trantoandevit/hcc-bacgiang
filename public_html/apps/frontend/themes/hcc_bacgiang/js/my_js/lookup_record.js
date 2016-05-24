(function(){
    $(document).ready(function(){
        var txt_record_id = 'txt_record_code_lookup';
        var btn_lookup = 'btn_lookup_record';
        var id_modal = 'myModalLookupRecord';
        
        //gan event hien thi modal
        $('#' + btn_lookup).click(function(){
            $('#' + id_modal).modal('show');
        });
        
        //thuc hien lay du lieu
        $('#' + id_modal).on('show.bs.modal', function(){
            show_modal_loading();
        });
        
        $('#' + id_modal).on('shown.bs.modal', function(){
            var record_id = $('#' + txt_record_id).val();
            push_lookup_id_data(record_id);
        });
        
        function push_lookup_id_data(record_id){
            sv.data.record_info('', record_id, function(respone){
                if(jQuery.isEmptyObject(respone))
                {
                    show_modal_not_found();
                }
                else
                {
                    show_modal_record_info();
                }
                var general_info = {};
                var arr_xu_ly = respone.chi_tiet.buoc_xu_ly;
                
                general_info.ma_ho_so = respone.ma_ho_so;
                general_info.ngay_hen_tra = respone.ngay_hen_tra;
                general_info.ngay_tiep_nhan = respone.ngay_tiep_nhan;
                general_info.nguoi_dang_ky = respone.nguoi_dang_ky;
                general_info.so_ngay_quy_dinh = respone.so_ngay_quy_dinh;
                general_info.ten_thu_tuc = respone.ten_thu_tuc;
                general_info.trang_thai_hs = respone.trang_thai_hs;
                
                //input thong tin co ban
                push_general_info(general_info);
                
                //input chi tiet
                push_process_record(arr_xu_ly);
            });
        }
        
        function show_modal_not_found(){
            $('#' + id_modal).find('.modal-body .not-found').show();
            $('#' + id_modal).find('.modal-body .record-info').hide();
            $('#' + id_modal).find('.modal-body .loading').hide();
        }
        
        function show_modal_record_info(){
            $('#' + id_modal).find('.modal-body .loading').hide();
            $('#' + id_modal).find('.modal-body .not-found').hide();
            $('#' + id_modal).find('.modal-body .record-info').show();
        }
        
        function show_modal_loading(){
            $('#' + id_modal).find('.modal-body .not-found').hide();
            $('#' + id_modal).find('.modal-body .record-info').hide();
            $('#' + id_modal).find('.modal-body .loading').show();
        }
        
        function push_general_info(general_info){
            var selector  = $('#' + id_modal).find('.modal-body .record-info');
            
            $(selector).find('.record-type-name').html(general_info.ten_thu_tuc);
            $(selector).find('.record-code').html(general_info.ma_ho_so);
            $(selector).find('.record-submitter').html(general_info.nguoi_dang_ky);
            $(selector).find('.record-receive-date').html(general_info.ngay_tiep_nhan);
            $(selector).find('.record-day-require').html(general_info.so_ngay_quy_dinh);
            $(selector).find('.record-return-date').html(general_info.ngay_hen_tra);
            $(selector).find('.record-status').html(general_info.trang_thai_hs);
        }
        
        function push_process_record(arr_xu_ly){
            var selector  = $('#' + id_modal).find('.modal-body .record-info');
            var ten_buoc_xu_ly = '';
            var bo_phan_xu_ly = '';
            var nguoi_xu_ly = '';
            var thoi_gian_quy_dinh = '';
            var thoi_gian_bat_dau = '';
            var thoi_gian_ket_thuc = '';
            var html = '';
            var i = 1;
            //reset tr
            $(selector).find('table.record-process-detail tr.progress').each(function () {
                $(this).remove();
            });
            
            //push new data
            for(var index in arr_xu_ly)
            {
                ten_buoc_xu_ly = (jQuery.isEmptyObject(arr_xu_ly[index].ten_buoc_xu_ly))?'':arr_xu_ly[index].ten_buoc_xu_ly;
                bo_phan_xu_ly = (jQuery.isEmptyObject(arr_xu_ly[index].bo_phan_xu_ly))?'':arr_xu_ly[index].bo_phan_xu_ly;
                nguoi_xu_ly = (jQuery.isEmptyObject(arr_xu_ly[index].nguoi_xu_ly))?'':arr_xu_ly[index].nguoi_xu_ly;
                thoi_gian_quy_dinh = (jQuery.isEmptyObject(arr_xu_ly[index].thoi_gian_quy_dinh))?'':arr_xu_ly[index].thoi_gian_quy_dinh;
                thoi_gian_bat_dau = (jQuery.isEmptyObject(arr_xu_ly[index].thoi_gian_bat_dau))?'':arr_xu_ly[index].thoi_gian_bat_dau;
                thoi_gian_ket_thuc = (jQuery.isEmptyObject(arr_xu_ly[index].thoi_gian_ket_thuc))?'':arr_xu_ly[index].thoi_gian_ket_thuc;
                
                html = '<tr class="progress">'
                html +='    <td align="center" class="tab_data">'+ i +'</td>';
                html +='    <td class="tab_data">'+ ten_buoc_xu_ly +'</td>';
                html +='    <td class="tab_data">'+ bo_phan_xu_ly +'</td>';
                html +='    <td class="tab_data">'+ nguoi_xu_ly +'</td>';
                html +='    <td class="header-thxl tab_data">'+ thoi_gian_quy_dinh +'</td>';
                html +='    <td class="tab_data">'+ thoi_gian_bat_dau +'</td>';
                html +='    <td class="tab_data">'+ thoi_gian_ket_thuc +'</td>';
                html +='</tr>';
                
                $(selector).find('table.record-process-detail').append(html);
                i++;
            }
        }
    });
    
})();
