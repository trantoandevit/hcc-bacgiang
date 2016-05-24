<?php ?>
<?php
if (!defined('SERVER_ROOT'))
{
    exit('No direct script access allowed');
}
//header
$this->template->title = 'Chi tiết cán bộ';
$this->template->display('dsp_header.php');
$v_name = isset($dsp_single_all_can_bo['C_NAME']) ? $dsp_single_all_can_bo['C_NAME'] : '';
$v_member = isset($dsp_single_all_can_bo['PK_DON_VI']) ? $dsp_single_all_can_bo['PK_DON_VI'] : 0;
$v_gender = isset($dsp_single_all_can_bo['C_GENDER']) ? $dsp_single_all_can_bo['C_GENDER'] : 1;
$v_login_name = $dsp_single_all_can_bo['C_LOGIN_NAME'];
$v_password = $dsp_single_all_can_bo['C_PASSWORD'];
$v_birthday = isset($dsp_single_all_can_bo['C_BIRTHDAY']) ? $dsp_single_all_can_bo['C_BIRTHDAY'] : '';
if ($v_birthday != "")
{
    $date = Date('Y-m-d',  strtotime($v_birthday));
}

$v_address = isset($dsp_single_all_can_bo['C_ADDRESS']) ? $dsp_single_all_can_bo['C_ADDRESS'] : '';
$v_phone = isset($dsp_single_all_can_bo['C_PHONE']) ? $dsp_single_all_can_bo['C_PHONE'] : '';
$v_email = isset($dsp_single_all_can_bo['C_EMAIL']) ? $dsp_single_all_can_bo['C_EMAIL'] : '';
$v_job_title = isset($dsp_single_all_can_bo['C_JOB_TITLE']) ? $dsp_single_all_can_bo['C_JOB_TITLE'] : '';
$v_status = isset($dsp_single_all_can_bo['C_STATUS']) ? $dsp_single_all_can_bo['C_STATUS'] : 1;
$v_order = isset($dsp_single_all_can_bo['C_ORDER']) ? $dsp_single_all_can_bo['C_ORDER'] : '';
$v_avatar = isset($dsp_single_all_can_bo['C_AVATAR_FILE_PATH']) ? $dsp_single_all_can_bo['C_AVATAR_FILE_PATH'] : '';
$v_id_can_bo = isset($dsp_single_all_can_bo['PK_EMPLOYMENT']) ? $dsp_single_all_can_bo['PK_EMPLOYMENT'] : 0;
?>
<form class="form-horizontal" name="frmMain" id="frmMain" method="post" action="<?php echo $this->get_controller_url() . 'update_co_quan_ban_hanh'; ?>">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_can_bo');
    echo $this->hidden('hdn_dsp_all_method', 'dsp_all_can_bo');
    echo $this->hidden('hdn_update_method', 'update_can_bo');
    echo $this->hidden('hdn_delete_method', 'delete_can_bo');
    echo $this->hidden('hdn_item_id_list', '');
    echo $this->hidden('hdn_item_id', $v_id_can_bo);
    echo $this->hidden('XmlData', '');
