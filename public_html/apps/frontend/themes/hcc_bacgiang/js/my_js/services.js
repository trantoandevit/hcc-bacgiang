var sv = {};

//khai bao cac thu vien
sv.url = {};
sv.data = {};

sv.url.base = SITE_ROOT + 'frontend/api_data/';
sv.url.getService = function (method)
{
    return sv.url.base + method;
};

sv.url.build_article = function (cat_slug, art_slug, website_id, cat_id, art_id) {
    return SITE_ROOT + 'tin-bai/' + cat_slug + '/' + art_slug + '/' + website_id + '-' + cat_id + '-' + art_id;
};
sv.url.build_category = function (cat_slug, website_id, cat_id) {
    return SITE_ROOT + 'chuyen-muc/' + cat_slug + '/' + website_id + '-' + cat_id;
};

sv.url.build_notification = function (cat_slug, art_slug, website_id, cat_id, art_id) {
    return SITE_ROOT + 'thong-bao/' + cat_slug + '/' + art_slug + '/' + website_id + '-' + cat_id + '-' + art_id;
};

sv.url.build_all_notification = function (cat_slug, website_id, cat_id) {
    return SITE_ROOT + 'danh-sach-thong-bao/' + cat_slug + '/' + website_id + '-' + cat_id;
};

sv.url.file = function (file_name) {
    return SITE_ROOT + 'upload' + file_name;
}
sv.url.upload_images = function (file_name) {
    return SITE_ROOT + 'public/images/' + file_name;
}
/*---------------------------------------------------------------------------------------*/
sv.data.getData = function (url, data, afuntion, async) {
    $.ajax({
        method: "POST",
        url: url,
        data: data,
        async: async,
        dataType: "json",
        success: function (response) {
            if (typeof afuntion == 'string')
            {
                window[afuntion](response);
            }
            else
            {
                (afuntion)(response);
            }

        }
    });
}
/**
 * lay du lieu tong hop theo thang
 * @param {type} month
 * @param {type} year
 * @param {type} afunction
 * @returns {undefined}
 */
sv.data.synthesis_month = function (member, month, year, afunction, async) {
    var data = {};
    if (month != '')
        data.month = month;
    if (year != '')
        data.year = year;
    if (member != '')
        data.member = member;

    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('synthesis_month'), data, afunction, async);
}

/**
 * tong hop tung don vi theo quy
 * @param {type} member
 * @param {type} quarter
 * @param {type} year
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.synthesis_quarter = function (member, quarter, year, afunction, async) {
    var data = {};
    if (quarter != '')
        data.quarter = quarter;
    if (year != '')
        data.year = year;
    if (member != '')
        data.member = member;

    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('synthesis_quarter'), data, afunction, async);
};

sv.data.synthesis_year = function (member, year, afunction, async) {
    var data = {};
    if (year != '')
        data.year = year;
    if (member != '')
        data.member = member;

    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('synthesis_year'), data, afunction, async);
};

/**
 * lay du lieu tong hop cua tinh theo thang
 * @param {type} month
 * @param {type} year
 * @param {type} afunction
 * @returns {undefined}
 */
sv.data.synthesis_month_province = function (member, month, year, afunction, async) {
    var data = {};
    if (month != '')
        data.month = month;
    if (year != '')
        data.year = year;
    if (member != '')
        data.member = member;
    
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('synthesis_month_province'), data, afunction, async);
}

sv.data.synthesis_year_province = function (year, afunction, async) {
    var data = {};
    if (year != '')
        data.year = year;
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('synthesis_year_province'), data, afunction, async);
}
/**
 * lay danh sach tin bai noi bat
 * @param {type} website_id
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.sticky = function (website_id, afunction, async) {
    var data = {website_id: website_id};
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_sticky'), data, afunction, async);
};

/**
 * chi tiet tin bai
 * @param {type} website_id
 * @param {type} cat_id
 * @param {type} art_id
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.article = function (website_id, cat_id, art_id, afunction, async) {
    var data = {
        website_id: website_id,
        category_id: cat_id,
        article_id: art_id
    };
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_article'), data, afunction, async);
};

/**
 * tin khac
 * @param {type} cat_id
 * @param {type} art_id
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.other_article = function (cat_id, art_id, afunction, async) {
    var data = {
        category_id: cat_id,
        article_id: art_id
    };
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_other_article'), data, afunction, async);
};

/**
 *
 * @param {type} record_code
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined} * @param {type} record_code
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined} lay thong tin ho so
 */
sv.data.record_info = function (developer_code, record_code, afunction, async) {
    var data = {record_code: record_code};
    if(developer_code != '')
        data.developer_code = developer_code;
    
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_record_info'), data, afunction, async);
};

/**
 * lay danh sach member
 */

sv.data.all_member = function (all_info, afunction, async) {
    var data = {};
    data.all_info = (typeof all_info == 'undefined' || all_info == '') ? '0' : '1';
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_all_member'), data, afunction, async);
};

