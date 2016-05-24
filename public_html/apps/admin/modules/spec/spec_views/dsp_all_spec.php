<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
?>
<?php
//header
@session::init();

$this->template->title = 'Danh sách lĩnh vực';
$this->template->display('dsp_header.php');
$arr_img_ext = explode(',', strtolower(EXT_IMAGE));
$count = ceil($arr_all_spec['COUNT'] / _CONST_DEFAULT_ROWS_PER_PAGE);
$arr_all_spec = $arr_all_spec['DATA'];
$current_page = isset($data['txt_Pager']) ? $data['txt_Pager'] : 1;
$current_show = isset($data['txt_Show']) ? $data['txt_Show'] : _CONST_DEFAULT_ROWS_PER_PAGE;
$current_member = isset($data['sel_Coquan']) ? $data['sel_Coquan'] : "";
$current_keyword = isset($data['txt_Tukhoa']) ? $data['txt_Tukhoa'] : "";
?>
<?php
?>
<h1 class="page-header"><?php echo __('Danh sách lĩnh vực'); ?></h1>
<form action="<?php $this->get_controller_url(); ?>" name="frmMain" id="frmMain" method="POST">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_item_id', '0');
    echo $this->hidden('hdn_item_id_list', '');
    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_spec');
    echo $this->hidden('hdn_dsp_all_method', 'qry_all_spec');
    echo $this->hidden('hdn_update_method', 'update_spec');
    echo $this->hidden('hdn_delete_method', 'delete_spec');
    ?>
    <div class="Row">
        <div class="left-Col" style='width:10%'>
            Đơn vị:
        </div>        
        <div class="right-Col" style='width:30%'>
            <select name="sel_Coquan" id="" style="min-width: 220px">
                <option value="" selected></option>
                <?php foreach ($arr_all_member as $row): ?>
                    <?php $selected = ($current_member == $row['C_CODE']) ? 'selected' : ''; ?>
                    <option value="<?php echo $row['C_CODE'] ?>"  <?php echo $selected; ?> ><?php echo $row['C_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="left-Col" style='width:10%'>
            Từ khóa:
        </div>
        <div class="right-Col" style='width:30%'>
            <input type="text" size='36' name='txt_Tukhoa' value="<?php echo $current_keyword ?>" />
        </div>
        <div class="right-Col" style='width:20%; '>
            <button id="ButtonSearch" class='ButtonSearch' style='margin: 0px;'>Tìm kiếm</button>
        </div>
    </div>

<div class="button-area">

    <button type="button" name="addnew" class="ButtonAdd" onclick="btn_addnew_onclick();">
        <i class="fa fa-plus"></i> <?php echo __('add new'); ?>
    </button>
    <button type="button" name="trash" class="ButtonDelete" onclick="btn_delete_onclick();" style="margin-left:10px;">
        <i class="fa fa-times"></i> <?php echo __('delete'); ?> 
    </button>

    <?php if (get_system_config_value(CFGKEY_CACHE) == 'true'): ?>
        <button type="button" name="trash" class="btn btn-outline btn-success" onClick="btn_cache_onclick();" style="margin-left:10px;">
            <i class="fa fa-save"></i> <?php echo __('save cache'); ?>
        </button>
    <?php endif; ?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="table-responsive">
        <table width="100%" class="adminlist">
            <thead>
            <colgroup>
                <col width="5%" />
                <col width="*%" />
                <col width="10%" />
                <col width="30%" />
            </colgroup>
            <tr>
                <th><input type="checkbox" name="chk_check_all" onclick="toggle_check_all(this, this.form.chk);"/></th>
                <th><?php echo __('Tên lĩnh vực'); ?></th>
                <th><?php echo __('Phát triển'); ?></th>
                <th><?php echo __('Cơ quan'); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php $row = 0; ?>
                <?php foreach ($arr_all_spec as $arr_row): ?>
                    <tr>
                        <td class="Center">
                            <input type="checkbox" name="chk"
                                   value="<?php echo $arr_row['PK_SPEC']; ?>" 
                                   onclick="if (!this.checked)
                                                   this.form.chk_check_all.checked = false;" 
                                   />
                        </td>
                        <td align="center">
                            <a href="javascript:void(0)" onclick="row_onclick(<?php echo $arr_row['PK_SPEC']; ?>)">  
                                <?php echo $arr_row['C_NAME']; ?>
                            </a>
                        </td>
                        <td style="text-align:center" align="center">
                            <?php echo $arr_row['C_DEVELOPER_CODE']; ?>
                        </td>
                        <td style="text-align:center" align="center">
                            <?php echo $arr_row['C_NAME_MEMBER'] = isset($arr_row['C_NAME_MEMBER']) ? $arr_row['C_NAME_MEMBER'] : "Cấp huyện"; ?>
                        </td>
                    </tr>
                    <?php $row = ($row == 1) ? 0 : 1; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="clear" style="height: 10px;"></div>
    <div class='pager' id='pager' >
        Tổng số <?php echo $count ?> trang. Chuyển tới <input type="text" name='txt_Pager' size='5' value='<?php echo $current_page?>'/> Hiển thị <input name="txt_Show" type="text" value='<?php echo $current_show ?>' size='5' /> bản ghi /1 trang <button class='ButtonSearch'>Lọc</button>
    </div>
    <div class="clear" style="height: 10px;"></div>
    <!-- /.table-responsive -->
    <!-- /.panel-body -->

</form>
<script>
    $('#ButtonSearch').click(function(){
        $('input[name="txt_Pager"]').val('1');
    });
</script>


<?php
$this->template->display('dsp_footer.php');
