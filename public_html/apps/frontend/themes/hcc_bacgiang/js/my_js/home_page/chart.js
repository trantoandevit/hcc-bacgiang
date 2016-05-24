$(document).ready(function(){
    //hien thi bieu do cot
    var data = [];
    cal_drawVisualization_data();
    
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);
    
    
    function drawVisualization() {
        
        console.log(data);
        // Some raw data (not necessarily accurate)
        var chart_data = google.visualization.arrayToDataTable(data);

        var options = {
            height: 300,
            hAxis: {title: 'Tháng'},
            seriesType: 'bars',
            vAxes: { 0: { title: "Hồ sơ"}, 1: {title: '%'}},
            series: {3: {type: 'line', targetAxisIndex: 1 }}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('combo-chart'));
        chart.draw(chart_data, options);
    }
    
    //tinh toan du lieu cho bieu do cot
    function cal_drawVisualization_data()
    {
        var tmp_data = [];
        var arr_title = [['Tháng', 'Tiếp nhận', 'Giải quyết', 'Đúng hạn', '% Trả đúng hạn']];
        var title = '';
        var tiep_nhan = 0;
        var giai_quyet = 0;
        var dung_han = 0;
        var ty_le = 0;
        var count = 1;
        var count_month = Object.keys(total_all_month_of_year).length;
        count_month = parseInt(count_month);
        
        for(var month in total_all_month_of_year)
        {
            if(count > 6) break;
            
            title = month + '/' + total_all_month_of_year[month].year;
            tiep_nhan = parseInt(total_all_month_of_year[month].TIEP_NHAN_TRONG_KY) + parseInt(total_all_month_of_year[month].TIEP_NHAN_KY_TRUOC);
            giai_quyet = parseInt(total_all_month_of_year[month].TRA_SOM_HAN) + parseInt(total_all_month_of_year[month].TRA_DUNG_HAN) + parseInt(total_all_month_of_year[month].TRA_QUA_HAN);
            dung_han = parseInt(total_all_month_of_year[month].TRA_SOM_HAN) + parseInt(total_all_month_of_year[month].TRA_DUNG_HAN);
            ty_le  =  Math.round((dung_han/(dung_han + parseInt(total_all_month_of_year[month].TRA_QUA_HAN))) * 100);
            tmp_data.push([title,tiep_nhan,giai_quyet,dung_han,ty_le]);
            count++;
            
        }
        
        if(count_month < 6)
        {
            var diff = 6 - count_month;
            var month_of_prev_year = 0;
            var prev_year = parseInt(gl_cur_year) - 1;
            for(var i = 0; i < diff; i++)
            {
                month_of_prev_year = 12 - i;
                sv.data.synthesis_month_province('-1', month_of_prev_year, prev_year,function(respone){
                    title = month_of_prev_year + '/' + prev_year;
                    tiep_nhan = parseInt(respone.TIEP_NHAN_TRONG_KY) + parseInt(respone.TIEP_NHAN_KY_TRUOC);
                    giai_quyet = parseInt(respone.TRA_SOM_HAN) + parseInt(respone.TRA_DUNG_HAN) + parseInt(respone.TRA_QUA_HAN);
                    dung_han = parseInt(respone.TRA_SOM_HAN) + parseInt(respone.TRA_DUNG_HAN);
                    ty_le  =  Math.round((dung_han/(dung_han + parseInt(respone.TRA_QUA_HAN))) * 100);
                    tmp_data.push([title,tiep_nhan,giai_quyet,dung_han,ty_le]);
                }, false);
            }
        }
        
        tmp_data.reverse();//order nguoc lại thứ tự hiển thị
        data = arr_title.concat(tmp_data);//merge array
    }
    
    //hien thi bieu do hinh tron
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        var dung_han = parseInt(total_all_month_of_year[gl_cur_month].TRA_SOM_HAN) + parseInt(total_all_month_of_year[gl_cur_month].TRA_DUNG_HAN);;
        var qua_han = parseInt(total_all_month_of_year[gl_cur_month].TRA_QUA_HAN);
        
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['Đúng hạn', dung_han],
            ['Quá hạn', qua_han]
        ]);

        // Set chart options
        var options = {
            'height': 300,
            'top': 0,
            'left': 0,
            legend: {position: 'top'}
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
        chart.draw(data, options);
    }
});