google.charts.load('current', {'packages': ['corechart']});

var synthesis_function = {};
var synthesis_config = {};

synthesis_config.id_sel_member = 'sel_member';
synthesis_config.id_sel_year = 'sel_year';
synthesis_config.id_sel_month = 'sel_month';
synthesis_config.id_sel_quarter = 'sel_quarter';
synthesis_config.id_div_action = 'div-action';
synthesis_config.id_table_synthesis = 'table-synthesis';
synthesis_config.id_table_synthesis_footer = 'table-synthesis-footer';

synthesis_config.all_year = {};
synthesis_config.all_month = {};

synthesis_config.filter = {
    member: '',
    year: '',
    period: '',
    period_value: '',
};
synthesis_config.total = {
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
synthesis_config.chart = {};
synthesis_config.chart.bar = {};
synthesis_config.chart.pie = {};

synthesis_config.chart.bar.data = {};
synthesis_config.chart.bar.options = {};
synthesis_config.chart.bar.dom = {};

synthesis_config.chart.pie.data = {};
synthesis_config.chart.pie.options = {};
synthesis_config.chart.pie.dom = {};

synthesis_function.show_month = function () {
    //reset
    $('#' + synthesis_config.id_sel_month).html('');

    //fill
    var year = $('#' + synthesis_config.id_sel_year).val();
    var data = synthesis_config.all_month[year];
    var html = '';
    var selected = '';
    var month = '';

    for (var index in data)
    {
        month = data[index];
        selected = (month == cur_month) ? 'selected' : '';
        html += '<option value="' + month + '" ' + selected + '>' + month + '</option>';
    }
    $('#' + synthesis_config.id_sel_month).html(html);
};

//tinh toan tong hop
synthesis_function.push_total_cur_month = function (item) {
    synthesis_config.total.tiep_nhan_ky_truoc += parseInt(item.C_COUNT_KY_TRUOC);
    synthesis_config.total.tiep_nhan_trong_ky += parseInt(item.C_COUNT_TIEP_NHAN);

    synthesis_config.total.dang_giai_quyet_chua_den_han += parseInt(item.C_COUNT_THU_LY_CHUA_DEN_HAN);
    synthesis_config.total.dang_giai_quyet_qua_han += parseInt(item.C_COUNT_THU_LY_QUA_HAN);
    synthesis_config.total.tong_so_dang_giai_quyet += parseInt(item.C_COUNT_THU_LY_CHUA_DEN_HAN) + parseInt(item.C_COUNT_THU_LY_QUA_HAN);

    synthesis_config.total.da_giai_quyet_som_han += parseInt(item.C_COUNT_TRA_SOM_HAN);
    synthesis_config.total.da_giai_quyet_dung_han += parseInt(item.C_COUNT_TRA_DUNG_HAN);
    synthesis_config.total.da_giai_quyet_qua_han += parseInt(item.C_COUNT_TRA_QUA_HAN);
    synthesis_config.total.tong_so_da_giai_quyet += parseInt(item.C_COUNT_TRA_SOM_HAN) + parseInt(item.C_COUNT_TRA_DUNG_HAN) + parseInt(item.C_COUNT_TRA_QUA_HAN);

    synthesis_config.total.tam_dung_bo_sung += parseInt(item.C_COUNT_BO_SUNG);
    synthesis_config.total.tam_dung_nvtc += parseInt(item.C_COUNT_NVTC);

    synthesis_config.total.huy_ho_so_tu_choi += parseInt(item.C_COUNT_TU_CHOI);
    synthesis_config.total.huy_ho_so_cong_dan_rut += parseInt(item.C_COUNT_CONG_DAN_RUT);


    synthesis_config.total.cho_tra_trong_ky += parseInt(item.C_COUNT_CHO_TRA_TRONG_KY);
    synthesis_config.total.cho_tra_ky_truoc += parseInt(item.C_COUNT_CHO_TRA_KY_TRUOC);
    synthesis_config.total.tong_so_cho_tra += parseInt(item.C_COUNT_CHO_TRA_TRONG_KY) + parseInt(item.C_COUNT_CHO_TRA_KY_TRUOC);
};

synthesis_function.show_total_of_cur_month = function () {
    if (synthesis_config.total.tong_so_da_giai_quyet == 0)
    {
        synthesis_config.total.ty_le = '---';
    }
    else
    {
        synthesis_config.total.ty_le = ((parseInt(synthesis_config.total.da_giai_quyet_som_han) + parseInt(synthesis_config.total.da_giai_quyet_dung_han)) / synthesis_config.total.tong_so_da_giai_quyet) * 100;

        synthesis_config.total.ty_le = Math.round(synthesis_config.total.ty_le) + '%';
    }

    var html = '';
    html += '<td>Tổng số <br>(' + synthesis_config.total.tong_so_don_vi + ' đơn vị)</td>';
    html += '<td>' + synthesis_config.total.tiep_nhan_ky_truoc + '</td>';
    html += '<td>' + synthesis_config.total.tiep_nhan_trong_ky + '</td>';

    html += '<td>' + synthesis_config.total.tong_so_dang_giai_quyet + '</td>';
    html += '<td>' + synthesis_config.total.dang_giai_quyet_chua_den_han + '</td>';
    html += '<td>' + synthesis_config.total.dang_giai_quyet_qua_han + '</td>';

    html += '<td>' + synthesis_config.total.tong_so_da_giai_quyet + '</td>';
    html += '<td>' + synthesis_config.total.da_giai_quyet_som_han + '</td>';
    html += '<td>' + synthesis_config.total.da_giai_quyet_dung_han + '</td>';
    html += '<td>' + synthesis_config.total.da_giai_quyet_qua_han + '</td>';

    html += '<td>' + synthesis_config.total.tam_dung_bo_sung + '</td>';
    html += '<td>' + synthesis_config.total.tam_dung_nvtc + '</td>';

    html += '<td>' + synthesis_config.total.huy_ho_so_tu_choi + '</td>';
    html += '<td>' + synthesis_config.total.huy_ho_so_cong_dan_rut + '</td>';

    html += '<td>' + synthesis_config.total.tong_so_cho_tra + '</td>';
    html += '<td>' + synthesis_config.total.cho_tra_trong_ky + '</td>';
    html += '<td>' + synthesis_config.total.cho_tra_ky_truoc + '</td>';
    html += '<td>' + synthesis_config.total.ty_le + '</td>';
    $('#' + synthesis_config.id_table_synthesis_footer + ' .tr_tong').append(html);
};

synthesis_function.show_data = function (respone)
{
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
    for (var index in respone)
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

        if (tong_so_da_giai_quyet == 0)
        {
            ty_le = '---';
        }
        else
        {
            ty_le = ((parseInt(da_giai_quyet_som_han) + parseInt(da_giai_quyet_dung_han)) / tong_so_da_giai_quyet) * 100;

            ty_le = Math.round(ty_le) + '%';
        }


        unit_name = respone[index].C_NAME;

        html += '<tr class="text-center item">';
        html += '<td>' + count + '. ' + unit_name + '</td>';
        html += '<td>' + tiep_nhan_ky_truoc + '</td>';
        html += '<td>' + tiep_nhan_trong_ky + '</td>';

        html += '<td>' + tong_so_dang_giai_quyet + '</td>';
        html += '<td>' + dang_giai_quyet_chua_den_han + '</td>';
        html += '<td>' + dang_giai_quyet_qua_han + '</td>';

        html += '<td>' + tong_so_da_giai_quyet + '</td>';
        html += '<td>' + da_giai_quyet_som_han + '</td>';
        html += '<td>' + da_giai_quyet_dung_han + '</td>';
        html += '<td>' + da_giai_quyet_qua_han + '</td>';

        html += '<td>' + tam_dung_bo_sung + '</td>';
        html += '<td>' + tam_dung_nvtc + '</td>';

        html += '<td>' + huy_ho_so_tu_choi + '</td>';
        html += '<td>' + huy_ho_so_cong_dan_rut + '</td>';

        html += '<td>' + tong_so_cho_tra + '</td>';
        html += '<td>' + cho_tra_trong_ky + '</td>';
        html += '<td>' + cho_tra_ky_truoc + '</td>';
        html += '<td>' + ty_le + '</td>';
        html += '</tr>';

        $('#' + synthesis_config.id_table_synthesis + ' tbody').append(html);

        count = count + 1;
        //push du lieu tong hop cua thang hien tai
        synthesis_function.push_total_cur_month(respone[index]);
    }

    synthesis_config.total.tong_so_don_vi = $(respone).length;
    synthesis_config.total.ngay_tao = respone[0].C_CREATE_DATE_DMY;
    //hien thi thong tin tong hop cua thang hien tai
    synthesis_function.show_total_of_cur_month();
};

