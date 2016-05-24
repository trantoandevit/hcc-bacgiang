(function(){
    $(document).ready(function()
    {
        if($('#thongbao').length == 1)
        {
            //Load danh sách văn bản mới nhất
            sv.data.notification_new(function(resp)
            {
                var html = '';
                for(var i=0;i<resp.length;i++)
                {
                    var url_notifi =  sv.url.build_notification(resp[i].C_CAT_SLUG, resp[i].C_SLUG, resp[i].C_DEFAULT_WEBSITE, resp[i].C_DEFAULT_CATEGORY, resp[i].PK_ARTICLE);
                    html += '<p title="'+ resp[i].C_TITLE +'"><span class="fa fa-newspaper-o" style="padding-right:5px"></span><a href="'+ url_notifi +'" >\n\
                             '+ resp[i].C_TITLE +'\n\
                             </a>\n\
                                </p>';
                }
                
                $('#thongbao marquee').html(html);
                var url_cat_notifi = sv.url.build_all_notification(resp[0].C_CAT_SLUG, resp[0].C_DEFAULT_WEBSITE, resp[0].C_DEFAULT_CATEGORY);
                $('#thongbao .thongbao-other a').attr('href',url_cat_notifi);
            },false);
            
        }
    });
    
    
})();