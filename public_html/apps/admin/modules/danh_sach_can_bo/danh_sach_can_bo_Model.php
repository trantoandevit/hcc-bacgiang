<?php

class danh_sach_can_bo_Model extends Model {

    public $db;

    function __construct() {
        parent::__construct();
    }

    public function qry_all_can_bo($condition) {
        return $this->db->GetAll('SELECT
                                    a.*,
                                    b.C_NAME AS DON_VI,
                                    b.PK_MEMBER AS PK_DON_VI
                                    FROM t_ps_employment a
                                    LEFT JOIN t_ps_member b
                                    ON a.FK_MEMBER = b.PK_MEMBER' . $condition);
    }
    
    public function qry_count_can_bo($condition = '') {
        $query = $this->db->GetAll('SELECT
                                    a.*,
                                    b.C_NAME AS DON_VI
                                    FROM t_ps_employment a
                                    LEFT JOIN t_ps_member b
                                    ON a.FK_MEMBER = b.PK_MEMBER' . $condition);
        return count($query);
    }
    
    public function qry_all_co_quan() {
        return $this->db->GetAll("SELECT * FROM t_ps_member");
    }
    public function delete_can_bo()
    {
        $v_can_bo_list = get_post_var('hdn_item_id_list');
        $stmt = "Delete From t_ps_employment Where PK_EMPLOYMENT IN ($v_can_bo_list)";
        $this->db->Execute($stmt);
        $stmt = "DELETE FROM t_ps_employment_question WHERE FK_EMPLOYMENT IN ($v_can_bo_list)";
        $this->db->Execute($stmt);
        $this->exec_done($this->goback_url);
    }

    public function qry_single_can_bo($v_id_can_bo = 0)
    {
        return $this->db->GetRow("SELECT
                                    a.*,
                                    b.C_NAME AS DON_VI,
                                    b.PK_MEMBER AS PK_DON_VI
                                    FROM t_ps_employment a
                                    LEFT JOIN t_ps_member b
                                    ON a.FK_MEMBER = b.PK_MEMBER
                                    WHERE PK_EMPLOYMENT = ?
                                        ", array($v_id_can_bo));
    }
    function update_can_bo($v_id = 0) {
        $this->db->debug = 10;
        $txt_name = get_post_var('txt_name', '');
        $txt_address = get_post_var('txt_address', '');
        $txt_login_name = get_post_var('txt_login_name', '');
        $txt_password = get_post_var('txt_password', '');
        $txt_phone = get_post_var('txt_phone', '');
        $txt_order = get_post_var('txt_order', '');
        $txt_email = get_post_var('txt_email', '');
        $txt_job_title = get_post_var('txt_job_title', '');
        $sel_member = get_post_var('sel_member', 1);
        $txt_gender = get_post_var('rd_gender', 1);
        $chk_status = isset($_POST['chk_status']) ? 1 : 0;
        $id_can_bo = get_post_var('hdn_item_id', $v_id);
        $txt_birth_day = get_post_var('txt_birthday', '');
//        $date = "";
//        if ($txt_birth_day != "")
//        {
//            $date = DateTime::createFromFormat('d-m-Y',$txt_birth_day);
//            $date->format('Y-m-d');
//        }
        $txt_avatar = get_post_var('txt_avatar','');
        if ($id_can_bo == 0)
        {
            $sql = "INSERT INTO t_ps_employment 
                                (
                                FK_MEMBER, 
                                C_NAME,
                                C_LOGIN_NAME,
                                C_PASSWORD,
                                C_BIRTHDAY,
                                C_GENDER,
                                C_ADDRESS,
                                C_PHONE,
                                C_ORDER,
                                C_EMAIL,
                                C_JOB_TITLE,
                                C_STATUS,
                                C_AVATAR_FILE_PATH
                                )
                                VALUES
                                (
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?,
                                ?
                                )";
            $this->db->Execute($sql, array($sel_member, $txt_name, $txt_login_name, $txt_password, (!empty($txt_birth_day)) ? $txt_birth_day : NULL, $txt_gender , $txt_address, $txt_phone, $txt_order, $txt_email, $txt_job_title, $chk_status, $txt_avatar));
        } else {
            $sql = "UPDATE t_ps_employment 
                            SET
                            FK_MEMBER = ?, 
                                C_NAME = ?, 
                                C_BIRTHDAY = ?,
                                C_LOGIN_NAME = ?,
                                C_PASSWORD = ?,
                                C_ORDER = ?,
                                C_PHONE = ?,
                                C_GENDER = ?,
                                C_ADDRESS = ?,
                                C_EMAIL = ?,
                                C_JOB_TITLE = ?,
                                C_STATUS = ?,
                                C_AVATAR_FILE_PATH = ?
                            WHERE
                            PK_EMPLOYMENT = ? ;
                    ";
            $this->db->Execute($sql, array($sel_member, $txt_name, (!empty($txt_birth_day))?$txt_birth_day: NULL, $txt_login_name, $txt_password, $txt_order, $txt_phone,$txt_gender,  $txt_address, $txt_email, $txt_job_title, $chk_status, $txt_avatar, $id_can_bo));
        }
        $this->exec_done($this->goback_url, '');
        
    }

}
