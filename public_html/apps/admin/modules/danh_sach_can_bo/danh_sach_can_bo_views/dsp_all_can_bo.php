<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
?>
<?php
//header
@session::init();

$this->template->title = 'Danh sách cán bộ';
$this->template->display('dsp_header.php');

$arr_img_ext = explode(',', strtolower(EXT_IMAGE));
?>
<h1 class="page-header"><?php echo __('Danh sách cán bộ'); ?></h1>
<form action="<?php $this->get_controller_url(); ?>" name="frmMain" id="frmMain" method="POST">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_item_id', '0');
    echo $this->hidden('hdn_item_id_list', '');
    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_can_bo');
    echo $this->hidden('hdn_dsp_all_method', 'dsp_all_can_bo');
    echo $this->hidden('hdn_update_method', 'update_can_bo');
    echo $this->hidden('hdn_delete_method', 'delete_can_bo');
    ?>
    <div class="Row">
        <div class="left-Col" style='width:10%'>
            Đơn vị:
        </div>        
        <div class="right-Col" style='width:30%'>
            <select name="sel_Coquan" id="" style="min-width: 220px">
                <option value="" selected></option>
                <?php foreach ($arr_all_co_quan as $row): ?>
                    <option value="<?php echo $row['PK_MEMBER'] ?>"><?php echo $row['C_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="left-Col" style='width:10%'>
            Từ khóa:
        </div>
        <div class="right-Col" style='width:30%'>
            <input type="text" size='36' name='txt_Tukhoa' />
        </div>
        <div class="right-Col" style='width:20%; '>
            <button class='ButtonSearch' style='margin: 0px;'>Tìm kiếm</button>
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
                <col width="20%" />
                <col width="20%" />
                <col width="10%" />
            </colgroup>
            <tr>
                <th><input type="checkbox" name="chk_check_all" onclick="toggle_check_all(this, this.form.chk);"/></th>
                <th><?php echo __('Họ tên'); ?></th>
                <th><?php echo __('Đơn vị'); ?></th>
                <th><?php echo __('Chức vụ'); ?></th>
                <th><?php echo __('Trạng thái'); ?></th>

            </tr>
            </thead>
            <tbody>
                <?php $row = 0; ?>
                <?php foreach ($arr_all_can_bo as $arr_row): ?>
                    <tr>
                        <td class="Center">
                            <input type="checkbox" name="chk"
                                   value="<?php echo $arr_row['PK_EMPLOYMENT']; ?>" 
                                   onclick="if (!this.checked)
                                                   this.form.chk_check_all.checked = false;" 
                                   />
                        </td>
                        <td style="text-align:center" align="center">
                            <a href="javascript:void(0)" onclick="row_onclick(<?php echo $arr_row['PK_EMPLOYMENT']; ?>)">  
                                <?php echo $arr_row['C_NAME']; ?>
                            </a>
                        </td>
                        <td style="text-align:center" align="center">
                            <?php echo $arr_row['DON_VI']; ?>
                        </td>
                        <td style="text-align:center" align="center">
                            <?php echo ($arr_row['C_JOB_TITLE'] == '') ? "Không rõ" : $arr_row['C_JOB_TITLE']; ?>
                        </td>
                        <td style="text-align:center" align="center">
                            <?php echo ($arr_row['C_STATUS'] == 1) ? __('Hoạt động') : __('Không hoạt động'); ?>
                        </td>
                    </tr>
                    <?php $row = ($row == 1) ? 0 : 1; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="clear" style="height: 10px;"></div>
    <div class='pager' id='pager' >
        Tổng số <?php echo $count; ?> trang. Chuyển tới <input type="text" name='txt_Pager' size='5' value='1'/> Hiển thị <input name="txt_Show" type="text" value='<?php echo _CONST_DEFAULT_ROWS_PER_PAGE ?>' size='5' /> bản ghi /1 trang <button class='ButtonSearch'>Lọc</button>
    </div>
    <div class="clear" style="height: 10px;"></div>
    <!-- /.table-responsive -->
    <!-- /.panel-body -->

</form>


<?php
$this->template->display('dsp_footer.php');