synthesis_function.clear_filter = function () {
    $('#' + synthesis_config.id_sel_member).find('option:selected').removeAttr('selected');
    $('#' + synthesis_config.id_sel_member).find('option:first').attr('selected', 'selected');
    synthesis_function.show_year();
    synthesis_function.show_month();
    synthesis_function.show_quarter();
};

synthesis_function.show_quarter = function () {
    //reset
    $('#' + synthesis_config.id_sel_quarter).html('');

    //fill
    var year = $('#' + synthesis_config.id_sel_year).val();
    var data_month = synthesis_config.all_month[year];
    var quarter = Math.ceil(parseInt($(data_month).length) / 3);
    var html = '';
    var cur_quarter = Math.ceil(parseInt(cur_month) / 3);
    var selected = '';

    for (var i = 1; i <= quarter; i++) {

        selected = (cur_quarter == i) ? 'selected' : '';
        html += '<option value="' + i + '" ' + selected + '>' + i + '</option>';
    }
    $('#' + synthesis_config.id_sel_quarter).html(html);
};

synthesis_function.show_year = function () {
    //reset
    $('#' + synthesis_config.id_sel_year).html('');

    //fill
    var html = '';
    var year = '';
    var selected = '';
    for (var index in synthesis_config.all_year)
    {
        year = synthesis_config.all_year[index];
        selected = (year == cur_year) ? 'selected' : '';

        html += '<option value="' + year + '" ' + selected + '>' + year + '</option>';
    }
    $('#' + synthesis_config.id_sel_year).html(html);
};

