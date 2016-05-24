<?php
defined('DS') or die('no direct access');
?>
<?php if ($arr_all_widget_class = Session::get('arr_all_widget_class')): ?>
    <label>
        <?php echo __('color style') ?></br>
        <select name="sel_widget_style" style="width:100%;">
            <?php echo View::generate_select_option($arr_all_widget_class, $widget_style) ?>
        </select>
    </label>
<?php endif; ?>
<label>
    <?php echo __('display mode') ?></br>
    <select name="sel_display" style="width:100%">
        <?php
        $opt_val = array(
            'basic'           => __('basic')
           ,'advanced'        => __('advanced')
           ,'spotlight_list'  =>__('spotlight_list')
        );
        echo View::generate_select_option($opt_val, $display_mode);
        ?>
    </select>
</label>
<label>
    <?php echo __('spotlight position') ?></br>
    <select name="sel_widget_spotlight" style="width:100%">
        <option value="0"></option>
        <?php echo View::generate_select_option($arr_all_position, $selected); ?>
    </select>
</label>