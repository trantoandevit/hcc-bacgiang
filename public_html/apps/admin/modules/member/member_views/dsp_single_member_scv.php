<?php
defined('DS') or die('no direct access');

$enable_all = get_request_var('enable_all') ? true : false;

$this->template->title = __('category');
$this->template->display('dsp_header_pop_win.php');
//var_dump($arr_record_type);
$v_single_pick = get_request_var('single_pick', '0');
?>

<?php

function show_button() {
    $html = '<div class="button-area">';
    $html .= '<input type="button" class="ButtonAccept" onClick="return_func();" value="' . __('select') . '"/>';
    $html .= '<input type="button" class="ButtonCancel" onClick="window.parent.hidePopWin(false);" value="' . __('cancel') . '"/>';
    $html .= '</div>';
    echo $html;
}
?>

<?php show_button(); ?>
<form name="frmMain" id="frmMain" method="post">
    <div style="height:300px;overflow: scroll;overflow-x: hidden;">
        <input type="button" class="ButtonDelete" onClick="not_select_category_onclick();" value="<?php echo __('not select category') ?>"/>
        <table width="100%" class="adminlist" cellspacing="0" border="1" >
            <colgroup>
                <col width="10%" />
                <col width="10%" />
                <col width="60%" />
                <col width="20%" />
            </colgroup>
            <tr>
                <?php if ($v_single_pick != '0'): ?>
                    <th>&nbsp;</th>
                <?php else: ?>
                    <th><input type="checkbox" id="chk-all"/></th>
                <?php endif; ?>
                <th>Mã</th>
                <th>Tên TTHC</th>
                <th>Trạng thái</th>
            </tr>
            <?php foreach ($arr_record_type as $row): ?>
                <tr>
                    <td>
                        <input
                            type="checkbox" name="chk-item[]" class="chk-item"
                            value="<?php echo $row['PK_RECORD_TYPE']; ?>"
                            id="item_<?php echo $row['PK_RECORD_TYPE']; ?>"
                            data-developer="<?php echo $row['C_DEVELOPER_CODE']; ?>"
                            data-code="<?php echo $row['C_MEMBER_CODE']; ?>"
                            />
                    </td>
                    <td><?php echo $row['C_CODE']; ?></td>
                    <td><?php echo $row['C_NAME']; ?></td>
                    <td><?php
                        $status = "";
                        if ($row['C_STATUS'] == 1) {
                            $status = "Hoạt động";
                        } else {
                            $status = "Không hoạt động";
                        }
                        echo $status;
                        ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</form>
<?php show_button() ?>

<?php $this->template->display('dsp_footer_pop_win.php') ?>

<script>
    toggle_checkbox('#chk-all', '.chk-item');

    function return_func()
    {
        var a = [];
        $('.chk-item:checked').each(function () {
            var v_id = $(this).val();
            var v_developer = $(this).attr('data-developer');
            var v_code = $(this).attr('data-code');
            
            a.push({id: v_id, code: v_code, developer: v_developer});
        });
        returnVal = a;
        window.parent.hidePopWin(true);
    }

    function not_select_category_onclick(chk_not_select)
    {
        $('.chk-item:checked').removeAttr('checked');
    }

    //single pick onclick
<?php if ($v_single_pick != '0'): ?>
        $('[name="chk-item[]"]').click(function () {
            cur_chk = $(this);
            $('[name="chk-item[]"]:checked').each(function () {
                if ($(this).val() != $(cur_chk).val())
                {

                    $(this).removeAttr('checked');
                }
            });
        });
<?php endif; ?>
</script>