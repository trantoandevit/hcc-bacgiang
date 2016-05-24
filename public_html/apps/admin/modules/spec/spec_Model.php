<?php

class spec_model extends Model
{

    public $db;

    function __construct()
    {
        parent::__construct();
    }

//    public function qry_all_spec()
//    {
//        return $this->db->GetAll('SELECT *
//                            FROM t_ps_spec                           
//                            ORDER BY C_CODE ASC');
//    }


    public function qry_single_spec($v_id_spec = 0)
    {
        $result = $this->db->GetRow("SELECT *
                                    FROM t_ps_spec
                                    WHERE PK_SPEC = ?
                                        ", array($v_id_spec));
        $member = $result['C_MEMBER_CODE'];
        $result['member_name'] = $this->db->GetOne("SELECT C_NAME
                                    FROM t_ps_member
                                    WHERE C_CODE = ?
                                        ", array($member));
        return $result;
    }

    public function qry_all_spec($arr_filter = array())
    {
        $v_keyword = isset($arr_filter['txt_Tukhoa']) ? trim(replace_bad_char($arr_filter['txt_Tukhoa'])) : "";
        $v_member_code = isset($arr_filter['sel_Coquan']) ? $arr_filter['sel_Coquan'] : "";
        $v_page = isset($arr_filter['txt_Pager']) ? $arr_filter['txt_Pager'] : 1;
        $show = isset($arr_filter['txt_Show']) ? $arr_filter['txt_Show'] : _CONST_DEFAULT_ROWS_PER_PAGE;
        $from = ( $v_page - 1 ) * $show;

        $condition = '';
        if ($v_keyword != '')
        {
            $condition .= " AND (C_CODE LIKE '%$v_keyword%' OR C_NAME LIKE '%$v_keyword%')";
        }
        if ($v_member_code != '')
        {
            $condition .= " AND C_MEMBER_CODE = $v_member_code";
        }
        $sql = "SELECT
                            sp.*,
                            mb.C_NAME AS C_NAME_MEMBER
                            FROM t_ps_spec sp
                            LEFT JOIN t_ps_member mb
                            ON sp.C_MEMBER_CODE = mb.C_CODE
                            WHERE 1=1 " . $condition . " LIMIT " . $from . "," . _CONST_DEFAULT_ROWS_PER_PAGE . "
            ";
        $result['DATA'] = $this->db->GetAll($sql);
        $sql = "SELECT
                        COUNT(*) FROM t_ps_spec
                        WHERE 1=1 " . $condition . "
                    ";
        $result['COUNT'] = $this->db->GetOne($sql);
        return $result;
    }

    public function qry_all_member()
    {
        return $this->db->GetAll("SELECT *
                                    FROM t_ps_member
                                    WHERE C_STATUS = 1
            ");
    }

    public function delete_spec()
    {
        $v_spec_list = get_post_var('hdn_item_id_list');
        $stmt = "Delete From t_ps_spec Where PK_SPEC IN ($v_spec_list)";
        $this->db->Execute($stmt);
        $this->exec_done($this->goback_url);
    }

    public function update_spec()
    {
        $this->db->debug = 10;
        $spec_id = get_post_var('hdn_item_id', '');
        $txt_name = get_post_var('txt_name', '');
        $txt_code = get_post_var('txt_code', '');
        $sel_member_code = get_post_var('sel_member_code', '');
        $developer_code = '';
        if ($sel_member_code == '-1')
        {
            $sel_member_code = _CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT;
        }
        if ($spec_id == "")
        {
            $sql = "INSERT INTO t_ps_spec
                (
                C_CODE,
                C_NAME,
                C_MEMBER_CODE,
                C_DEVELOPER_CODE
                )
                VALUES
                (
                ?,
                ?,
                ?,
                ?
                )";
            $this->db->Execute($sql, array($txt_code, $txt_name, $sel_member_code, $developer_code));
        }
        else
        {
            $sql = "UPDATE t_ps_spec
                SET
                C_CODE = ?,
                C_NAME = ?,
                C_MEMBER_CODE = ?
                WHERE
                PK_SPEC = ?
                ";
            $this->db->Execute($sql, array($txt_code, $txt_name, $sel_member_code, $spec_id));
        }
        $this->exec_done($this->goback_url, '');
    }

}
