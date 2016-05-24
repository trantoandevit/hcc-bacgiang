<?php
if (!defined('SERVER_ROOT')) {
    exit('No direct script access allowed');
}

$this->template->title = 'Chi tiết văn bản';
$this->template->display('dsp_header.php');


$v_van_ban_id = isset($arr_single_van_ban['PK_VAN_BAN']) ? $arr_single_van_ban['PK_VAN_BAN'] : 0;
$v_name = isset($arr_single_van_ban['C_TITLE']) ? $arr_single_van_ban['C_TITLE'] : '';
$txt_so_hieu_van_ban = isset($arr_single_van_ban['C_SO_HIEU_VAN_BAN']) ? $arr_single_van_ban['C_SO_HIEU_VAN_BAN'] : '';
$sel_co_quan_ban_hanh = isset($arr_single_van_ban['FK_CO_QUAN_BAN_HANH']) ? $arr_single_van_ban['FK_CO_QUAN_BAN_HANH'] : 0;
$sel_linh_vuc_thong_ke = isset($arr_single_van_ban['FK_LINH_VUC_VAN_BAN']) ? $arr_single_van_ban['FK_LINH_VUC_VAN_BAN'] : 0;
$txt_loai_van_ban = isset($arr_single_van_ban['C_LOAI_VAN_BAN']) ? $arr_single_van_ban['C_LOAI_VAN_BAN'] : '';
$txt_ngay_ban_hanh = isset($arr_single_van_ban['C_NGAY_BAN_HANH']) ? $arr_single_van_ban['C_NGAY_BAN_HANH'] : '';
$txt_ngay_ban_hanh = ($txt_ngay_ban_hanh != '') ? jwDate::ddmmyyyy_to_yyyymmdd($txt_ngay_ban_hanh) : '';
$txt_ngay_co_hieu_luc = isset($arr_single_van_ban['C_NGAY_HIEU_LUC']) ? $arr_single_van_ban['C_NGAY_HIEU_LUC'] : '';
$txt_ngay_co_hieu_luc = ($txt_ngay_co_hieu_luc != '') ? jwDate::ddmmyyyy_to_yyyymmdd($txt_ngay_co_hieu_luc) : '';
$v_status = isset($arr_single_van_ban['C_STATUS']) ? $arr_single_van_ban['C_STATUS'] : 0;
?>

<form class="form-horizontal" name="frmMain" id="frmMain" method="post" action="<?php echo $this->get_controller_url() . 'update_van_ban'; ?>">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_dsp_single_method', 'dsp_single_van_ban');
    echo $this->hidden('hdn_dsp_all_method', 'qry_all_van_ban');
    echo $this->hidden('hdn_update_method', 'update_van_ban');
    echo $this->hidden('hdn_delete_method', 'delete_van_ban');

    echo $this->hidden('hdn_item_id_list', '');
    echo $this->hidden('hdn_item_id', $v_van_ban_id);
    echo $this->hidden('XmlData', '');
