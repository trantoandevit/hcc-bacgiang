<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('SERVER_ROOT'))
    exit('No direct script access allowed');

$this->template->title = __('member');
$this->template->display('dsp_header.php');
?>
<form name="frmMain" id="frmMain" action="" method="POST">
    <?php
    echo $this->hidden('controller', $this->get_controller_url());
    echo $this->hidden('hdn_item_id', 0);
    echo $this->hidden('hdn_item_id_list', '');

    echo $this->hidden('hdn_syn_member', 'do_sync_member');
    echo $this->hidden('hdn_syn_month', 'synthesis_month');
    echo $this->hidden('hdn_syn_quarter', 'synthesis_quarter');
    echo $this->hidden('hdn_syn_year', 'synthesis_year');
    echo $this->hidden('hdn_syn_spec', 'sync_spec');
    echo $this->hidden('hdn_syn_record_type', 'sync_record_type');
    echo $this->hidden('hdn_syn_lastest_record_has_result', 'sync_latest_record_has_result');
    ?>

    <!-- Toolbar -->
    <h2 class="module_title"><?php echo __('Đồng bộ dữ liệu'); ?></h2>
    
    <table width="100%" class="adminlist" cellspacing="0" border="1">
        <colgroup>
            <col width="70%">
            <col width="30%">
        </colgroup>
        <tr>
            <th>Chức năng</th>
            <th>Thao tác</th>
        </tr>
        <!--dong bo thanh vien-->
        <tr>
            <td>Đồng bộ thành viên</td>
            <td style="text-align: center">
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_member');">
            </td>
        </tr>
        <!--dong bo linh vuc-->
        <tr>
            <td>Đồng bộ lĩnh vực</td>
            <td style="text-align: center">
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_spec');">
            </td>
        </tr>
        <!--dong bo TTHC-->
        <tr>
            <td>Đồng bộ TTHC</td>
            <td style="text-align: center">
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_record_type');">
            </td>
        </tr>
        <!--dong bo ho so tra ket qua trong ngay-->
        <tr>
            <td>Đồng bộ hồ sơ trả kết quả trong ngày</td>
            <td style="text-align: center">
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_lastest_record_has_result');">
            </td>
        </tr>
        <!--dong bo du lieu tong hop theo thang-->
        <tr>
            <td>Đồng bộ hồ sơ theo tháng</td>
            <td>
               <div class="Row">
                   <div class="left-Col">Tháng</div>
                   <div class="right-Col">
                       <select name="sel_month" id="sel_month">
                           <?php 
                           $sel_month = get_request_var('sel_month', DATE('m'));
                           for($i = 1; $i <=12; $i++ ):
                                    $month = ($i < 10)?"0$i": $i;
                           
                                    $selected = ($month == $sel_month)? 'selected': '';
                            ?>
                           <option <?php echo $selected;?> value="<?php echo $month?>"><?php echo $month?></option>
                           <?php endfor;?>
                       </select>
                   </div>
               </div>
                <div class="Row">
                   <div class="left-Col">Năm</div>
                   <div class="right-Col">
                       <?php $txt_year = get_request_var('txt_year', DATE('Y'));?>
                       <input type="textbox" name="txt_year" value="<?php echo $txt_year?>" />
                   </div>
               </div>
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_month');">
            </td>
        </tr>
        <!--dong bo du lieu tong hop theo quy-->
        <tr>
            <td>Đồng bộ hồ sơ theo quý</td>
            <td>
               <div class="Row">
                   <div class="left-Col">Quý</div>
                   <div class="right-Col">
                       <?php $cur_quarter = jwdate::quarterOfYear(DATE('d'), DATE('m'), DATE('Y'))?>
                       <select name="sel_quarter" id="sel_quarter">
                           <option <?php echo ((int)$cur_quarter == 1)?'selected':'';?> value="1">01</option>
                           <option <?php echo ((int)$cur_quarter == 2)?'selected':'';?> value="2">02</option>
                           <option <?php echo ((int)$cur_quarter == 3)?'selected':'';?> value="3">03</option>
                           <option <?php echo ((int)$cur_quarter == 4)?'selected':'';?> value="4">04</option>
                       </select>
                   </div>
               </div>
                <div class="Row">
                   <div class="left-Col">Năm</div>
                   <div class="right-Col">
                       <?php $txt_year = get_request_var('txt_year', DATE('Y'));?>
                       <input type="textbox" name="txt_year_syn_quarter" value="<?php echo $txt_year?>" />
                   </div>
               </div>
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_quarter');">
            </td>
        </tr>
        <!--dong bo du lieu tong hop theo nam-->
        <tr>
            <td>Đồng bộ hồ sơ theo năm</td>
            <td>
                <div class="Row">
                   <div class="left-Col">Năm</div>
                   <div class="right-Col">
                       <?php $txt_year = get_request_var('txt_year', DATE('Y'));?>
                       <input type="textbox" name="txt_year_sync_year" value="<?php echo $txt_year?>" />
                   </div>
               </div>
                <input type="button" name="btn_addnew" class="ButtonSyn" value="" onclick="btn_post('hdn_syn_year');">
            </td>
        </tr>
    </table>
</form>
<script>
    function btn_post(id_method){
        var url = '';
        if(confirm('Bạn có muốn thực hiện thao tác này !!'))
        {
            url = $('#controller').val() + $('#' + id_method).val()
            $('#frmMain').attr('action', url);
            $('#frmMain').submit();
        }
        
    }
</script>
<?php
$this->template->display('dsp_footer.php');