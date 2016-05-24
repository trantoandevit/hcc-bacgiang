(function(){
    //chay slide
    $(document).ready(function () {
        var id_table_synthesis = 'table-synthesis';
        var id_table_synthesis_footer = 'table-synthesis-footer';
        var id_statistic_cur_month = 'statistic-2';
        var id_synthesis_year = 'statistic-1';

        var total_cur_month = {
            tiep_nhan_ky_truoc: 0,
            tiep_nhan_trong_ky: 0,

            dang_giai_quyet_chua_den_han: 0,
            dang_giai_quyet_qua_han: 0,
            tong_so_dang_giai_quyet: 0,

            da_giai_quyet_som_han: 0,
            da_giai_quyet_dung_han: 0,
            da_giai_quyet_qua_han: 0,
            tong_so_da_giai_quyet: 0,

            tam_dung_bo_sung: 0,
            tam_dung_nvtc: 0,

            huy_ho_so_tu_choi: 0,
            huy_ho_so_cong_dan_rut: 0,

            cho_tra_trong_ky: 0,
            cho_tra_ky_truoc: 0,
            tong_so_cho_tra: 0,

            ty_le: 0,

            tong_so_don_vi: 0,

            ngay_tao: ''
        };

        //hien thi bang tong hop
        sv.data.synthesis_month('','','',function(respone){
            var tiep_nhan_ky_truoc = 0;
            var tiep_nhan_trong_ky = 0;

            var dang_giai_quyet_chua_den_han = 0;
            var dang_giai_quyet_qua_han = 0;
            var tong_so_dang_giai_quyet = 0;

            var da_giai_quyet_som_han = 0;
            var da_giai_quyet_dung_han = 0;
            var da_giai_quyet_qua_han = 0;
            var tong_so_da_giai_quyet = 0;

            var tam_dung_bo_sung = 0;
            var tam_dung_nvtc = 0;

            var huy_ho_so_tu_choi = 0;
            var huy_ho_so_cong_dan_rut = 0;

            var cho_tra_trong_ky = 0;
            var cho_tra_ky_truoc = 0;
            var tong_so_cho_tra = 0;

            var ty_le = 0;

            var unit_name = '';

            var html = '';

            var count = 1;

            //hien thi cho bang tong hop
            for(var index in respone)
            {
                html = '';
                tiep_nhan_ky_truoc = respone[index].C_COUNT_KY_TRUOC;
                tiep_nhan_trong_ky = respone[index].C_COUNT_TIEP_NHAN;

                dang_giai_quyet_chua_den_han = respone[index].C_COUNT_THU_LY_CHUA_DEN_HAN;
                dang_giai_quyet_qua_han = respone[index].C_COUNT_THU_LY_QUA_HAN;
                tong_so_dang_giai_quyet = parseInt(dang_giai_quyet_chua_den_han) + parseInt(dang_giai_quyet_qua_han);

                da_giai_quyet_som_han = respone[index].C_COUNT_TRA_SOM_HAN;
                da_giai_quyet_dung_han = respone[index].C_COUNT_TRA_DUNG_HAN;
                da_giai_quyet_qua_han = respone[index].C_COUNT_TRA_QUA_HAN;
                tong_so_da_giai_quyet = parseInt(da_giai_quyet_som_han) + parseInt(da_giai_quyet_dung_han) + parseInt(da_giai_quyet_qua_han);

                tam_dung_bo_sung = respone[index].C_COUNT_BO_SUNG;
                tam_dung_nvtc = respone[index].C_COUNT_NVTC;

                huy_ho_so_tu_choi = respone[index].C_COUNT_TU_CHOI;
                huy_ho_so_cong_dan_rut = respone[index].C_COUNT_CONG_DAN_RUT;


                cho_tra_trong_ky = respone[index].C_COUNT_CHO_TRA_TRONG_KY;
                cho_tra_ky_truoc = respone[index].C_COUNT_CHO_TRA_KY_TRUOC;
                tong_so_cho_tra = parseInt(cho_tra_trong_ky) + parseInt(cho_tra_ky_truoc);

                if(tong_so_da_giai_quyet == 0)
                {
                    ty_le = '---';
                }
                else
                {
                    ty_le = ((parseInt(da_giai_quyet_som_han) + parseInt(da_giai_quyet_dung_han))/tong_so_da_giai_quyet) * 100;

                    ty_le = number_format(ty_le,0) + '%';
                }


                unit_name = respone[index].C_NAME;

                count = count + 1;
                //push du lieu tong hop cua thang hien tai
                push_total_cur_month(respone[index]);
            }

            total_cur_month.tong_so_don_vi = $(respone).length;
            total_cur_month.ngay_tao = respone[0].C_CREATE_DATE_DMY;
            //hien thi thong tin tong hop cua thang hien tai
            show_total_of_cur_month();
        });
        
        //hien thi tong hop cua ca tinh tai bang tong hop
        function show_total_of_cur_month()
        {
            if(total_cur_month.tong_so_da_giai_quyet == 0)
            {
                total_cur_month.ty_le = '---';
            }
            else
            {
                total_cur_month.ty_le = ((parseInt(total_cur_month.da_giai_quyet_som_han) + parseInt(total_cur_month.da_giai_quyet_dung_han))/total_cur_month.tong_so_da_giai_quyet) * 100;

                total_cur_month.ty_le = number_format(total_cur_month.ty_le,0) + '%';
            }

            var html = '';
            html += '<td>Tổng số <br>('+ total_cur_month.tong_so_don_vi +' đơn vị)</td>';
            html += '<td>'+ total_cur_month.tiep_nhan_ky_truoc +'</td>';
            html += '<td>'+ total_cur_month.tiep_nhan_trong_ky +'</td>';

            html += '<td>'+ total_cur_month.tong_so_dang_giai_quyet +'</td>';
            html += '<td>'+ total_cur_month.dang_giai_quyet_chua_den_han +'</td>';
            html += '<td>'+ total_cur_month.dang_giai_quyet_qua_han +'</td>';

            html += '<td>'+ total_cur_month.tong_so_da_giai_quyet +'</td>';
            html += '<td>'+ total_cur_month.da_giai_quyet_som_han +'</td>';
            html += '<td>'+ total_cur_month.da_giai_quyet_dung_han +'</td>';
            html += '<td>'+ total_cur_month.da_giai_quyet_qua_han +'</td>';

            html += '<td>'+ total_cur_month.tam_dung_bo_sung +'</td>';
            html += '<td>'+ total_cur_month.tam_dung_nvtc +'</td>';

            html += '<td>'+ total_cur_month.huy_ho_so_tu_choi +'</td>';
            html += '<td>'+ total_cur_month.huy_ho_so_cong_dan_rut +'</td>';

            html += '<td>'+ total_cur_month.tong_so_cho_tra +'</td>';
            html += '<td>'+ total_cur_month.cho_tra_trong_ky +'</td>';
            html += '<td>'+ total_cur_month.cho_tra_ky_truoc +'</td>';
            html += '<td>'+ total_cur_month.ty_le +'</td>';
            $('#' + id_table_synthesis_footer + ' .tr_tong').append(html);

            //show statistic of cur month
            $('#' + id_statistic_cur_month).find('.statistic-percent').html(total_cur_month.ty_le);
            $('#' + id_statistic_cur_month).find('.statistic-date').html('(Tự động cập nhật: '+ total_cur_month.ngay_tao +')');
        }
        //tinh toan tong hop
        function push_total_cur_month(item){
            total_cur_month.tiep_nhan_ky_truoc += parseInt(item.C_COUNT_KY_TRUOC);
            total_cur_month.tiep_nhan_trong_ky += parseInt(item.C_COUNT_TIEP_NHAN);

            total_cur_month.dang_giai_quyet_chua_den_han += parseInt(item.C_COUNT_THU_LY_CHUA_DEN_HAN);
            total_cur_month.dang_giai_quyet_qua_han += parseInt(item.C_COUNT_THU_LY_QUA_HAN);
            total_cur_month.tong_so_dang_giai_quyet += parseInt(item.C_COUNT_THU_LY_CHUA_DEN_HAN) + parseInt(item.C_COUNT_THU_LY_QUA_HAN);

            total_cur_month.da_giai_quyet_som_han += parseInt(item.C_COUNT_TRA_SOM_HAN);
            total_cur_month.da_giai_quyet_dung_han += parseInt(item.C_COUNT_TRA_DUNG_HAN);
            total_cur_month.da_giai_quyet_qua_han += parseInt(item.C_COUNT_TRA_QUA_HAN);
            total_cur_month.tong_so_da_giai_quyet += parseInt(item.C_COUNT_TRA_SOM_HAN) + parseInt(item.C_COUNT_TRA_DUNG_HAN) + parseInt(item.C_COUNT_TRA_QUA_HAN);

            total_cur_month.tam_dung_bo_sung += parseInt(item.C_COUNT_BO_SUNG);
            total_cur_month.tam_dung_nvtc += parseInt(item.C_COUNT_NVTC);

            total_cur_month.huy_ho_so_tu_choi += parseInt(item.C_COUNT_TU_CHOI);
            total_cur_month.huy_ho_so_cong_dan_rut += parseInt(item.C_COUNT_CONG_DAN_RUT);


            total_cur_month.cho_tra_trong_ky += parseInt(item.C_COUNT_CHO_TRA_TRONG_KY);
            total_cur_month.cho_tra_ky_truoc += parseInt(item.C_COUNT_CHO_TRA_KY_TRUOC);
            total_cur_month.tong_so_cho_tra += parseInt(item.C_COUNT_CHO_TRA_TRONG_KY) + parseInt(item.C_COUNT_CHO_TRA_KY_TRUOC);
        }
        
        //format naumber
        function number_format(n,d)
        {
            var number = String(n.toFixed(d).replace('.',','));
            return number.replace(/./g, function(c, i, a) {
                        return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
                    });
        }
        //hien thi tong hop tinh theo nam
        sv.data.synthesis_year_province('', function(respone){
           var tiep_nhan = respone.C_COUNT_TIEP_NHAN;
           var ky_truoc = respone.C_COUNT_TIEP_NHAN_KY_TRUOC;
           var dung_han = respone.C_COUNT_TRA_DUNG_HAN;
           var qua_han = respone.C_COUNT_TRA_QUA_HAN;
           var som_han = respone.C_COUNT_TRA_SOM_HAN;
           
           var total = parseInt(tiep_nhan) + parseInt(ky_truoc);
           var hoan_thanh = parseInt(dung_han) + parseInt(qua_han) + parseInt(som_han);
           
           var selector = $('#' + id_synthesis_year);
           $(selector).find('p.total').html(total);
           $(selector).find('p.receive').html('ĐÃ TIẾP NHẬN: ' + tiep_nhan);
           $(selector).find('p.done').html('ĐÃ GIẢI QUYẾT: ' + hoan_thanh);
        });
    });
})();