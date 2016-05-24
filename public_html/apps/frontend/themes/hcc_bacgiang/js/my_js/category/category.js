(function(){
    var id_categoy = 'categoy-details';
    var html_first_row = '';
    $(document).ready(function(){
        var filter = {
            page: 1,
            key_word: '',
            cat_id: cat_id,
            website_id: website_id,
            cat_slug: '',
            cat_name: '',
            total: '',
            total_page: 1
        };
        
        var data_first_row = {count: 0, data: {}};
        
        $('#' + id_categoy).find('.xem_them button').click(function(responne){
            filter.page = $(this).val();
            get_data();
        }).trigger('click');
        
        $('#' + id_categoy).find("#txt_searh").keyup(function (e) {
            if (e.keyCode == 13) {
                $('#' + id_categoy).find('div#div_all_art').html('');
                filter.page = 1;
                filter.key_word = $(this).val();
                get_data();
            }
        });
        
        
        function get_data(responne){
            sv.data.art_of_cat(filter.page, filter.website_id, filter.cat_id, filter.key_word, function(responne){
                filter.total = responne.TOTAL_RECORD;
                filter.cat_slug = responne.CAT_SLUG;
                filter.cat_name = responne.CAT_NAME;
                filter.total_page = Math.ceil(parseInt(filter.total)/parseInt(rows_per_page));

                if(parseInt(filter.page) < parseInt(filter.total_page))
                {
                    var next_page = parseInt(filter.page) + 1;
                    $('#' + id_categoy).find('.xem_them').show();
                    $('#' + id_categoy).find('.xem_them button').value(next_page);
                }
                else
                {
                    $('#' + id_categoy).find('.xem_them').hide();
                }

                var data = responne.data;
                var url = '';
                var count_item = (parseInt(filter.page) == 1)? 1: parseInt($('#' + id_categoy).find('#div_all_art .art-item').length) + 1;
                $('#' + id_categoy).find('.lsc_head h3').html(filter.cat_name);
                
                for(var index in data){
                    if(filter.page == 1 && parseInt(index) <= 1 && parseInt(filter.total) > 2 )
                    {
                        show_first_row(data[index]);
                    }
                    else
                    {
                        show_item(data[index], count_item);
                        if(count_item%2 == 0)
                        {
                            show_seperate();
                        }

                        count_item = count_item + 1;
                    }
                }
            });
        }
        //show chi tiet
        function show_item(data, count_item){
            var html = '';
            var tilte = data.C_TITLE;
            var url_img = sv.url.file(data.C_FILE_NAME);
            var date = data.C_BEGIN_DATE;
            var summary = data.C_SUMMARY;
            var art_slug = data.C_SLUG;
            var art_id = data.PK_ARTICLE;
            var link = sv.url.build_article(filter.cat_slug, art_slug, filter.website_id, filter.cat_id, art_id);
            var item_class = 'cn_left';
            
            if(count_item%2 == 0)
            {
                item_class = 'cn_right';
            }
            
            html = '';
            html += '<div class="col-md-6 '+ item_class +' art-item">';
            html += '    <div class="row">';
            html += '        <div class="col-md-4 col-sm-3 col-xs-6 news_img">';
            html += '            <a href="'+ link +'"><img src="'+ url_img +'" alt="" /></a>';
            html += '        </div>';
            html += '        <div class="col-md-8 col-sm-6 col-xs-6 n_content">';
            html += '            <div class="r3_content_head">';
            html += '                <h4><a href="'+ link +'">'+ tilte +'</a></h4>';
            html += '            </div>';
            html += '            <div class="r3_content_date">';
            html += '                <h6>'+ date +'</h6>';
            html += '            </div>';
            html += '        </div>';
            html += '    </div>';
            html += '    <div class="row ">';
            html += '        <div class="col-md-12">';
            html += '            <div class="r3_content">';
            html += '                <p>'+ summary +'</p>';
            html += '            </div>';
            html += '        </div>';
            html += '    </div>';
            html += '</div>';
            
            $('#' + id_categoy).find('div#div_all_art').append(html);
        }
        
        //hien thi ngan cach
        function show_seperate(){
            var html = '';
            html += '<div class="row bor_top" >';
            html += '    <div class="col-md-12">';
            html += '        <div class="box_border_top" style="margin: 10px">';
            html += '        </div>';
            html += '    </div>';
            html += '</div>';
            
            $('#' + id_categoy).find('div#div_all_art').append(html);
        }
        
        //show row dau tien
        function show_first_row(data){
            data_first_row.count = data_first_row.count + 1;
            data_first_row.data[data_first_row.count] = data;
            
            if(data_first_row.count == 2)
            {
                var tilte_1 = data_first_row.data[1].C_TITLE;
                var url_img_1 = sv.url.file(data_first_row.data[1].C_FILE_NAME);
                var date_1 = data_first_row.data[1].C_BEGIN_DATE;
                var summary_1 = data_first_row.data[1].C_SUMMARY;
                var art_slug_1 = data_first_row.data[1].C_SLUG;
                var art_id_1 = data_first_row.data[1].PK_ARTICLE;
                var link_1 = sv.url.build_article(filter.cat_slug, art_slug_1, filter.website_id, filter.cat_id, art_id_1);
                
                var tilte_2 = data_first_row.data[2].C_TITLE;
                var url_img_2 = sv.url.file(data_first_row.data[2].C_FILE_NAME);
                var date_2 = data_first_row.data[2].C_BEGIN_DATE;
                var summary_2 = data_first_row.data[2].C_SUMMARY;
                var art_slug_2 = data_first_row.data[2].C_SLUG;
                var art_id_2 = data_first_row.data[2].PK_ARTICLE;
                var link_2 = sv.url.build_article(filter.cat_slug, art_slug_2, filter.website_id, filter.cat_id, art_id_2);
                
                var html = '';
                html += '<div class="row n2">';
                html += '    <div class="col-md-9 col-sm-9 left_news">';
                html += '        <div class="row">';
                html += '            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
                html += '                <div class="box_img_main">';
                html += '                    <a href="'+ link_1 +'"><img src="'+ url_img_1 +'"></a>';
                html += '                </div>';
                html += '            </div>';
                html += '            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
                html += '                <div class="text_info">';
                html += '                    <div class="ti_top">';
                html += '                        <h3><a href="'+ link_1 +'">'+ tilte_1 +'</a></h3>';
                html += '                    </div>';
                html += '                    <div class="ti_bottom">';
                html += '                        <div class="ti_date">';
                html += '                            <p>'+ date_1 +'</p>';
                html += '                        </div>';
                html += '                        <div class="ti_content">';
                html += '                            <p>'+ summary_1 +'</p>';
                html += '                        </div>';
                html += '                    </div>';
                html += '                </div>';
                html += '            </div>';
                html += '        </div>';
                html += '     </div>';
                html += '    <div class="col-md-3 col-sm-3 col-xs-12 right_news">';
                html += '        <div class="row">';
                html += '            <div class="r_img_n col-md-12 col-sm-12 col-xs-6">';
                html += '                <a href="'+ link_2 +'"><img src="'+ url_img_2 +'"></a>';
                html += '            </div>';
                html += '            <div class="r_info col-md-12 col-sm-12 col-xs-6">';
                html += '                <div class="ri_head">';
                html += '                    <h3><a href="'+ link_2 +'">'+ tilte_2 +'</a></h3>';
                html += '                </div>';
                html += '                <div class="ri_date">';
                html += '                    <p>'+ date_2 +'</p>';
                html += '                </div>';
                html += '            </div>';
                html += '        </div>';
                html += '    </div>';
                html += '</div>';
                html += '<div class="row n3">';
                html += '    <div class="col-md-12">';
                html += '        <div class="moi_nhat">';
                html += '            <div class="mn_left">';
                html += '                <h3>Mới nhất</h3>';
                html += '            </div>';
                html += '        </div>';
                html += '    </div>';
                html += '</div>';
                
                $('#' + id_categoy).find('div#div_all_art').append(html);
            }
        }
        
    });
    
})();