<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class synchronize_Model extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * thuc hien insert du lieu tong hop
     * @param type $arr_data
     * @param type $history_date
     */
    public function do_insert_synthesis($arr_data, $history_date, $table_name){
        //xoa toan bo du lieu cung thang
        $sql = "DELETE FROM $table_name WHERE DATEDIFF(C_HISTORY_DATE,'$history_date') = 0";
        $this->db->Execute($sql);
        
        //insert du lieu
        $sql_base = "INSERT INTO $table_name
                                    (C_UNIT_CODE,
                                     C_CREATE_DATE,
                                     C_HISTORY_DATE,
                                     C_COUNT_KY_TRUOC,
                                     C_COUNT_TIEP_NHAN,
                                     C_COUNT_THU_LY_CHUA_DEN_HAN,
                                     C_COUNT_THU_LY_QUA_HAN,
                                     C_COUNT_TRA_SOM_HAN,
                                     C_COUNT_TRA_DUNG_HAN,
                                     C_COUNT_TRA_QUA_HAN,
                                     C_COUNT_BO_SUNG,
                                     C_COUNT_NVTC,
                                     C_COUNT_TU_CHOI,
                                     C_COUNT_CONG_DAN_RUT,
                                     C_COUNT_CHO_TRA_KY_TRUOC,
                                     C_COUNT_CHO_TRA_TRONG_KY,
                                     C_COUNT_THUE,
                                     FK_VILLAGE_ID,
                                     C_DEVELOPER_CODE)
                        VALUES ";
        
        foreach($arr_data as $developer_code => $arr_all_item)
        {
            $sql_values = '';
            $arr_param = array();
            
            foreach($arr_all_item as $unit_code => $arr_item)
            {
                $tiep_nhan_ky_truoc = $arr_item['tiep_nhan']['ky_truoc'];
                $tiep_nhan_trong_ky = $arr_item['tiep_nhan']['trong_ky'];
                
                $dang_giai_quyet_chua_den_han = $arr_item['dang_giai_quyet']['chua_den_han'];
                $dang_giai_quyet_qua_han      = $arr_item['dang_giai_quyet']['qua_han'];
                
                $da_giai_quyet_som_han  = $arr_item['da_giai_quyet']['som_han'];
                $da_giai_quyet_dung_han = $arr_item['da_giai_quyet']['dung_han'];
                $da_giai_quyet_qua_han  = $arr_item['da_giai_quyet']['qua_han'];
                
                $tam_dung_bo_sung_ho_so = $arr_item['tam_dung']['bo_sung_ho_so'];
                $tam_dung_nvtc          = $arr_item['tam_dung']['nghia_vu_tai_chinh'];
                
                $ho_so_huy_tu_choi      = $arr_item['ho_so_huy']['tu_choi'];
                $ho_so_huy_cong_dan_rut = $arr_item['ho_so_huy']['cong_dan_rut'];
                
                $cho_tra_ket_qua_trong_ky = $arr_item['cho_tra_ket_qua']['trong_ky'];
                $cho_tra_ket_qua_ky_truoc = $arr_item['cho_tra_ket_qua']['ky_truoc'];
                
                if($sql_values == '')
                {
                    $sql_values .= '(?,NOW(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                }
                else
                {
                    $sql_values .= ', (?,NOW(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                }
                
                array_push($arr_param, $unit_code,
                                        $history_date,$tiep_nhan_ky_truoc,
                                        $tiep_nhan_trong_ky, $dang_giai_quyet_chua_den_han,
                                        $dang_giai_quyet_qua_han, $da_giai_quyet_som_han,
                                        $da_giai_quyet_dung_han, $da_giai_quyet_qua_han,
                                        $tam_dung_bo_sung_ho_so, $tam_dung_nvtc,
                                        $ho_so_huy_tu_choi, $ho_so_huy_cong_dan_rut,
                                        $cho_tra_ket_qua_ky_truoc, $cho_tra_ket_qua_trong_ky,
                                        '0', '0', $developer_code
                        );
            }
            
            $this->db->Execute($sql_base . $sql_values,$arr_param);
        }
    }
    
    /**
     * update mebmer
     * @param type $arr_all_member
     * @param type $developer_code
     */
    public function do_update_member($arr_all_member,$developer_code){
        
        $cur_order = $this->db->getOne("SELECT COALESCE(MAX(C_ORDER), 0) AS C_CUR_ORDER FROM t_ps_member");
        $sql_base = "INSERT INTO t_ps_member(C_NAME, C_CODE, C_SCOPE, C_STATUS, C_ORDER,C_DEVELOPER)
                        VALUES ";
        $cur_order = (int) $cur_order;
        $sql_item = '';
        $arr_param  = array();
        foreach($arr_all_member as $items){
            $name  = isset($items['ten_don_vi'])?$items['ten_don_vi']:'';
            $code  = isset($items['ma_don_vi'])?$items['ma_don_vi']:'';
            $scope = isset($items['pham_vi_don_vi'])?$items['pham_vi_don_vi']:'';
            $url   = isset($items['url'])?$items['url']:'';
            
            //kiem tra ma member
            $check = $this->db->getOne("SELECT COUNT(*) FROM t_ps_member WHERE C_CODE = ? AND C_DEVELOPER = ?", array($code, $developer_code));
            if($check > 0)
            {
                $stmt = "UPDATE t_ps_member SET C_LOGIN_URL = ? WHERE C_CODE = ? AND C_DEVELOPER = ?";
                $this->db->Execute($stmt, array($url, $code, $developer_code));
                continue;
            }
            
            $cur_order = $cur_order + 1;
            if($sql_item == '')
            {
                $sql_item .= "(?,?,?,?,?,?)";
            }
            else
            {
                $sql_item .= ",(?,?,?,?,?,?)";
            }
            array_push($arr_param, $name, $code, $scope, '1', "$cur_order", $developer_code);

        }
        $this->db->execute($sql_base . $sql_item, $arr_param);
    }
    
    /**
     * thuc hien insert linh vuc
     * @param type $arr_data
     */
    public function do_insert_spec($arr_data)
    {
        //delete toan bo spec
        $this->db->Execute("DELETE FROM t_ps_spec");
        
        //insert
        $sql_base = "INSERT INTO t_ps_spec(C_CODE, C_NAME, C_DEVELOPER_CODE, C_MEMBER_CODE) VALUES ";
        $sql_values = '';
        $arr_param = array();
        foreach($arr_data as $developer_code => $arr_spec_all_member)
        {
            foreach($arr_spec_all_member as $member_code => $arr_all_spec)
            {
                foreach($arr_all_spec as $arr_spec)
                {
                    $spec_code = $arr_spec['ma_linh_vuc'];
                    $spec_name = $arr_spec['ten_linh_vuc'];
                    $sql_values .= ($sql_values == '')? '(?,?,?,?)': ',(?,?,?,?)';
                    array_push($arr_param, $spec_code, $spec_name, $developer_code, $member_code);
                }
                
            }
        }
        
        $this->db->Execute($sql_base . $sql_values, $arr_param);
    }
    
    /**
     * lay danh sach linh vuc theo developer_code
     * @param type $developer_code
     * @return type
     */
    public function qry_all_spec_by_developer_code($developer_code){
        $sql = "SELECT * FROM t_ps_spec WHERE C_DEVELOPER_CODE = ?";
        
        return $this->db->getAll($sql, array($developer_code));
        
    }
    
    /**
     * thuc hien insert tthc
     * @param type $arr_all_record_type
     * @param type $spec_code
     * @param type $developer_code
     * @param type $member_code
     */
    public function do_insert_record_type($arr_all_record_type,$spec_code, $developer_code, $member_code){
        $sql_base = 'INSERT INTO t_ps_record_type(C_CODE, C_NAME, C_CONTENT, C_ORDER, C_STATUS, C_SPEC_CODE, C_MEMBER_CODE, C_DEVELOPER_CODE, C_SCOPE, C_LEVEL, C_JSON_FILE_ATTACHMENT) VALUES ';
        $sql_values = ''; 
        $arr_params = array();
        $cur_order = (int) $this->db->getOne("SELECT COALESCE(MAX(C_ORDER),0) FROM t_ps_record_type");
        
        if($member_code == _CONST_DEFAULT_SPEC_LEVEL_OF_DISTRICT)
            $scope = '1';
        else
            $scope = $this->db->getOne("SELECT C_SCOPE FROM t_ps_member WHERE C_CODE = ?",array($member_code));
        
        foreach($arr_all_record_type as $arr_record_type)
        {
            $record_type_code = $arr_record_type['ma_tthc'];
            $record_type_name = $arr_record_type['ten_tthc'];
            $record_type_detail = $arr_record_type['chi_tiet_tthc'];
            $record_type_level = $arr_record_type['muc_do_dvc'];
            
            $arr_file_attach = isset($arr_record_type['file_dinh_kem'])? $arr_record_type['file_dinh_kem']: array();
            $arr_tmp = array();
            //reset index
            foreach($arr_file_attach as $item)
            {
                $arr_tmp[] = $item;
            }
            $json_file_attach = json_encode($arr_tmp);
            
            
            if(!$this->check_record_type($record_type_code, $spec_code, $developer_code, $member_code))
            {
                $cur_order = $cur_order + 1;
                $sql_values .= ($sql_values == '')?'(?,?,?,?,?,?,?,?,?,?,?)':',(?,?,?,?,?,?,?,?,?,?,?)';
                
                array_push($arr_params, $record_type_code, $record_type_name, $record_type_detail, $cur_order, '1', $spec_code, $member_code, $developer_code, $scope, $record_type_level, $json_file_attach);
            }
            else//update
            {
                $stmt = "UPDATE t_ps_record_type SET C_CONTENT = ? , 
                                                    C_JSON_FILE_ATTACHMENT = ? 
                                                    WHERE C_CODE = ?
                                                            AND C_SPEC_CODE = ?
                                                            AND C_MEMBER_CODE = ?
                                                            AND C_DEVELOPER_CODE = ?";
                $this->db->Execute($stmt, array($record_type_detail, $json_file_attach, $record_type_code, $spec_code, $member_code, $developer_code));
            }
        }
        
        if($sql_values != '')
        {
            $this->db->Execute($sql_base . $sql_values, $arr_params);
        }
    }
    
    /**
     * kiem tra tthc 
     * @param type $record_type_code
     * @param type $spec_code
     * @param type $developer_code
     * @param type $member_code
     * @return type
     */
    public function check_record_type($record_type_code, $spec_code, $developer_code, $member_code){
        $sql = "SELECT
                    COUNT(*)
                  FROM t_ps_record_type
                  WHERE C_CODE = ?
                      AND C_SPEC_CODE = ?
                      AND C_MEMBER_CODE = ?
                      AND C_DEVELOPER_CODE = ?";
        $check = $this->db->getOne($sql, array($record_type_code, $spec_code, $member_code, $developer_code));
        
        return ($check > 0)? true: false;
    }
    
    public function do_insert_latest_record_has_result($arr_data, $developer_code)
    {
        //insert du lieu
        $sql_base = "INSERT INTO t_ps_latest_record_has_result(C_RECORD_CODE, C_OWNER_NAME, C_DEVELOPER_CODE, C_RETURN_DATE) VALUES ";
        $sql_value = '';
        $arr_params = array();
        foreach($arr_data as $arr_item){
            $record_code = $arr_item['ma_ho_so'];
            $owner_name = $arr_item['ten_nguoi_dang_ky'];
            $return_date = DATE('Y-m-d H:i:s', strtotime($arr_item['thoi_gian_hoan_thanh']));;
            
            $sql_value .= ($sql_value == '')? '(?, ?, ?, ?)': ',(?, ?, ?, ?)';
            array_push($arr_params, $record_code, $owner_name, $developer_code, $return_date);
        }
        
        $this->db->Execute($sql_base . $sql_value, $arr_params);
        
        //chi du lai du lieu moi nhat
//        $list_record = $this->db->getOne('SELECT
//                                             GROUP_CONCAT(PK_RECORD)
//                                           FROM t_ps_latest_record_has_result
//                                           ORDER BY C_RETURN_DATE DESC
//                                           LIMIT '. _CONST_DEFAULT_ROWS_PER_PAGE .'');

        //xoa tat ca ho so khong phai thuoc ngay hien tai
        $sql = "DELETE
                    FROM t_ps_latest_record_has_result
                    WHERE DATEDIFF(C_RETURN_DATE, NOW()) <> 0";
        $this->db->Execute($sql);
        
    }
}