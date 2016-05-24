$(function () {
    $('.nn2').hide();

    $(".lbl_chuhoso input.check_chuhoso").change(function () {
        var ischecked = $(this).is(':checked');
        if (!ischecked)
            $('.nn2').show();
//        $('.nn1, .nn3, .chi_tiet, .tt_nguoinop').removeClass("active");
//        $('.nn2').addClass("active");
//        $('.tt_chuhoso').addClass("active in");
    });
    if ($('.lbl_chuhoso input.check_chuhoso').is(":checked")) {
        $('.nn2').hide();
    }
    $('.lbl_chuhoso input.check_chuhoso').click(function () {
        $(".nn2").toggle(this.checked);
    });
    $(".btnXac_nhan").click(function () {
        $('.nn3').show();
//        $('.nn1, .nn2, .tt_chuhoso, .tt_nguoinop').removeClass("active");
//        $('.nn3').addClass("active");
//        $('.chi_tiet').addClass("active in");
    });


});
function btn_add() {
    var add = '<input type="file" name="" id=""/>';
    $(".add_dinh_kem").after(add);
}
function btn_remove() {
    $(".dinh_kem input:last-child").remove();
}