//Luu dieu kien loc
    ?>
    <h1 class="page-header"><?php echo __('Chi tiết văn bản'); ?></h1>
    <div>
        <div class=" panel-default">

            <div class="Row">
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Tên văn bản'); ?> <label class="required">(*)</label></label>
                    </div>
                    <div class="right-Col">
                        <textarea   name="txt_name" id="txt_name"
                                    class="form-control" 
                                    data-allownull="no" data-validate="text" data-name="<?php echo __('ten_van_ban'); ?>" 
                                    data-xml="no" data-doc="no" style="width: 31%;float: left"  rows="4" > <?php echo $v_name; ?></textarea>
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Số hiệu văn bản') ?></label>
                    </div>
                    <div class="right-Col">
                        <input style="width: 31%;float: left" type="text" name="txt_so_hieu_van_ban" id="txt_so_hieu_van_ban" value="<?php echo $txt_so_hieu_van_ban; ?>" 
                               class="form-control" 
                               data-validate="text"
                               data-allownull="yes" data-name="<?php echo __('so_hieu_van_ban'); ?>" 
                               data-xml="yes" data-doc="no" 
                               />
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Cơ quan ban hành') ?></label>
                    </div>
                    <div class="right-Col">
                        <select 
                            name="sel_co_quan_ban_hanh" id="sel_co_quan_ban_hanh" style="min-width: 206px"  class="form-control"
                            data-validate="number" data-name="<?php echo __('co_quan_ban_hanh'); ?>"
                            >
                            <option value="0"> --- <?php echo __('so_hieu_van_ban') ?> ---</option>
                            <?php
                            foreach ($arr_all_co_quan_ban_hanh as $item) {
                                $v_co_quan_ban_hanh_name = $item['C_NAME'];
                                $v_co_quan_ban_hanh_id = $item['PK_CO_QUAN_BAN_HANH'];
                                $selected = ($sel_co_quan_ban_hanh == $v_co_quan_ban_hanh_id) ? 'selected' : '';
                                echo "<option $selected value='$v_co_quan_ban_hanh_id'>$v_co_quan_ban_hanh_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Lĩnh vực thống kê') ?></label>
                    </div>
                    <div class="right-Col">
                        <select 
                            name="sel_linh_vuc_thong_ke" id="sel_linh_vuc_thong_ke" style="min-width: 206px"  class="form-control"
                            data-validate="number" data-name="<?php echo __('linh_vuc_thong_ke'); ?>"
                            >
                            <option value="0"> --- <?php echo __('linh_vuc_thong_ke') ?> ---</option>
                            <?php
                            foreach ($arr_all_linh_vuc_thong_ke as $item) {
                                $v_linh_vuc_thong_ke_name = $item['C_NAME'];
                                $v_linh_vuc_thong_ke_id = $item['PK_LINH_VUC_VAN_BAN'];
                                $selected = ($sel_linh_vuc_thong_ke == $v_linh_vuc_thong_ke_id) ? 'selected' : '';
                                echo "<option $selected value='$v_linh_vuc_thong_ke_id'>$v_linh_vuc_thong_ke_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Loại văn bản') ?></label>
                    </div>
                    <div class="right-Col">
                        <input style="width: 31%;float: left" type="text" name="txt_loai_van_ban" id="txt_loai_van_ban" value="<?php echo $txt_loai_van_ban; ?>" 
                               class="form-control" 
                               data-validate="text"
                               data-allownull="yes" data-name="<?php echo __('loai_van_ban'); ?>" 
                               data-xml="yes" data-doc="no" 
                               />
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Ngày ban hành') ?></label>
                    </div>
                    <div class="right-Col">
                        <input style="width: 31%;float: left" type="text" name="txt_ngay_ban_hanh" id="txt_ngay_ban_hanh" value="<?php echo $txt_ngay_ban_hanh; ?>" 
                               class="form-control" 
                               data-validate="date"
                               data-allownull="yes" data-name="<?php echo __('ngay_ban_hanh'); ?>" 
                               data-xml="yes" data-doc="no"
                               />
                    </div>
                </div>

                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Ngày có hiệu lực') ?></label>
                    </div>
                    <div class="right-Col">
                        <input style="width: 31%;float: left" type="text" name="txt_ngay_co_hieu_luc" id="txt_ngay_co_hieu_luc" value="<?php echo $txt_ngay_co_hieu_luc; ?>" 
                               class="form-control" 
                               data-validate="date"
                               data-allownull="yes" data-name="<?php echo __('ngay_co_hieu_luc'); ?>" 
                               data-xml="yes" data-doc="no" 
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
                
                <div class="Row">
                    <div class="left-Col">
                        <label class="col-sm-3 control-label"><?php echo __('Văn bản đính kèm') ?></label>
                    </div>
                    <div class="right-Col">
                        <div class="panel-heading">
                            <a style="" href="javascript:;" onClick="btn_add_attachment_onclick();">
                                <?php echo __('add new') ?>
                            </a>
                            <font><?php echo __('attachment') ?> </font>
                        </div>
                        <div class="panel-body" id="category-content">
                            <div class="ui-widget-content Center" id="attachment_container" style="height:120px;overflow-x: hidden;overflow-y: scroll;">
                                <?php foreach ($arr_all_attachment as $item): ?>
                                    <p style="margin:3px;width:100%;float:left;text-align: left">
                                        <img height="12" width="12" onClick="delete_attachment(this);"
                                             src="<?php echo SITE_ROOT; ?>public/images/icon_bannermenu_exit.gif"'
                                             />
                                        <input type="hidden" name="hdn_attachment[]" value="<?php echo $item['C_FILE_NAME'] ?>"/>
                                        &nbsp;<?php echo basename($item['C_FILE_NAME']) ?>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
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

    function btn_add_attachment_onclick()
    {
        var $url = "<?php echo $this->get_controller_url('advmedia', 'admin') . 'dsp_service/'; ?>";

        showPopWin($url, 800, 600, function (json_obj) {
            console.log(json_obj);
            $.each(json_obj, function (k, v) {
                $file = v['path'];
                $name = v['name'];
                $html = '<p style="margin:3px;width:100%;float:left;text-align:left;">'
                        + '<img height="12" width="12" src="<?php echo SITE_ROOT; ?>public/images/icon_bannermenu_exit.gif"'
                        + 'onClick="delete_attachment(this);"/>'
                        + '<input type="hidden" name="hdn_attachment[]" value="' + $file + '"/>'
                        + '&nbsp;' + $name
                        + '</p>';

                $('#attachment_container').append($html);
            });
        });
    }

    function delete_attachment(img_obj)
    {
        $(img_obj).parent().remove();
    }
</script>
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
                    </br>
                    <?php if ($v_thumbnail_file): ?>
                        <img 
                            width="250" 
                            src="<?php echo SITE_ROOT . 'upload/' . $v_thumbnail_file ?>"
                            />
                        <?php else: ?>
                        <div style="width:250px;height: 150px;border:dashed #C0C0C0;margin: 0 auto;">
                            <a href="javascript:;">
                                <h4 class="Center">
                                    <?php echo __('choose image') ?>
                                </h4>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div><!--widget thumbnail-->
            
<?php
$this->template->display('dsp_footer.php');