sv.data.all_departments_member = function (all_info, afunction, async) {
    var data = {};
    data.all_info = (typeof all_info == 'undefined' || all_info == '') ? '0' : '1';
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_all_departments_member'), data, afunction, async);
};

/**
 * lay danh sach linh vuc
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.all_spec = function (afunction, async) {
    data = {};
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_all_spec'), data, afunction, async);
};

/**
 * lay danh sach tthc
 * @param {type} data
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.list_record_type = function (data, afunction, async) {
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_record_type_by_page'), data, afunction, async);
};
/**
 * chi tiet tthc
 * @param {type} record_type_code
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.record_type = function (record_type_id, afunction, async) {
    data = {record_type_id: record_type_id};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_record_type'), data, afunction, async);
};

sv.data.list_cb = function (filter, afunction, async) {
    data = filter;

    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_list_cb'), data, afunction, async);
};
/**
 * lay danh sach cau hoi cong dan
 * @param {type} data
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined} * @param {type} data
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined} 
 */
sv.data.all_cq = function (data, afunction, async) {
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_all_cq'), data, afunction, async);
};

sv.data.all_cb = function (data, afunction, async) {
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_all_cb'), data, afunction, async);
}


/**
 * 
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.all_year_has_data = function (afunction, async) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_all_year_has_data'), data, afunction, async);
};

/**
 * 
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.all_month_has_data = function (afunction, async) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_all_month_has_data'), data, afunction, async);
};


sv.data.do_insesrt_cq = function (data, afunction, async) {
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('do_insert_cq'), data, afunction, async);

};

sv.data.art_of_cat = function (page, website_id, cat_id, key_word, afunction, async) {
    var data = {website_id: website_id,
        category_id: cat_id,
        page: page,
        key_word: key_word};
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_art_of_cat_by_page'), data, afunction, async);
};


sv.data.cq_detail = function (cq_id, afunction, async) {
    data = {cq_id: cq_id};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_cq_detail'), data, afunction, async);
};

sv.data.synthesis_lookup = function (period, member, period_value, year, afunction, async) {
    if (typeof async == 'undefined')
        async = true;
    if (period == 'month')
        sv.data.synthesis_month(member, period_value, year, afunction, async);
    else if (period == 'quarter')
        sv.data.synthesis_quarter(member, period_value, year, afunction, async);
    else
        sv.data.synthesis_year(member, year, afunction, async);
}


sv.data.latest_record_has_result = function(afunction, async){
    var data = {};
    if(typeof async == 'undefined') async = true;
    
    sv.data.getData(sv.url.getService('get_latest_record_has_result'), data, afunction, async);
};

/**
 * Xem chi tiêt Văn bản
 * @param {int} docId Mã Văn bản
 * @param {type} afunction
 * @param {type} asnc
 * @returns {undefined}
 */
sv.data.getSingleDoc = function (docId, afunction, async)
{
    var data = {docId: docId};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getSingleDoc'), data, afunction, async);
}

sv.data.getAllDoc = function (afunction,async)
{
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getAllDoc'),data, afunction, async);
}

sv.data.LoadDocByPage = function (page, afunction, async)
{
    var data = {page: page};
    if (typeof async == 'undefined')
        async = true;
    
    sv.data.getData(sv.url.getService('getDocByPage'), data, afunction, async);
}

sv.data.getDocument = function (data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    
    sv.data.getData(sv.url.getService('getDocument'), data, afunction, async);
}
sv.data.LoadOrgan = function (afunction, async)
{
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getAllOrgan'), data, afunction, async);
}

sv.data.LoadStatistics = function (afunction, async)
{
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getAllStatistics'), data, afunction, async);
}

sv.data.loadDocumentByOrgan = function (organId, afunction, async)
{
    var data = {organId: organId};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('loadDocumentByOrgan'), data, afunction, async);
}

sv.data.loadDocumentBySta = function (staId, afunction, async)
{
    var data = {staId: staId};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('loadDocumentBySta'), data, afunction, async);
}

sv.data.searchDocument = function(data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('searchDocument'), data, afunction, async);
}

sv.data.notification_new = function(afunction,async)
{
    var data = {};
    if(typeof async == 'undefined') async = true;
    sv.data.getData(sv.url.getService('getAllNotificationNew'), data, afunction,async);
}


sv.data.getAllDanhGiaCanBo = function(data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getAllDanhGiaCanBo'), data, afunction, async);
}

sv.data.doDanhGiaCanBo = function(data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('doDanhGiaCanBo'), data, afunction, async);
}

sv.data.get_all_linh_vuc = function(data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_all_linh_vuc'), data, afunction, async);
}

sv.data.get_record_type_by_spec = function(data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_record_type_by_spec'), data, afunction, async);
}

sv.data.add_record = function(data,afunction,async)
{
    var data = data;
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('add_record'), data, afunction, async);
}