//Luu dieu kien loc
    ?>
    <h1 class="page-header"><?php echo __('Thông tin cán bộ'); ?></h1>
    <div>
        <div class=" panel-default">

            <div class="Row">
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_name" class="col-sm-3 control-label"><?php echo __('Họ và tên cán bộ'); ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_name" id="txt_name" value="<?php echo $v_name; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text" data-name="<?php echo __('họ và tên cán bộ'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Đơn vị') ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
<!--                        <input type="text" name="sel_member" id="sel_member" value="<?php echo $v_member; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text"  data-name="<?php echo __('Đơn vị'); ?>" 
                               data-xml="no" data-doc="no" 
                               />-->
                        <select type="text" name="sel_member" id="sel_member"
                                class="form-control" maxlength="255"
                                data-allownull="no" data-validate="text"  data-name="<?php echo __('Đơn vị'); ?>" 
                                data-xml="no" data-doc="no" >
                            <option value=""> -- Chọn đơn vị -- </option>
                            <?php foreach ($arr_all_co_quan as $item): ?>
                            <?php $selected = ($v_member == $item['PK_MEMBER']) ? 'selected' : ''; ?>
                            <option value="<?php echo $item['PK_MEMBER']?>" <?php echo $selected ?> ><?php echo $item['C_NAME'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> 
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Giới tính') ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
<!--                        <input type="text" name="txt_gender" id="txt_gender" value="<?php echo $v_gender; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text"  data-name="<?php echo __('Giới tính'); ?>" 
                               data-xml="no" data-doc="no" 
                               />-->
                        <label><input type="radio" name="rd_gender" value="1" <?php if (isset($v_gender) && $v_gender == 1) { echo "checked" ;} ?> > Nam </label><br>
                        <label><input type="radio" name="rd_gender" value="0" <?php if (isset($v_gender) && $v_gender == 0) { echo "checked" ;} ?> > Nữ </label><br>
                    </div>
                </div> 
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_login_name" class="col-sm-3 control-label"><?php echo __('Tài khoản đăng nhập') ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_login_name" id="txt_login_name" value="<?php echo $v_login_name; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text"  data-name="<?php echo __('Tài khoản đăng nhập'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_password" class="col-sm-3 control-label"><?php echo __('Mật khẩu') ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <input type="password" name="txt_password" id="txt_password" value="<?php echo $v_password; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text"  data-name="<?php echo __('Mật khẩu'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Ngày sinh') ?> </label>
                    </div>
                    <div class="right-Col">
                        <input type="date" name="txt_birthday" id="txt_birthday" value="<?php echo $date; ?>" 
                               class="form-control" maxlength="255"
                               data-name="<?php echo __('Ngày sinh'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_address" class="col-sm-3 control-label"><?php echo __('Địa chỉ') ?></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_address" id="txt_address" value="<?php echo $v_address; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="yes" data-name="<?php echo __('Địa chỉ'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>              
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_phone" class="col-sm-3 control-label"><?php echo __('Số điện thoại') ?></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_phone" id="txt_phone" value="<?php echo $v_phone; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="yes" data-name="<?php echo __('Số điện thoại'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_email" class="col-sm-3 control-label"><?php echo __('Email') ?></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_email" id="txt_email" value="<?php echo $v_email; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="yes" data-validate="unsignNumber"  data-name="<?php echo __('Email'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_job_title" class="col-sm-3 control-label"><?php echo __('Chức vụ') ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_job_title" id="txt_job_title" value="<?php echo $v_job_title; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text"  data-name="<?php echo __('Chức vụ'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label for="txt_order" class="col-sm-3 control-label"><?php echo __('Sắp xếp') ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_order" id="txt_order" value="<?php echo $v_order; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="unsignNumber"  data-name="<?php echo __('Sắp xếp'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                    </div>
                    <div class="right-Col">

                        <label><input type="checkbox" name="chk_status" id="chk_status" <?php echo ($v_status == 1) ? 'checked' : ''; ?> /> <?php echo __('active status') ?></label>
                    </div>
                </div>
                <div class="ui-widget">
                    <div class="ui-widget-header ui-state-default ui-corner-top">
                        <h4>
                            <a 
                                href="javascript:;" style="float:right;text-decoration: underline;"
                                onClick="delete_thumbnail_onclick();"
                                >
                                    <?php echo __('delete') ?>
                            </a>
                            <font><?php echo __('thumbnail') ?></font>
                        </h4>

                    </div>
                    <div class="ui-widget-content Center" id="thumbnail_container" 
                         style="padding-bottom:5px;" onClick="thumbnail_onclick();">
                        <div style="width:250px;height: 150px;border:dashed #C0C0C0;margin: 0 auto;">
                            <?php if ($v_avatar == ""): ?>
                                <br>
                                <a href="javascript:;">
                                    <h4 class="Center">
                                        <?php echo __('choose image') ?>
                                    </h4>
                                </a>
                            <?php else: ?>
                                <img width="250" onclick="thumbnail_onclick();" src="<?php echo $v_avatar ?>"
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!--widget thumbnail-->
            </div>

        </div>

        <label class="required" id="message_err"></label>

        <div class="button-area">
            <button type="button" class="ButtonEdit" name="btn_update" id="btn_update" onclick="btn_update_onclick()"> 
                <i class="fa fa-check fa-fw"></i> <?php echo __('update'); ?>
            </button>
            <button type="button" class="ButtonBack" name="btn_back" id="btn_cancel" onclick="btn_back_onclick()">
                <i class="fa fa-reply fa-fw"></i> <?php echo __('go back'); ?>
            </button>
        </div>
    </div>
</form>
<script>
    function thumbnail_onclick()
    {
        var $url = "<?php echo $this->get_controller_url('advmedia', 'admin') . 'dsp_service/image'; ?>";
        showPopWin($url, 800, 600, function (json_obj) {
            if (json_obj[0])
            {
                $file = json_obj[0]['path'];
                var $html = '</br><img width="250"';
                $html += 'onClick="thumbnail_onclick();"';
                $html += ' src="<?php echo SITE_ROOT . 'upload' . '/' ?>' + $file + '"/>';
                $html += '<input hidden type="text" name="txt_avatar" value="<?php echo SITE_ROOT . 'upload' . '/' ?>' + $file + '" />';
                $('#thumbnail_container').html($html);
                $('#hdn_thumbnail').val($file);
            }
        });
    }

    function delete_thumbnail_onclick()
    {
        var $html = '</br>'
                + '<div style="width:250px;height: 150px;border:dashed #C0C0C0;margin: 0 auto;">'
                + '<a href="javascript:;">'
                + '<h4 class="center">'
                + ' <?php echo __('choose image') ?>'
                + '</h4>'
                + '</a>'
                + '</div>';
        $('#thumbnail_container').html($html);
        $('#hdn_thumbnail').val('');
    }
</script>
<?php
$this->template->display('dsp_footer.php');
