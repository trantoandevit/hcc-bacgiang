(function () {
    $(document).ready(function () {

        sv.data.sticky(website_id, function(respone) {
            $('.mar_quee marquee').html("");
            var html = '';
            var url = '';
            var cat_slug = '';
            var art_slug = '';
            var cat_id = '';
            var art_id = '';
            var title = '';
            for (var index in respone)
            {
                
                cat_slug = respone[index].C_CAT_SLUG;
                art_slug = respone[index].C_ART_SLUG;
                cat_id = respone[index].PK_CATEGORY;
                art_id = respone[index].PK_ARTICLE;
                title = respone[index].C_TITLE;
                url = sv.url.build_article(cat_slug, art_slug, website_id, cat_id, art_id);
                html += '<a href="' + url + '">' + title + '</a>';
            }

            $('.mar_quee marquee').html(html);
        });

    });
})();