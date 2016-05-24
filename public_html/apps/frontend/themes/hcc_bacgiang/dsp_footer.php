<footer>
    <div class="footer_top container">
        <div class="row">
            <div class="col-md-5 col-xs-12">
                <h4>Trung tâm hành chính</h4>
                <div class="info-contact">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-building-o"></i> Đường Hoàng Văn Thụ - Thành phố Bắc Giang - Tỉnh Bắc Giang</li>
                        <li><i class="fa fa-phone-square"></i> (024) 3555 996</li>
                        <li><i class="fa fa-phone-square"></i> (024) 3555 995</li>

                    </ul>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-lkn">
                <h4>Liên kết nhanh</h4>
                <div class="lien-ket-nhanh">
                    <ul class="list-unstyled">
                        <li><a href="<?php echo FULL_SITE_ROOT ?>"><i class="fa fa-angle-right"></i> Trang chủ</a></li>
                        <li><a href=""><i class="fa fa-angle-right"></i> Dịch vụ công trực tuyến</a></li>
                        <li><a href="<?php echo FULL_SITE_ROOT ?>danh-sach-don-vi"><i class="fa fa-angle-right"></i> Danh sách đơn vị</a></li>
                        <li><a href=""><i class="fa fa-angle-right"></i> Giới thiệu</a></li>
                        <li><a href="<?php echo FULL_SITE_ROOT ?>huong-dan"><i class="fa fa-angle-right"></i> Hướng dẫn</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 col-m">
                <h4>Bản đồ</h4>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10515.693560313191!2d106.20218751825473!3d21.27704374488574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31356d0b2c091879%3A0xff4309b31f01d82d!2zSG_DoG5nIFbEg24gVGjhu6UsIHRwLiBC4bqvYyBHaWFuZywgQuG6r2MgR2lhbmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2svn!4v1460459536961" width="100%" height="140" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h5>Cơ quan chủ quản: tỉnh Bắc Giang</h5>
                <div class="thong-tin-co-quan">
                    <p>Chịu trách nhiệm nội dung: Sở Nội Vụ</p>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <p>Địa chỉ: Tầng 2 và tầng 3, Tòa nhà khối cơ quan chuyên môn, Khu liên cơ quan tỉnh Bắc Giang,</p>
            </div>
            <div class="lien-he-1">
                <p class="ct-dt">Điện thoại: (0240)3 854 350 - Số Fax: (0240)3 858 450</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <p>Quảng trường 3/2, phường Ngô Quyền, TP. Bắc Giang - tỉnh Bắc Giang</p>
            </div>
            <div class="lien-he-2">
                <p class="ct-email">Email: so_noivu_vt@bacgiang.gov.vn - Website: <a href="http://sonoivu.bacgiang.gov.vn/" target="_blank">sonoivu.bacgiang.gov.vn</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- Modal -->
<div id="docModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header mh_header">
                <h4 class="modal-title text-center tc_header" id="myModalLabel">Thông Tin Văn Bản</h4>
            </div>
            <div class="modal-body">
                <div class="docModalContent">
                        <h2 class="title_modal" id="documentModalTitle"></h2>
                    <table class="table" id="table_Modal"> 
                        <tbody>
                            <tr style="border-bottom: 1px dotted #d2d2d2"> 
                                <td style="width: 35%;" class="link">Số hiệu văn bản</td> 
                                <td style="width: 65%;" id="modalSoHieuVanBan"></td> 
                            </tr> 
                            <tr style="border-bottom: 1px dotted #d2d2d2"> 
                                <td style="width: 35%;" class="link">Cơ quan ban hành</td> 
                                <td style="width: 65%;" id="modalCoQuanBanHanh"></td> 
                            </tr> 
                            <tr style="border-bottom: 1px dotted #d2d2d2"> 
                                <td style="width: 35%;" class="link">Lĩnh vực thống kê</td> 
                                <td style="width: 65%;" id="modalLinhVucThongKe"></td> 
                            </tr> 
                            <tr style="border-bottom: 1px dotted #d2d2d2"> 
                                <td style="width: 35%;" class="link">Loại văn bản</td> 
                                <td style="width: 65%;" id="modalLoaiVanBan"></td> 
                            </tr> 
                            <tr style="border-bottom: 1px dotted #d2d2d2"> 
                                <td style="width: 35%;" class="link">Ngày ban hành</td> 
                                <td style="width: 65%;" id="modalNgayBanHanh"></td> 
                            </tr> 
                            <tr style="border-bottom: 1px dotted #d2d2d2"> 
                                <td style="width: 35%;" class="link">Ngày có hiệu lực</td> 
                                <td style="width: 65%;" id="modalNgayHieuLuc"></td> 
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>
<div id="notiModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                
            </div>
        </div>

    </div>
</div>
<script>
    
    /**
 * Comment
 */
function show_noti_modal(id)
{
    $('#notiModal').modal({
            backdrop: true
    });
}
</script>
</div>
<?php $this->render('dsp_modal_lookup_record', array(), $this->theme_code); ?>
</body>
</html>
