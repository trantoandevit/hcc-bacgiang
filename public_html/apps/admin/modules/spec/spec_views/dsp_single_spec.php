<?php ?>
<?php
if (!defined('SERVER_ROOT'))
{
    exit('No direct script access allowed');
}
//header
$this->template->title = 'Chi tiết lĩnh vực';
$this->template->display('dsp_header.php');
$v_name = isset($arr_single_spec['C_NAME']) ? $arr_single_spec['C_NAME'] : '';
$v_member_name = isset($arr_single_spec['member_name']) ? $arr_single_spec['member_name'] : "Cấp huyện";
$v_member_code = isset($arr_single_spec['C_MEMBER_CODE']) ? $arr_single_spec['C_MEMBER_CODE'] : "";
$v_code = isset($arr_single_spec['C_CODE']) ? $arr_single_spec['C_CODE'] : "";
$v_id_spec = isset($arr_single_spec['PK_SPEC']) ? $arr_single_spec['PK_SPEC'] : "";
$disabled = $v_id_spec ? true : false;
?>
<form class="form-horizontal" name="frmMain" id="frmMain" method="post" action="<?php echo $this->get_controller_url() . 'update_co_quan_ban_hanh'; ?>">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_spec');
    echo $this->hidden('hdn_dsp_all_method', 'dsp_all_spec');
    echo $this->hidden('hdn_update_method', 'update_spec');
    echo $this->hidden('hdn_delete_method', 'delete_spec');
    echo $this->hidden('hdn_item_id_list', '');
    echo $this->hidden('hdn_item_id', $v_id_spec);
    echo $this->hidden('XmlData', '');
//Luu dieu kien loc
    ?>
    <h1 class="page-header"><?php echo __('Thông tin lĩnh vực'); ?></h1>
    <div>
        <div class=" panel-default">

            <div class="Row">
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Tên lĩnh vực'); ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <input type="text" name="txt_name" id="txt_name" value="<?php echo $v_name; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text" data-name="<?php echo __('Tên lĩnh vực'); ?>" 
                               data-xml="no" data-doc="no" 
                               />
                    </div>
                </div>
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Mã lĩnh vực'); ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <?php $disable_input = $disabled ? 'disabled' : "" ?>
                        <input type="text" name="txt_code" id="txt_code" value="<?php echo $v_code; ?>" 
                               class="form-control" maxlength="255"
                               data-allownull="no" data-validate="text" data-name="<?php echo __('Mã lĩnh vực'); ?>" 
                               data-xml="no" data-doc="no" 
                               <?php echo $disable_input ?>
                               />
                    </div>
                </div>
                <?php if ($disabled): ?>
                    <div class="Row">
                        <div class="left-Col">
                            <label class="col-sm-3 control-label"><?php echo __('Đơn vị'); ?> <label class="required">(*)</label></label>
                        </div>
                        <div class="right-Col">
                            <input disabled type="text" name="txt_name" id="txt_name" value="<?php echo $v_member_name; ?>" 
                                   class="form-control" maxlength="255"
                                   data-allownull="yes" data-validate="text" data-name="<?php echo __('Đơn vị'); ?>" 
                                   data-xml="no" data-doc="no" 
                                   />
                        </div>
                    </div>
                <?php else: ?>
                    <div class="Row">
                        <div class="left-Col">
                            <label class="col-sm-3 control-label"><?php echo __('Đơn vị') ?> <label class="required">(*)</label></label>
                        </div>
                        <div class="right-Col">
                            <select type="text" name="sel_member_code" id="sel_member_code"
                                    class="form-control" maxlength="255"
                                    data-allownull="no" data-validate="text"  data-name="<?php echo __('Đơn vị'); ?>" 
                                    data-xml="no" data-doc="no" >
                                <option value=""> -- Chọn đơn vị -- </option>
                                <?php $selected = ($v_member == 0) ? 'selected' : ''; ?>
                                <option value ="-1" <?php echo $selected ?> > Cấp huyện </option>
                                <?php foreach ($arr_all_member as $item): ?>
                                    <?php $selected = ($v_member_code == $item['C_CODE']) ? 'selected' : ''; ?>
                                    <option value="<?php echo $item['C_CODE'] ?>" <?php echo $selected ?> ><?php echo $item['C_NAME'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div> 
                <?php endif; ?>

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
