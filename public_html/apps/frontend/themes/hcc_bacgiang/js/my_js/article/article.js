(function(){
    $(document).ready(function(){
        sv.data.article(website_id, cat_id, art_id, function(respone){
            var title = respone.C_TITLE;
            var create_date = respone.C_BEGIN_DATE;
            var summary = respone.C_SUMMARY;
            var content = respone.C_CONTENT;
            
            $('.news_head h2').html(title);
            $('.news_date h6').html(create_date);
            $('.intro_head h4').html(summary);
            $('.news_fulltext').html(content);
        });
        
        sv.data.other_article(cat_id, art_id, function(respone){
            var title = '';
            var create_date = '';
            var url_file_name = '';
            var url_artile = '';
            var cat_slug = '';
            var art_slug = '';
            var html = '';
            var other_cat_id = '';
            var other_art_id = '';
            
            for(var index in respone)
            {
                title = respone[index].C_TITLE;
                create_date = respone[index].C_BEGIN_DATE;
                url_file_name = sv.url.file(respone[index].C_FILE_NAME);
                cat_slug = respone[index].C_CAT_SLUG;
                art_slug = respone[index].C_SLUG;
                
                other_cat_id = respone[index].PK_CATEGORY;
                other_art_id = respone[index].PK_ARTICLE;
                
                url_artile = sv.url.build_article(cat_slug, art_slug, website_id, other_cat_id, other_art_id);
                
                html = '<div class="col-md-3 col-sm-4 col-xs-6">';
                html += '   <div class="img-news">';
                html += '       <div col-md-12>';
                html += '            <a href="'+ url_artile +'"><img src="'+ url_file_name +'"></a>';
                html += '        </div>';    
                html += '       </div>';
                html += '       <div class="info-news">';
                html += '           <div class="row">';
                html += '               <div col-md-12>';
                html += '                   <h3><a href="'+ url_artile +'">'+ title +'</a></h3>';
                html += '               </div>';
                html += '           </div>';
                html += '           <div class="row">';
                html += '               <div col-md-12>';
                html += '                   <h6>'+ create_date +'</h6>';
                html += '            </div>';
                html += '        </div>';
                html += '    </div>';
                html += '</div>';
                
                $('.sec_news .best-news').append(html);
            }
            
            //buidl category
            $('.sec_news .best-news .see_more a').attr('href', sv.url.build_category(cat_slug, website_id, cat_id));
        });
        
       
    });
})();