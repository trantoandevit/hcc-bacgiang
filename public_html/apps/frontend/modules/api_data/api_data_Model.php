<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class api_data_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * kiem tra du lieu
     * @param type $month
     * @return type
     */
    public function check_synthesis_month($month, $year)
    {
        $sql = "SELECT COUNT(*) FROM t_ps_record_history_stat WHERE MONTH(C_HISTORY_DATE) = ? AND YEAR(C_HISTORY_DATE)= ?";
        return $this->db->GetOne($sql, array($month, $year));
    }

    /**
     * kiem tra du lieu theo C_HISTORY_DATE
     * @param type $date
     * @param type $table_name
     * @return type
     */
    public function check_synthesis_by_date($date, $table_name)
    {
        $sql = "SELECT COUNT(*) FROM $table_name WHERE DATEDIFF(C_HISTORY_DATE, ?) = 0";
        return $this->db->GetOne($sql, array($date));
    }

    public function qry_default_website_id()
    {
        $sql = "Select PK_WEBSITE From t_ps_website Order By C_ORDER";
        return $this->db->GetOne($sql);
    }

    /**
     * lay du lieu tong hop theo thang
     * @param type $month
     * @param type $year
     * @return type
     */
    public function qry_synthesis_month($month, $year, $member)
    {
        $condition_hs = '';
        $condition_m = '';

        if ($member != '' && $member != '-1')
        {
            $condition_hs = " AND C_UNIT_CODE = '$member'";
            $condition_m = " AND C_CODE = '$member'";
        }
        $sql = "SELECT
                    M.C_CODE AS C_UNIT_CODE,
                    HS.C_SPEC_CODE,
                    HS.C_CREATE_DATE,
                    HS.C_HISTORY_DATE,
                    COALESCE(HS.C_COUNT_KY_TRUOC,0) as C_COUNT_KY_TRUOC,
                    COALESCE(HS.C_COUNT_TIEP_NHAN,0) AS C_COUNT_TIEP_NHAN,
                    COALESCE(HS.C_COUNT_THU_LY_CHUA_DEN_HAN,0) AS C_COUNT_THU_LY_CHUA_DEN_HAN,
                    COALESCE(HS.C_COUNT_THU_LY_QUA_HAN,0) AS C_COUNT_THU_LY_QUA_HAN,
                    COALESCE(HS.C_COUNT_TRA_SOM_HAN,0) AS C_COUNT_TRA_SOM_HAN,
                    COALESCE(HS.C_COUNT_TRA_DUNG_HAN,0) AS C_COUNT_TRA_DUNG_HAN,
                    COALESCE(HS.C_COUNT_TRA_QUA_HAN,0) AS C_COUNT_TRA_QUA_HAN,
                    COALESCE(HS.C_COUNT_BO_SUNG,0) AS C_COUNT_BO_SUNG,
                    COALESCE(HS.C_COUNT_NVTC,0) AS C_COUNT_NVTC,
                    COALESCE(HS.C_COUNT_TU_CHOI,0) AS C_COUNT_TU_CHOI,
                    COALESCE(HS.C_COUNT_CONG_DAN_RUT,0) AS C_COUNT_CONG_DAN_RUT,
                    COALESCE(HS.C_COUNT_CHO_TRA_KY_TRUOC,0) AS C_COUNT_CHO_TRA_KY_TRUOC,
                    COALESCE(HS.C_COUNT_CHO_TRA_TRONG_KY,0) AS C_COUNT_CHO_TRA_TRONG_KY,
                    COALESCE(HS.C_COUNT_THUE,0) AS C_COUNT_THUE,
                    HS.C_VILLAGE_NAME,
                    HS.FK_VILLAGE_ID,
                    HS.C_DEVELOPER_CODE,
                    M.C_NAME,
                    DATE_FORMAT(HS.C_CREATE_DATE, '%d-%m-%Y') AS C_CREATE_DATE_DMY
                  FROM (SELECT
                                C_NAME,
                                C_CODE,
                                C_STATUS,
                                C_ORDER
                              FROM t_ps_member
                              WHERE C_STATUS = 1 $condition_m) M
                          LEFT JOIN (SELECT *
                                     FROM t_ps_record_history_stat HS
                                     WHERE MONTH(C_HISTORY_DATE) = '$month'
                                         AND YEAR(C_HISTORY_DATE) = '$year' $condition_hs) HS
                            ON M.C_CODE = HS.C_UNIT_CODE
                        ORDER BY M.C_ORDER";
        return $this->db->getAll($sql);
    }

    /**
     * lay du lieu tong hop theo ngay cap nhat
     * @param type $date
     * @param type $member
     * @return type
     */
    public function qry_synthesis_by_date($date, $member, $table_name)
    {

        $condition_hs = '';
        $condition_m = '';

        if ($member != '' && $member != '-1')
        {
            $condition_hs = " AND C_UNIT_CODE = '$member'";
            $condition_m = " AND C_CODE = '$member'";
        }

        $sql = "SELECT
                    HS.C_UNIT_CODE,
                    HS.C_SPEC_CODE,
                    HS.C_CREATE_DATE,
                    HS.C_HISTORY_DATE,
                    COALESCE(HS.C_COUNT_KY_TRUOC,0) as C_COUNT_KY_TRUOC,
                    COALESCE(HS.C_COUNT_TIEP_NHAN,0) AS C_COUNT_TIEP_NHAN,
                    COALESCE(HS.C_COUNT_THU_LY_CHUA_DEN_HAN,0) AS C_COUNT_THU_LY_CHUA_DEN_HAN,
                    COALESCE(HS.C_COUNT_THU_LY_QUA_HAN,0) AS C_COUNT_THU_LY_QUA_HAN,
                    COALESCE(HS.C_COUNT_TRA_SOM_HAN,0) AS C_COUNT_TRA_SOM_HAN,
                    COALESCE(HS.C_COUNT_TRA_DUNG_HAN,0) AS C_COUNT_TRA_DUNG_HAN,
                    COALESCE(HS.C_COUNT_TRA_QUA_HAN,0) AS C_COUNT_TRA_QUA_HAN,
                    COALESCE(HS.C_COUNT_BO_SUNG,0) AS C_COUNT_BO_SUNG,
                    COALESCE(HS.C_COUNT_NVTC,0) AS C_COUNT_NVTC,
                    COALESCE(HS.C_COUNT_TU_CHOI,0) AS C_COUNT_TU_CHOI,
                    COALESCE(HS.C_COUNT_CONG_DAN_RUT,0) AS C_COUNT_CONG_DAN_RUT,
                    COALESCE(HS.C_COUNT_CHO_TRA_KY_TRUOC,0) AS C_COUNT_CHO_TRA_KY_TRUOC,
                    COALESCE(HS.C_COUNT_CHO_TRA_TRONG_KY,0) AS C_COUNT_CHO_TRA_TRONG_KY,
                    COALESCE(HS.C_COUNT_THUE,0) AS C_COUNT_THUE,
                    HS.C_VILLAGE_NAME,
                    HS.FK_VILLAGE_ID,
                    HS.C_DEVELOPER_CODE,
                    M.C_NAME,
                    DATE_FORMAT(HS.C_CREATE_DATE, '%d-%m-%Y') AS C_CREATE_DATE_DMY
                  FROM (SELECT
                                C_NAME,
                                C_CODE,
                                C_STATUS,
                                C_ORDER
                              FROM t_ps_member
                              WHERE C_STATUS = 1 $condition_m) M
                          LEFT JOIN (SELECT *
                                     FROM $table_name HS
                                     WHERE DATEDIFF(C_HISTORY_DATE, '$date') = 0 $condition_hs) HS
                            ON M.C_CODE = HS.C_UNIT_CODE
                        ORDER BY M.C_ORDER";
        return $this->db->getAll($sql);
    }

    public function qry_synthesis_month_province($month, $year, $member = '-1')
    {
        $condition = '';
        if($member != '-1')
            $condition .= " AND C_UNIT_CODE = '$member'";
        
        $sql = "SELECT
                    COALESCE(SUM(HS.C_COUNT_TRA_SOM_HAN), 0) as TRA_SOM_HAN,
                    COALESCE(SUM(HS.C_COUNT_TRA_DUNG_HAN), 0) as TRA_DUNG_HAN,
                    COALESCE(SUM(HS.C_COUNT_TRA_QUA_HAN), 0) as TRA_QUA_HAN,
                    COALESCE(SUM(HS.C_COUNT_KY_TRUOC), 0) as TIEP_NHAN_KY_TRUOC,
                    COALESCE(SUM(HS.C_COUNT_TIEP_NHAN), 0) as TIEP_NHAN_TRONG_KY
                  FROM t_ps_record_history_stat HS
                  WHERE MONTH(C_HISTORY_DATE) = '$month'
                      AND YEAR(C_HISTORY_DATE) = '$year' $condition";
        return $this->db->getRow($sql);
    }

    /**
     * lay danh sach tin bai noi bat
     * @param type $website_id
     * @return type
     */
    public function qry_sticky($website_id)
    {
        $sql = "SELECT 
                    S.FK_WEBSITE,
                    C.PK_CATEGORY,
                    C.C_SLUG  AS C_CAT_SLUG,
                    A.PK_ARTICLE,
                    A.C_SLUG AS C_ART_SLUG,
                    A.C_TITLE
                  FROM t_ps_sticky S
                    LEFT JOIN t_ps_category C
                  ON S.FK_CATEGORY = C.PK_CATEGORY
                  LEFT JOIN t_ps_article A
                  ON S.FK_ARTICLE = A.PK_ARTICLE
                  WHERE S.C_DEFAULT = 1
                      AND S.FK_WEBSITE = $website_id";
        return $this->db->getAll($sql);
    }

    /**
     * chi tiet tin bai
     * @param type $website_id
     * @param type $category_id
     * @param type $article_id
     * @return type
     */
    public function qry_single_article($website_id, $category_id, $article_id)
    {
        $website_id = replace_bad_char($website_id);
        $category_id = replace_bad_char($category_id);
        $article_id = replace_bad_char($article_id);
        $v_default = _CONST_DEFAULT_ROWS_OTHER_NEWS;


        $stmt = "SELECT
                        DATE_FORMAT(C_BEGIN_DATE,'%d-%m-%Y %H:%i:%s') AS C_BEGIN_DATE,
                        C_TITLE,
                        C_SLUG                AS C_SLUG_ARTICLE,
                        C_SUB_TITLE,
                        C_PEN_NAME,
                        C_KEYWORDS,
                        C_TAGS,
                        C_CACHED_RATING,
                        C_CACHED_RATING_COUNT,
                        C_SUMMARY,
                        C_TAGS,
                        C_FILE_NAME,
                        C_CONTENT,
                        (SELECT
                           C_SLUG
                         FROM t_ps_category
                         WHERE PK_CATEGORY = ?) AS C_SLUG_CAT,
                        (SELECT
                           C_NAME
                         FROM t_ps_category
                         WHERE PK_CATEGORY = ?) AS C_CATEGORY_NAME
                      FROM t_ps_article a
                        INNER JOIN t_ps_category_article ca
                          ON a.PK_ARTICLE = ca.FK_ARTICLE
                      WHERE PK_ARTICLE = ?
                          AND FK_CATEGORY = ?
                          AND FK_CATEGORY IN(SELECT
                                               PK_CATEGORY
                                             FROM t_ps_category
                                             WHERE FK_WEBSITE = ?)
                          AND C_STATUS = 3
                          AND (SELECT
                                 C_STATUS
                               FROM t_ps_category
                               WHERE PK_CATEGORY = ?) = 1
                          AND C_BEGIN_DATE <= NOW()
                          AND C_END_DATE >= NOW()";
        $article = $this->db->getRow($stmt, array($category_id, $category_id, $article_id, $category_id, $website_id, $category_id));
        return $article;
    }

    /**
     * Lay danh sach tin bai cu hon TIN BAI DANG XEM CHI TIET (Cac tin khac)
     * @param unknown $categoryid
     * @param unknown $articleid
     */
    public function qry_all_other_article($categoryid, $articleid)
    {
        $v_default = _CONST_DEFAULT_ROWS_OTHER_NEWS;
        $v_use_index = '';
        $v_count = $this->_count_article_by_category($categoryid);
        if ($v_count > _CONST_MIN_ROW_TO_MYSQL_USE_INDEX)
        {
            $v_use_index = ' Use Index (C_BEGIN_DATE) ';
        }

        $sql = "Select
                    A.PK_ARTICLE
                    , A.C_SLUG
                    , A.C_TITLE
                    , DATE_FORMAT(A.C_BEGIN_DATE,'%d-%m-%Y %H:%i:%s') AS C_BEGIN_DATE
                    , C.PK_CATEGORY
                    , C.C_SLUG      as C_CAT_SLUG
                    , A.C_FILE_NAME
                    , A.C_SUMMARY
                From t_ps_category_article CA
                    Left Join t_ps_article A $v_use_index
                    On CA.FK_ARTICLE = A.PK_ARTICLE      
                        Left Join t_ps_category C
                        On CA.FK_CATEGORY = C.PK_CATEGORY
                Where C.PK_CATEGORY = $categoryid
                    And A.C_BEGIN_DATE < (Select C_BEGIN_DATE From t_ps_article Where PK_ARTICLE=$articleid)
                    And A.C_STATUS = 3
                    And A.C_BEGIN_DATE < Now()
                    And A.C_END_DATE > Now()  
                    And C.C_STATUS=1   
                Order By A.C_BEGIN_DATE Desc
                Limit $v_default";
        return $this->db->getAll($sql);
    }

    /**
     * dem so tin bai thuoc chuyen muc
     * @param type $v_category_id
     * @return type
     */
    private function _count_article_by_category($v_category_id)
    {
        $stmt = 'Select Count(*) From t_ps_category_article CA Where FK_CATEGORY = ?';
        $params = array($v_category_id);

        return $this->db->getOne($stmt, $params);
    }

    /**
     * lay danh sach thanh vien
     * @return type
     */
    public function qry_assoc_member($scope = '')
    {
        $cond = '';
        if($scope != '')
            $cond .= " AND C_SCOPE = '$scope'";
        
        $sql = "SELECT C_CODE, C_NAME FROM t_ps_member WHERE (1>0) $cond ORDER BY C_ORDER";
        return $this->db->GetAssoc($sql);
    }

    public function qry_all_member($scope = '')
    {
        $cond = '';
        if($scope != '')
            $cond .= " AND C_SCOPE = '$scope'";
        
        $sql = "SELECT * FROM t_ps_member WHERE (1>0) $cond  ORDER BY C_ORDER";
        $arr_return = $this->db->getAll($sql);

        return $arr_return;
    }

    /**
     * lay danh sach linh vuc
     * @return type
     */
    public function qry_assoc_spec()
    {
        $arr_member = $this->db->GetAssoc("SELECT DISTINCT
                                                    C_MEMBER_CODE,
                                                    C_DEVELOPER_CODE
                                                  FROM t_ps_record_type");
        $arr_return = array();
        foreach ($arr_member as $member_code => $arr_info)
        {
            $sql = "SELECT C_CODE,C_NAME FROM t_ps_spec WHERE C_MEMBER_CODE = ?";
            $arr_return[$member_code] = $this->db->getAll($sql, array($member_code));
        }

        return $arr_return;
    }

    /**
     * lay danh sach tthc
     * @param type $page
     * @return type
     */
    public function qry_all_record_type($page, $key_word = '', $member = '-1', $spec = '-1', $level = '-1')
    {
        $arr_return = array();

        $offset = _CONST_DEFAULT_ROWS_PER_PAGE;
        $limit = ($page - 1) * _CONST_DEFAULT_ROWS_PER_PAGE;
        $condition = "";
        //loc theo tu khoa
        if (!empty($key_word))
        {
            $condition .= " AND C_NAME LIKE '%$key_word%'";
        }

        //loc theo don vi
        if ($member != '-1')
        {
            $condition .= " AND C_MEMBER_CODE = '$member'";
        }

        //loc theo linh vuc
        if ($spec != '-1')
        {
            $condition .= " AND C_SPEC_CODE = $spec";
        }

        //loc theo muc do dvc
        if ($level != '-1')
        {
            $condition .= " AND C_LEVEL = $level";
        }

        $stmt = "SELECT
                        RT.C_NAME AS C_RECORD_TYPE_NAME,
                        RT.PK_RECORD_TYPE AS C_RECORD_TYPE_ID,
                        RT.C_CODE AS C_RECORD_TYPE_CODE,
                        CASE WHEN RT.C_MEMBER_CODE = '". _CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT ."' THEN 'Cấp Quận/Huyện'
                            ELSE M.C_NAME  
                        END AS C_MEMBER_NAME,
                        S.C_NAME  AS C_SPEC_NAME,
                        RT.C_LEVEL AS C_LEVEL
                      FROM (SELECT
                              PK_RECORD_TYPE,
                              C_NAME,
                              C_SPEC_CODE,
                              C_CODE,
                              C_MEMBER_CODE,
                              C_LEVEL
                            FROM t_ps_record_type
                            WHERE C_STATUS = 1 $condition
                            ORDER BY C_ORDER
                            LIMIT $limit,$offset) RT
                        LEFT JOIN t_ps_spec S
                          ON RT.C_SPEC_CODE = S.C_CODE
                        LEFT JOIN t_ps_member M
                          ON RT.C_MEMBER_CODE = M.C_CODE";
        $arr_return['data'] = $this->db->getAll($stmt, array());

        //dem tong so ban ghi
        $stmt = "SELECT
                    COUNT(*)
                   FROM t_ps_record_type
                   WHERE C_STATUS = 1 $condition";
        $arr_return['count'] = $this->db->getOne($stmt, array());

        return $arr_return;
    }

    public function get_list_cb($id, $keyword,$page)
    {
//        $this->db->debug = 10;
        $condition = '';
        if ($keyword != '')
        {
            $condition .= " AND C_NAME LIKE '%" . $keyword . "%'";
        }
        if ($id != "")
        {
            $condition .= " AND FK_MEMBER = " . $id;
        }
        if( $page != "")
        {
            $from = ( $page - 1 ) * _CONST_DEFAULT_ROWS_PER_PAGE;
            $condition .= " LIMIT " . $from . "," . _CONST_DEFAULT_ROWS_PER_PAGE;
        }
        $sql = "SELECT a.PK_EMPLOYMENT,
                    a.FK_MEMBER,
                    a.C_NAME,
                    a.C_AVATAR_FILE_PATH,
                    b.C_NAME AS MEMBER_NAME
                    FROM ( SELECT * FROM t_ps_employment WHERE C_STATUS = 1 " . $condition . " ) a
                    LEFT JOIN t_ps_member b
                    ON a.FK_MEMBER = b.PK_MEMBER";
        $employment = $this->db->getAll($sql);
        foreach ($employment as $key => $value)
        {
            $id_employment = $value['PK_EMPLOYMENT'];
            $sql = "SELECT *,
                        COALESCE(EMPQ.C_COUNT_RATE,0) COUNT
                        FROM (SELECT PK_EVALUATION_QUESTION,C_QUESTION,C_CRITERIA
                        FROM t_ps_evaluation_question
                        ORDER BY C_ORDER) EQ
                        LEFT JOIN (SELECT FK_QUESTION,C_COUNT_RATE,C_POINT,C_RATE
                        FROM t_ps_employment_question
                        WHERE FK_EMPLOYMENT = " . $id_employment . " 
                        ORDER BY C_RATE ) EMPQ
                        ON EQ.PK_EVALUATION_QUESTION = EMPQ.FK_QUESTION";
            $question = $this->db->GetAll($sql);
            $employment[$key]['C_QUESTION'] = $question;
        }
        return $employment;
    }

    /**
     * lay thong tin chi tiet TTHC
     * @param type $record_type_code
     * @return type
     */
    public function qry_record_type($record_type_id)
    {
        $stmt = "SELECT C_CONTENT, C_JSON_FILE_ATTACHMENT FROM t_ps_record_type WHERE PK_RECORD_TYPE = ?";
        return $this->db->getRow($stmt, array($record_type_id));
    }

    public function qry_synthesis_year_province($year)
    {
        $arr_return = array();
        $stmt = "SELECT
                    SUM(C_COUNT_TIEP_NHAN) AS C_COUNT_TIEP_NHAN,
                    SUM(C_COUNT_TRA_SOM_HAN) AS C_COUNT_TRA_SOM_HAN,
                    SUM(C_COUNT_TRA_DUNG_HAN) AS C_COUNT_TRA_DUNG_HAN,
                    SUM(C_COUNT_TRA_QUA_HAN) AS C_COUNT_TRA_QUA_HAN
                  FROM t_ps_record_history_stat
                  WHERE YEAR(C_HISTORY_DATE) = ?";

        $arr_return = $this->db->getRow($stmt, array($year));

        //count ky truoc
        $stmt = "SELECT
                    SUM(C_COUNT_KY_TRUOC) AS C_COUNT_TIEP_NHAN_KY_TRUOC
                  FROM t_ps_record_history_stat
                  WHERE C_HISTORY_DATE = (SELECT
                                            MIN(C_HISTORY_DATE)
                                          FROM t_ps_record_history_stat
                                          WHERE YEAR(C_HISTORY_DATE) = ?)
                  GROUP BY C_HISTORY_DATE
                  ORDER BY C_HISTORY_DATE";
        $arr_return['C_COUNT_TIEP_NHAN_KY_TRUOC'] = $this->db->getOne($stmt, array($year));

        return $arr_return;
    }

    /**
     * thuc hien them moi cau hoi
     * @param type $website_id
     * @return string
     */
    public function do_insert_cq($name, $title, $phone, $email, $content)
    {
        $s_order = "SELECT MAX(C_ORDER) as C_ORDER FROM t_ps_cq";
        $order = $this->db->getOne($s_order);
        $order++;
        $date = date("Y-m-d h:i:s");
        $slug = auto_slug($title);
        $sql = "INSERT INTO t_ps_cq
            (C_NAME,
             C_ADDRESS,
             C_PHONE,
             C_EMAIL,
             C_TITLE,
             C_CONTENT,
             C_ANSWER,
             C_STATUS,
             C_ORDER,
             C_DATE,
             C_SLUG)
                VALUES ('$name',
                        '',
                        '$phone',
                        '$email',
                        '$title',
                        '$content',
                        '',
                        '0',
                        '$order',
                        '$date',
                        '$slug')";
        $query = $this->db->Execute($sql);
        $table_name = 't_ps_cq';
        $pk_field = 'PK_CQ';
        $order_field = 'C_ORDER';
        $pk_value = $this->db->Insert_ID();
        $assign_order = 1;
        $this->ReOrder($table_name, $pk_field, $order_field, $pk_value, $assign_order);
        $data = array();
        if ($query)
        {
            $data['stt'] = 'done';
            $data['msg_error'] = 'Câu hỏi của bạn đã gửi thành công và đang được kiểm duyệt, vui lòng quay lại sau!';
        }
        else
        {
            $data['stt'] = 'false';
            $data['msg_error'] = 'Xảy ra lỗi! Xin thử lại!';
        }

        return $data;
    }

    public function qry_all_cq($page, $key_word = '')
    {
        $arr_return = array();
        $limit = _CONST_DEFAULT_ROWS_PER_PAGE;
        $offset = ($page - 1) * _CONST_DEFAULT_ROWS_PER_PAGE;
        $condition = "";

        if (!empty($key_word))
        {
            $condition .= " AND C_TITLE LIKE '%$key_word%'";
        }

        $stmt = "SELECT
                    PK_CQ,
                    C_NAME,
                    C_TITLE,
                    C_CONTENT,
                    DATE_FORMAT(C_DATE, '%d-%m-%Y %H:%i:%s') AS C_DATE_DDMMYYY
                  FROM t_ps_cq
                  WHERE C_STATUS = 1 $condition
                  ORDER BY C_ORDER
                  LIMIT $offset, $limit";

        $arr_return['data'] = $this->db->getAll($stmt, array());

        //dem tong so ban ghi
        $stmt = "SELECT
                    COUNT(*)
                  FROM t_ps_cq
                  WHERE C_STATUS = 1 $condition";

        $arr_return['count'] = $this->db->getOne($stmt, array());

        return $arr_return;
    }

    public function qry_all_year_has_data()
    {
        return $this->db->getCol("SELECT DISTINCT
                                (YEAR(C_HISTORY_DATE)) AS C_YEAR
                              FROM t_ps_record_history_stat");
    }

    public function qry_all_month_has_data()
    {
        $arr_return = array();
        $arr_all_year = $this->qry_all_year_has_data();

        foreach ($arr_all_year as $year)
        {
            $arr_return[$year] = $this->db->getCol("SELECT DISTINCT
                                                            DATE_FORMAT(C_HISTORY_DATE, '%m') AS C_MONTH
                                                       FROM t_ps_record_history_stat
                                                       WHERE YEAR(C_HISTORY_DATE) = '$year'");
        }

        return $arr_return;
    }

    public function qry_art_of_cat_by_page($page, $website_id, $category_id, $key_word = '')
    {
        $limit = _CONST_DEFAULT_ROWS_PER_PAGE;
        $offset = ($page - 1) * _CONST_DEFAULT_ROWS_PER_PAGE;
        $condition - '';

        if ($key_word != '')
        {
            $condition = " AND A.C_SLUG like '%" . auto_slug($key_word) . "%'";
        }

        $arr_return = array();
        $sql = "SELECT
                        DATE_FORMAT(FA.C_BEGIN_DATE,'%d-%m-%Y %H:%i:%s') AS C_BEGIN_DATE,
                        FA.C_BEGIN_DATE AS C_BEGIN_DATE_YYYYMMDD,
                        FA.PK_ARTICLE AS PK_ARTICLE,
                        FA.C_TITLE AS C_TITLE,
                        FA.C_SUMMARY AS C_SUMMARY,
                        IF(FA.C_FILE_NAME IS NULL, '', FA.C_FILE_NAME) AS C_FILE_NAME,
                        IF(FA.C_SLUG IS NULL, '', FA.C_SLUG) AS C_SLUG
                    FROM t_ps_article FA
                      RIGHT JOIN (SELECT
                                    mrs.PK_ARTICLE
                                  FROM (SELECT
                                          A.PK_ARTICLE
                                        FROM t_ps_article A
                                          RIGHT JOIN (SELECT
                                                        MAX(CA.FK_CATEGORY) AS FK_CATEGORY,
                                                        CA.FK_ARTICLE
                                                      FROM t_ps_category_article AS CA
                                                        LEFT JOIN t_ps_category AS C
                                                          ON CA.FK_CATEGORY = C.PK_CATEGORY
                                                      WHERE C.FK_WEBSITE = $website_id
                                                          AND C.PK_CATEGORY = $category_id
                                                          AND C.C_STATUS = 1
                                                      GROUP BY FK_ARTICLE) fca
                                            ON A.PK_ARTICLE = fca.FK_ARTICLE
                                        WHERE A.C_STATUS = 3
                                            AND C_BEGIN_DATE <= NOW()
                                            AND C_END_DATE >= NOW()
                                            $condition
                                        ORDER BY C_BEGIN_DATE DESC
                                        LIMIT $offset,$limit) AS mrs) AS MA
                        ON FA.PK_ARTICLE = MA.PK_ARTICLE";
        $arr_return['data'] = $this->db->getAll($sql, array());

        $cat_info = $this->db->getRow("SELECT
                                            PK_CATEGORY,
                                            C_SLUG,
                                            C_NAME
                                          FROM t_ps_category
                                          WHERE PK_CATEGORY = $category_id");

        $total_record = $this->db->getOne("SELECT
                                                COUNT(*)
                                              FROM (SELECT
                                                      A.PK_ARTICLE
                                                    FROM t_ps_article A
                                                      RIGHT JOIN (SELECT
                                                                    MAX(CA.FK_CATEGORY) AS FK_CATEGORY,
                                                                    CA.FK_ARTICLE
                                                                  FROM t_ps_category_article AS CA
                                                                    LEFT JOIN t_ps_category AS C
                                                                      ON CA.FK_CATEGORY = C.PK_CATEGORY
                                                                  WHERE C.FK_WEBSITE = $website_id
                                                                      AND C.PK_CATEGORY = $category_id
                                                                      AND C.C_STATUS = 1
                                                                  GROUP BY FK_ARTICLE) fca
                                                        ON A.PK_ARTICLE = fca.FK_ARTICLE
                                                    WHERE A.C_STATUS = 3
                                                        AND C_BEGIN_DATE <= NOW()
                                                        AND C_END_DATE >= NOW()
                                                        $condition
                                                    ) AS mrs
                                                            ");

        $arr_return['CAT_ID'] = $cat_info['PK_CATEGORY'];
        $arr_return['CAT_SLUG'] = $cat_info['C_SLUG'];
        $arr_return['CAT_NAME'] = $cat_info['C_NAME'];
        $arr_return['TOTAL_RECORD'] = $total_record;

        return $arr_return;
    }

    public function qry_cq_detail($cq_id)
    {
        $sql = "SELECT * FROM t_ps_cq WHERE PK_CQ = ? and C_STATUS = ?";
        $result = $this->db->getRow($sql, array($cq_id, "1"));
        return $result;
    }

    public function qry_latest_record_has_result()
    {
        $sql = "SELECT *
                    FROM t_ps_latest_record_has_result
                    ORDER BY C_RETURN_DATE desc";
        return $this->db->getAll($sql, array());
    }

    public function qry_all_document($condition)
    {
        return $this->db->GetAll("SELECT
                                    (select count(PK_VAN_BAN) from t_ps_van_ban  ORDER BY C_NGAY_BAN_HANH DESC) as TOTAL_RECORD,
                                    vb.*,
                                    bh.C_NAME AS C_NAME_CO_QUAN_BAN_HANH,
                                    tk.C_NAME AS C_NAME_LINH_VUC_BAN_HANH
                                  FROM t_ps_van_ban vb
                                    LEFT JOIN t_ps_co_quan_ban_hanh bh
                                      ON PK_CO_QUAN_BAN_HANH = FK_CO_QUAN_BAN_HANH
                                    LEFT JOIN t_ps_linh_vuc_thong_ke tk
                                      ON PK_LINH_VUC_VAN_BAN = FK_LINH_VUC_VAN_BAN
                                      where (1=1) $condition");
    }

    public function search_document($condition)
    {
        return $this->db->getAll("SELECT * from t_ps_van_ban WHERE C_STATUS=1 $condition");
    }

    public function quy_single_document($v_id_van_ban)
    {
        return $this->db->GetRow("SELECT *
                                    FROM t_ps_van_ban
                                    WHERE PK_VAN_BAN = ?
                                        ", array($v_id_van_ban));
    }

    public function qry_all_document_by_organ($v_id_co_quan)
    {
        return $this->db->GetAll("SELECT * from t_ps_van_ban WHERE FK_CO_QUAN_BAN_HANH = ?", array($v_id_co_quan));
    }

    public function qry_all_document_by_sta($v_id_linh_vuc)
    {
        return $this->db->GetAll("SELECT * from t_ps_van_ban WHERE FK_LINH_VUC_VAN_BAN = ?", array($v_id_linh_vuc));
    }

    public function qry_single_co_quan_ban_hanh($v_id_co_quan)
    {
        return $this->db->GetRow("select C_NAME from t_ps_co_quan_ban_hanh where PK_CO_QUAN_BAN_HANH  = ?", array($v_id_co_quan));
    }

    public function qry_single_linh_vuc_thong_ke($v_id_linh_vuc)
    {
        return $this->db->GetRow("select C_NAME from t_ps_linh_vuc_thong_ke where PK_LINH_VUC_VAN_BAN  = ?  ", array($v_id_linh_vuc));
    }

    public function qry_all_co_quan_ban_hanh()
    {
        return $this->db->getAll("SELECT *,
                                (SELECT COUNT(*) FROM t_ps_van_ban WHERE t_ps_van_ban.FK_CO_QUAN_BAN_HANH = PK_CO_QUAN_BAN_HANH AND VB.C_STATUS=1) AS C_TOTAL
                                FROM t_ps_co_quan_ban_hanh cqbh
                                  LEFT JOIN t_ps_van_ban vb
                                    ON cqbh.PK_CO_QUAN_BAN_HANH = vb.FK_CO_QUAN_BAN_HANH
                                    WHERE vb.C_STATUS=1
                                GROUP BY cqbh.PK_CO_QUAN_BAN_HANH");
    }

    public function qry_all_linh_vuc_thong_ke()
    {
        return $this->db->getAll("SELECT *,
                                (SELECT COUNT(*) FROM t_ps_van_ban WHERE t_ps_van_ban.FK_LINH_VUC_VAN_BAN = PK_LINH_VUC_VAN_BAN AND VB.C_STATUS=1) AS C_TOTAL
                                FROM t_ps_linh_vuc_thong_ke tk
                                  LEFT JOIN t_ps_van_ban vb
                                    ON tk.PK_LINH_VUC_VAN_BAN = vb.FK_LINH_VUC_VAN_BAN
                                    WHERE vb.C_STATUS=1
                                GROUP BY tk.PK_LINH_VUC_VAN_BAN");
    }

    public function qry_all_attachment($id)
    {
        $id = intval($id);
        $sql = 'Select C_FILE_NAME
                From t_ps_van_ban_dinh_kem
                Where FK_VAN_BAN =' . $id;
        return $this->db->getAll($sql);
    }

    /**
     * Lấy danh sách thông thông báo mới nhất
     * @return type
     */
    function qry_all_nitification_new()
    {
        //Lấy danh sách chuyên mục thông báo
        $v_list_cat_notifi = $this->db->GetOne("SELECT 
                                GROUP_CONCAT(`PK_CATEGORY`) 
                              FROM
                                `t_ps_category` 
                              WHERE c_type = 'notification' ");

        if ($this->db->ErrorNo() != 0)
        {
            return false;
        }

        //total record
        $sql = "select count(pk_article)
                        FROM
                        t_ps_article A 
                        LEFT JOIN `t_ps_category` c 
                          ON A.`C_DEFAULT_CATEGORY` = `PK_CATEGORY` 
                      WHERE A.C_STATUS = 3 
                        AND C_BEGIN_DATE <= NOW() 
                        AND C_END_DATE >= NOW() 
                        and c.C_STATUS = 1
                        and c.PK_CATEGORY in ($v_list_cat_notifi)
                      ORDER BY C_BEGIN_DATE DESC ";
        $v_total_record = $this->db->getOne($sql);

        //set group concat max len (phong truong hop server set default thap)
        $sql = "SET SESSION group_concat_max_len = 1000000";
        $this->db->Execute($sql);

        //lay du lieu category article
        $sql = "SELECT 
                        A.*,
                        c.C_SLUG AS C_CAT_SLUG,
                        c.C_NAME AS C_CAT_NAME 
                        ,$v_total_record as TOTAL_RECORD
                      FROM
                        t_ps_article A 
                        LEFT JOIN `t_ps_category` c 
                          ON A.`C_DEFAULT_CATEGORY` = `PK_CATEGORY` 
                      WHERE A.C_STATUS = 3 
                        AND C_BEGIN_DATE <= NOW() 
                        AND C_END_DATE >= NOW() 
                        and c.C_STATUS = 1
                        and c.PK_CATEGORY in ($v_list_cat_notifi)
                      ORDER BY C_BEGIN_DATE DESC 
                      LIMIT 10 ";
        $arr_all_notifi = $this->db->GetAll($sql);
        //Lay danh sach thông báo mới nhất
        return ($this->db->ErrorNo() == 0) ? $arr_all_notifi : false;
    }

    function getAllDanhGiaCanBo($condition)
    {
        $sql = "SELECT 
                    a.PK_EMPLOYMENT AS  EMPLOYMENT_ID,
                    a.PK_EMPLOYMENT,
                    a.C_JOB_TITLE,
                    a.C_EMAIL,
                    a.C_PHONE,
                    a.FK_MEMBER,
                    a.C_NAME,
                    a.C_AVATAR_FILE_PATH,
                    b.C_NAME AS MEMBER_NAME,
                    b.C_DEVELOPER
                    FROM ( SELECT * FROM t_ps_employment WHERE C_STATUS = 1 ) a
                    LEFT JOIN t_ps_member b
                    ON a.FK_MEMBER = b.PK_MEMBER";
        $employment = $this->db->getAssoc($sql);
        foreach ($employment as $key => $value)
        {
            $id_employment = $value['PK_EMPLOYMENT'];
            $sql = "SELECT *,
                        COALESCE(EMPQ.C_COUNT_RATE,0) COUNT
                        FROM (SELECT PK_EVALUATION_QUESTION,C_QUESTION,C_CRITERIA
                        FROM t_ps_evaluation_question
                        ORDER BY C_ORDER) EQ
                        LEFT JOIN (SELECT FK_QUESTION,C_COUNT_RATE,C_POINT,C_RATE
                        FROM t_ps_employment_question
                        WHERE FK_EMPLOYMENT = " . $id_employment . " 
                        ORDER BY C_RATE ) EMPQ
                        ON EQ.PK_EVALUATION_QUESTION = EMPQ.FK_QUESTION";
            $question = $this->db->GetAll($sql);
            $employment[$key]['C_QUESTION'] = $question;
        }
        return $employment;
    }

    function doDanhGiaCanBo($id_employment, $arr_question,$id_member)
    {
        $sql = "SELECT COUNT(PK_EMP_QUESTION) FROM t_ps_employment_question WHERE FK_EMPLOYMENT = " . $id_employment;
        $count = (int)($this->db->GetOne($sql));
        if ($count == 0)
        {
            foreach ($arr_question as $item)
            {
                $id_question = $item['PK_EVALUATION_QUESTION'];
                $point = $item['C_POINT'];
                $rate = ($item['C_POINT'] / 5) * 100;
                $sql = "INSERT t_ps_employment_question 
                            (PK_EMP_QUESTION, 
                            FK_EMPLOYMENT, 
                            FK_QUESTION, 
                            FK_MEMBER, 
                            C_COUNT_RATE, 
                            C_POINT, 
                            C_RATE
                            )
                            VALUES
                            (NULL, 
                            '$id_employment', 
                            '$id_question', 
                            '$id_member', 
                            '1', 
                            '$point', 
                            '$rate'
                            );";
                $query = $this->db->Execute($sql);
                if($this->db->ErrorNo() != 0)
                {
                    return false;
                }
            }
        }
        else
        {
            foreach ($arr_question as $item)
            {
                $id_question = $item['PK_EVALUATION_QUESTION'];
                $sql = "SELECT * FROM t_ps_employment_question WHERE FK_EMPLOYMENT = " . $id_employment . " AND FK_QUESTION = " . $id_question;
                $result = $this->db->GetRow($sql);               
                $count_rate = (int)($result['C_COUNT_RATE']) + 1;
                $point = (int)($result['C_POINT']) + (int)$item['C_POINT'];
                $rate = round( ( $point / ($count_rate * 5) ) * 100 );
                $sql = "UPDATE t_ps_employment_question 
                            SET
                            C_COUNT_RATE = '$count_rate' , 
                            C_POINT = '$point' , 
                            C_RATE = '$rate'
	
                            WHERE
                            FK_EMPLOYMENT = " . $id_employment . " AND FK_QUESTION = " . $id_question;
                $query = $this->db->Execute($sql);
                if($this->db->ErrorNo() != 0)
                {
                    return false;
                }
            }
        }
        return true;
    }

    function get_all_linh_vuc($member_code)
    {
        $sql = "SELECT * FROM t_ps_spec WHERE C_MEMBER_CODE = " . $member_code;
        return $this->db->GetAll($sql);
    }
    
    function get_record_type_by_spec($member_code,$spec_code)
    {
        $sql = "SELECT * FROM t_ps_record_type WHERE C_STATUS = 1 AND C_MEMBER_CODE = " . $member_code . " AND C_SPEC_CODE = " .$spec_code ;
        return $this->db->GetAll($sql);
    }
}
