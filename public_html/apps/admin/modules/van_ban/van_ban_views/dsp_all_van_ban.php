<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}
?>
<?php
//header
$this->template->title = 'Danh sách văn bản';
$this->template->display('dsp_header.php');

$arr_img_ext = explode(',', strtolower(EXT_IMAGE));
$v_cqbh = get_request_var('sel_cqbh', '');
$v_lvtk = get_request_var('sel_lvtk', '');
$v_loai_vb = get_request_var('sel_loai_vb', '');
?>
<style>
    .pager
    {
        padding: 0;
        margin:0;
    }
</style>
<h1 class="page-header"><?php echo __('Danh sách văn bản'); ?></h1>

<form action="<?php $this->get_controller_url(); ?>" name="frmMain" id="frmMain" method="POST">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_item_id', '0');
    echo $this->hidden('hdn_item_id_list', '');
    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_van_ban');
    echo $this->hidden('hdn_dsp_all_method', 'qry_all_van_ban');
    echo $this->hidden('hdn_update_method', 'update_van_ban');
    echo $this->hidden('hdn_delete_method', 'delete_van_ban');
    ?>
    <style>
        .block
        {
            padding: 0;
            margin: 0;
        }
    </style>

    <!-- /.panel-heading -->
    <div class="Row">
        <div class="Row">
            <div class="left-Col">
                Lĩnh vực thống kê
            </div>
            <div class="right-Col">
                <select name="sel_lvtk" id="sel_lvtk" style="min-width: 206px" class="form-control ">
                    <option value="">-- Lĩnh vực thống kê --</option>
                    <?php foreach ($arrStatistics as $key => $Statistics) : ?>
                        <?php $selected = ($v_lvtk == $Statistics['PK_LINH_VUC_VAN_BAN']) ? "selected='selected'" : ''; ?>
                        <option  <?php echo $selected; ?> value="<?php echo $Statistics['PK_LINH_VUC_VAN_BAN'] ?>"><?php echo $Statistics['C_NAME'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="clear" style="height: 10px;"></div>
        <div class="Row">
            <div class="left-Col">
                Loại văn bản
            </div>
            <div class="right-Col">
                <select name="sel_loai_vb" id="sel_loai_vb" style="min-width: 206px" class="form-control ">
                    <option value="">-- Loại văn bản --</option>
                    <?php foreach ($arrDocType as $col => $DocType) : ?>
                        <?php $selected = ($v_loai_vb == $DocType['C_LOAI_VAN_BAN']) ? "selected='selected'" : ''; ?>
                        <option <?php echo $selected; ?> value="<?php echo $DocType['C_LOAI_VAN_BAN'] ?>"><?php echo $DocType['C_LOAI_VAN_BAN'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="clear" style="height: 10px;"></div>

        <div class="Row">
            <div class="left-Col">
                Cơ quan ban hành
            </div>
            <div class="right-Col">
                <select name="sel_cqbh" id="sel_cqbh" style="min-width: 206px" class="form-control ">
                    <option value="">-- Cơ quan ban hành --</option>
                    <?php foreach ($arrOrganization as $k => $Organization) : ?>
                        <?php $selected = ($v_cqbh == $Organization['PK_CO_QUAN_BAN_HANH']) ? "selected='selected'" : ''; ?>
                        <option <?php echo $selected; ?> value="<?php echo $Organization['PK_CO_QUAN_BAN_HANH'] ?>"><?php echo $Organization['C_NAME'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="clear" style="height: 10px;"></div>

        <div class="Row">
            <div class="left-Col">
                Từ khóa
            </div>
            <div class="right-Col">
                <div class="col-sm-5 block">
                    <input type="text" class="form-control" size="30" value="<?php echo get_request_var('txt_title', '') ?>" id="txt_title" name="txt_title" placeholder="Tiêu đề/Số hiệu văn bản"></div>
                <div class="clear" style="height: 10px;"></div>
                <div class="col-sm-4 no-padding">
                    <button type="submit" class="ButtonSearch">Tìm kiếm</button>
                    <button type="reset" class="ButtonDelete" onclick="fc_reset_form()">Xóa điều kiện lọc</button>
                </div>
            </div>
        </div>
        <div class="clear" style="height: 10px;"></div>

        <div class="table-responsive">
            <table class="adminlist">
                <thead>
                <colgroup>
                    <col width="5%" />
                    <col width="*" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="10%" />
                </colgroup>
                <tr>
                    <th><input type="checkbox" name="chk_check_all" onclick="toggle_check_all(this, this.form.chk);"/></th>
                    <th><?php echo __('Tên văn bản'); ?></th>
                    <th><?php echo __('Số hiệu'); ?></th>
                    <th><?php echo __('Cơ quan ban hành'); ?></th>
                    <th><?php echo __('Lĩnh vực thống kê'); ?></th>
                    <th><?php echo __('Loại văn bản'); ?></th>
                    <th><?php echo __('status'); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php $row = 0;
                    $arr_all_van_ban = is_array($arr_all_van_ban) ? $arr_all_van_ban : array();
                    ?>
<?php foreach ($arr_all_van_ban as $arr_row): ?>
                        <tr>
                            <td class="Center">
                                <input type="checkbox" name="chk"
                                       value="<?php echo $arr_row['PK_VAN_BAN']; ?>" 
                                       onclick="if (!this.checked)
                                                       this.form.chk_check_all.checked = false;" 
                                       />
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="row_onclick(<?php echo $arr_row['PK_VAN_BAN']; ?>)">  
    <?php echo $arr_row['C_TITLE']; ?>
                                </a>

                            </td>
                            <td style="text-align:center" align="center">
    <?php echo $arr_row['C_SO_HIEU_VAN_BAN']; ?>
                            </td>
                            <td style="text-align:center" align="center">
    <?php echo $arr_row['C_NAME_CO_QUAN_BAN_HANH']; ?>
                            </td>
                            <td style="text-align:center" align="center">
    <?php echo $arr_row['C_NAME_LINH_VUC_BAN_HANH']; ?>
                            </td>
                            <td style="text-align:center" align="center">
    <?php echo $arr_row['C_LOAI_VAN_BAN']; ?>
                            </td>
                            <td style="text-align:center" align="center">
    <?php echo ($arr_row['C_STATUS'] == 1) ? __('display') : __('display none'); ?>
                            </td>
                        </tr>
                        <?php $row = ($row == 1) ? 0 : 1; ?>
<?php endforeach; ?>
                </tbody>
            </table>
            <!-- /.table-responsive -->
            <div class="button-area" style="float:right;padding-top: 0;">
                <?php
                $arr_all_van_ban[0]['TOTAL_RECORD'] = isset($arr_all_van_ban[0]['TOTAL_RECORD']) ? $arr_all_van_ban[0]['TOTAL_RECORD'] : 0;
                echo $this->paging2($arr_all_van_ban);
                ?>
            </div>
        </div>

    </div>
    <!-- /.panel-body -->


<?php //echo $this->paging2($arr_all_van_ban);  ?>
    <div class="button-area">

        <button type="button" name="addnew" class="ButtonAdd" onclick="btn_addnew_onclick();">
            <i class="fa fa-plus"></i> <?php echo __('add new'); ?>
        </button>
        <button type="button" name="trash" class="ButtonDelete" onclick="btn_delete_onclick();" style="margin-left:10px;">
            <i class="fa fa-times"></i> <?php echo __('delete'); ?> 
        </button>
    </div>
</form>
<script>

    $('select[name=sel_rows_per_page]').change(function () {
        $('#page_size').val($(this).val());
        $('#frmMain').submit();
    });
    $('select[name=sel_goto_page]').change(function () {
        $('#page_no').val($(this).val());
        $('#frmMain').submit();
    });

    $('#txt_title').keyup(function (e) {
        if (e.keyCode == 13)
        {
            $('#txt_title').parents('form').submit();
        }
    });
    function fc_reset_form()
    {
        $('#sel_cqbh option').removeAttr('selected', '');
        $('#sel_lvtk option').removeAttr('selected', '');
        $('#sel_loai_vb option').removeAttr('selected', '');
        $('#txt_title').attr('value', '');
    }
</script>

<?php
$this->template->display('dsp_footer.php');