synthesis_function.show_period_filter = function (type)
{
    var selector = '.period_' + type + '.period_filter';

    //an toan bo filter
    $('.period_filter').each(function () {
        $(this).hide();
    });
    //hien thi
    $(selector).show();
};

synthesis_function.show_table_synthesis = function () {
    var title = 'Bảng tổng hợp giải quyết thủ tục hành chính ';

    //lay du lieu
    synthesis_config.filter.member = $('#' + synthesis_config.id_sel_member).val();
    synthesis_config.filter.year = $('#' + synthesis_config.id_sel_year).val();
    synthesis_config.filter.period = $('input[name="rad_period"]:checked').val();
    if (synthesis_config.filter.period == 'month')
    {
        synthesis_config.filter.period_value = $('#' + synthesis_config.id_sel_month).val();
        title = title + 'tháng ' + synthesis_config.filter.period_value + '/' + synthesis_config.filter.year;
    }
    else if (synthesis_config.filter.period == 'quarter')
    {
        synthesis_config.filter.period_value = $('#' + id_sel_quarter).val();
        title = title + 'quý ' + synthesis_config.filter.period_value + '/' + synthesis_config.filter.year;
    }
    else
    {
        title = title + 'năm ' + synthesis_config.filter.year;
    }

    //hien thi title
    $('.table-res .tab_header h3').html(title);
    //reset total
    synthesis_config.total = {
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

    //lay du lieu
    sv.data.synthesis_lookup(synthesis_config.filter.period, synthesis_config.filter.member, synthesis_config.filter.period_value, synthesis_config.filter.year, function (respone) {
        $('#' + synthesis_config.id_table_synthesis_footer + ' .tr_tong').html('');
        $('#' + synthesis_config.id_table_synthesis + ' tbody').find('tr.item').each(function () {
            $(this).remove();
        });

        synthesis_function.show_data(respone);
    });
};
//bieu do 
synthesis_function.build_data_bar_chart = function(){
    //chuan bi du lieu
        var int_cur_month = parseInt(cur_month);
        var int_cur_year = parseInt(cur_year);
        var count_month_of_cur_year = ((6 - int_cur_month) > 0)? int_cur_month: 6;
        var count_month_of_prev_year = ((6 - int_cur_month) > 0)? (6 - int_cur_month): 0;
        var prev_year = int_cur_year - 1;
        var tmp_month = '';

        var title = '';
        var tiep_nhan = 0;
        var giai_quyet = 0;
        var dung_han = 0;
        var ty_le = 0;
        var tmp_data = [];
        var arr_title = [['Tháng', 'Tiếp nhận', 'Giải quyết', 'Đúng hạn', '% Trả đúng hạn']];

        for(var i = 0; i < count_month_of_cur_year; i++)
        {
            tmp_month = ((int_cur_month - i) > 9)? (int_cur_month - i): '0' + (int_cur_month - i);

            sv.data.synthesis_month_province(synthesis_config.filter.member, tmp_month, cur_year, function(response){
                title = tmp_month + '/' + cur_year;
                tiep_nhan = parseInt(response.TIEP_NHAN_TRONG_KY) + parseInt(response.TIEP_NHAN_KY_TRUOC);
                giai_quyet = parseInt(response.TRA_SOM_HAN) + parseInt(response.TRA_DUNG_HAN) + parseInt(response.TRA_QUA_HAN);
                dung_han = parseInt(response.TRA_SOM_HAN) + parseInt(response.TRA_DUNG_HAN);
                ty_le  =  Math.round((dung_han/(dung_han + parseInt(response.TRA_QUA_HAN))) * 100);
                tmp_data.push([title,tiep_nhan,giai_quyet,dung_han,ty_le]);
            }, false);
        }

        for(var i = 0; i < count_month_of_prev_year; i++){
            tmp_month = ((12 - i) > 9)? (12 - i): '0' + (12 - i);
            
            sv.data.synthesis_month_province(synthesis_config.filter.member, tmp_month, prev_year, function(response){
                title = tmp_month + '/' + prev_year;
                tiep_nhan = parseInt(response.TIEP_NHAN_TRONG_KY) + parseInt(response.TIEP_NHAN_KY_TRUOC);
                giai_quyet = parseInt(response.TRA_SOM_HAN) + parseInt(response.TRA_DUNG_HAN) + parseInt(response.TRA_QUA_HAN);
                dung_han = parseInt(response.TRA_SOM_HAN) + parseInt(response.TRA_DUNG_HAN);
                ty_le  =  Math.round((dung_han/(dung_han + parseInt(response.TRA_QUA_HAN))) * 100);
                tmp_data.push([title,tiep_nhan,giai_quyet,dung_han,ty_le]);
            }, false);
        }

        tmp_data.reverse();//order nguoc lại thứ tự hiển thị
        synthesis_config.chart.bar.data = arr_title.concat(tmp_data);
        synthesis_config.chart.bar.options = {
            height: 300,
            hAxis: {title: 'Tháng'},
            seriesType: 'bars',
            vAxes: { 0: { title: "Hồ sơ"}, 1: {title: '%'}},
            series: {3: {type: 'line', targetAxisIndex: 1 }}
        };
        synthesis_config.chart.bar.dom = document.getElementById('combo-chart');
};

synthesis_function.build_data_pie_chart = function(){
    var tra_som = 0;
    var tra_dung = 0;
    var tra_qua = 0;
    var dung_han = 0;
    var qua_han = 0;
    
    sv.data.synthesis_year(synthesis_config.filter.member, cur_year, function(response){
        for(var index in response)
        {
            tra_som = tra_som + parseInt(response[index].C_COUNT_TRA_SOM_HAN);
            tra_dung = tra_som + parseInt(response[index].C_COUNT_TRA_DUNG_HAN);
            tra_qua = tra_som + parseInt(response[index].C_COUNT_TRA_QUA_HAN);
        }
    },false);
    dung_han = tra_som + tra_dung;
    qua_han = tra_qua;
    
    synthesis_config.chart.pie.data = {dung_han: dung_han,
                                    qua_han: qua_han};
    synthesis_config.chart.pie.options = {
            'height': 300,
            'top': 0,
            'left': 0,
            legend: {position: 'top'}
        };
    synthesis_config.chart.pie.dom = document.getElementById('pie-chart');
};

//set event
(function () {
    $(document).ready(function () {
        //hien thi select member
        sv.data.all_member('', function (respone) {
            var html = '<option value="-1">--- Tất cả ---</option>';
            var member_name = '';
            var selected = '';
            for (var member_code in respone)
            {
                member_name = respone[member_code];
                selected = (MEMBER == member_code) ? 'selected' : '';
                html += '<option value="' + member_code + '" ' + selected + '>' + member_name + '</option>';
            }
            $('#' + synthesis_config.id_sel_member).html(html);
        }, false);

        //hien thi danh sach nam
        sv.data.all_year_has_data(function (respone) {
            synthesis_config.all_year = respone;
            synthesis_function.show_year();
        }, false);

        //hien thi danh sach thang
        sv.data.all_month_has_data(function (respone) {
            synthesis_config.all_month = respone;
            synthesis_function.show_month();
            synthesis_function.show_quarter();
        }, false);

        //hien thi lua chon ky bao cao
        $('input[name="rad_period"]').click(function () {
            synthesis_function.show_period_filter($(this).val());
        });

        //active ky bao cao dau tien
        $('input[name="rad_period"]:first').trigger('click');

        //set event cho nut clear filter
        $('#' + synthesis_config.id_div_action).find('.clear-filter').click(function () {
            synthesis_function.clear_filter();
        });

        //set event nut loc
        $('#' + synthesis_config.id_div_action).find('.filter').click(function () {
            //hien thi bang tong hop
            synthesis_function.show_table_synthesis();
            //hien thi bieu do cot
            synthesis_function.build_data_bar_chart();
            google.charts.setOnLoadCallback(gDrawChartBar);
            //hien thi bieu do tron
            synthesis_function.build_data_pie_chart();
            google.charts.setOnLoadCallback(gDrawChartPie);
            
            //ham ve
            function gDrawChartBar() {
                // Some raw data (not necessarily accurate)
                var chart = new google.visualization.ComboChart(synthesis_config.chart.bar.dom);
                var chart_data = google.visualization.arrayToDataTable(synthesis_config.chart.bar.data);
                var options = synthesis_config.chart.bar.options;
                
                chart.draw(chart_data, options);
            }
            
            function gDrawChartPie() {
                // Some raw data (not necessarily accurate)
                var chart = new google.visualization.PieChart(synthesis_config.chart.pie.dom);
                var options = synthesis_config.chart.pie.options;
                var chart_data = new google.visualization.DataTable();
                
                chart_data.addColumn('string', 'Topping');
                chart_data.addColumn('number', 'Slices');
                chart_data.addRows([
                    ['Đúng hạn', synthesis_config.chart.pie.data.dung_han],
                    ['Quá hạn', synthesis_config.chart.pie.data.qua_han]
                ]);
                
                chart.draw(chart_data, options);
            }
        }).trigger('click');

        //set slim scroll
        $('#slim_scroll').slimScroll({
            height: '250px'
        });
        $('#tab_result').slimScroll({
            height: '138px'
        });
    });
})();