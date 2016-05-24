$(function () {
    $(document).ready(function(){
        var id_list_member = 'list-member';
        var class_unit_so = "list_unit";
        var class_unit_huyen = "list_unit_huyen";
        
        var url = {};
        url.img = SITE_ROOT + "templates/hcc_bacgiang/img/";
        
        sv.data.all_member('1',function(respone){
            var scope = '';
            for(var index in respone)
            {
                show_item(respone[index]);
            }
        });
        function show_item(data){
            var scope = data.C_SCOPE;
            var login_url = (data.C_LOGIN_URL == '')? 'javascript:void(0)': data.C_LOGIN_URL;
            var name = data.C_NAME;
            var selector = '';
            var html = '';
            
            if(scope == '0')
                selector = '#' + id_list_member + ' .' + class_unit_so;
            else
                selector = '#' + id_list_member + ' .' + class_unit_huyen;
            
            html += '<div class="col-lg-5ths col-md-5ths col-sm-4 col-xs-6 cb_unit">';
            html += '     <div class="c_b">';
            html += '         <a href="'+ login_url +'" target="_blank"><img src="'+ url.img +'/ban-dan-toc.png" alt="'+ name +'" /></a>';
            html += '         <a href="'+ login_url +'" target="_blank"><h4 class="text-center">'+ name +'</h4></a>';
            html += '     </div>';
            html += ' </div>';
            
            $(selector).append(html);
        }
    });

});


