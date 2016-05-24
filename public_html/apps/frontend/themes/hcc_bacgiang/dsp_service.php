<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php

$VIEW_DATA['arr_css'] = array("guide", "bootstrap-nav-wizard.min");
$VIEW_DATA['arr_script'] = array("my_js/service/service");
$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 l_right">
                    <div class="tab_content">
                        <div class="div_dktk">
                            <div class="lr_head">
                                <div class="row hd_head">
                                    <div class="col-md-12">
                                        <div class="hdh_head">
                                            <ul class="nav nav-tabs nav-wizard" >
                                                <li class="active b1">
                                                    <a href="#buoc1" data-toggle="tab"><span>Bước 1</span></a>
                                                    <span>Chọn thông tin thủ tục</span>
                                                </li>
                                                <!--<li class="li_hd">Truy cập vào trang hcc.bacgiang.gov.vn</li>-->
                                                <li class="b2">
                                                    <a href="#buoc2" data-toggle="tab"><span>Bước 2</span></a>
                                                    <span>Điền thông tin người dùng</span>
                                                </li>
                                                <li class="b3">
                                                    <a href="#buoc3" data-toggle="tab"><span>Bước 3</span></a>
                                                    <span>Điền thông tin hồ sơ</span>
                                                </li>
                                                <li class="b4">
                                                    <a href="#buoc4" data-toggle="tab"><span>Bước 4</span></a>
                                                    <span>Chọn file đính kèm</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="buoc1" role="tabpanel">
                                            <div class="row">
                                                <form id="form_b1">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <label  for="selMember" class="padding">Chọn đơn vị <span style="color:red">*</span> :</label>
                                                            </div>
                                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                                <select class="form-control" id="selMember" required>
                                                                    <option value="">-- Chọn đơn vị --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <label  for="selSta" class="padding">Chọn lĩnh vực <span style="color:red">*</span> :</label>
                                                            </div>
                                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                                <select class="form-control" id="selSta" required>
                                                                    <option value="">-- Chọn lĩnh vực --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <label  for="selType" class="padding">Chọn loại hồ sơ <span style="color:red">*</span> :</label>
                                                            </div>
                                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                                <select class="form-control" id="selType" required>
                                                                    <option value="">-- Chọn hồ sơ --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 margin-top-10px">
                                                        <button type="submit" class="btn btn-danger fl-right">Tiếp theo <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="buoc2" role="tabpanel">
                                            <div class="row">
                                                <form id="form_b2">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtName">Họ tên người nộp <span style="color:red">*</span>:</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="text" required placeholder="Nhập họ tên" class="form-control" name="txtName" id="txtName">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtPhone">Số điện thoại <span style="color:red">*</span>:</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input data-minlength="10" pattern="^[_0-9]{1,}$" type="text" required placeholder="Nhập số điện thoại" class="form-control" id="txtPhone" name="txtPhone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtCmt">Số CMT/Hộ chiếu :</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="text" placeholder="Nhập số CMT/Hộ chiếu" class="form-control" id="txtCmt" name="txtCmt">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtEmail">Email :</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="text" placeholder="Nhập Email" class="form-control" id="txtEmail" name="txtEmail">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtAddress">Địa chỉ <span style="color:red">*</span>:</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <textarea class="form-control" required placeholder="Nhập địa chỉ" rows="5" id="txtAddress" name="txtAddress"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-xs-10">
                                                                        <label class="padding" for="chkConfirm">Thông tin người nộp và chủ hồ sơ giống nhau</label>
                                                                    </div>
                                                                    <div class="col-xs-2">
                                                                        <input type="checkbox" id="chkConfirm" name="chkConfirm">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 margin-top-10px">
                                                        <button type="submit" class="btn btn-danger fl-right">Tiếp theo <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                        <button type="button" id='bt1Back' class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="buoc3" role="tabpanel">
                                            <div class="row">
                                                <form id="form_b3">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtNameHS">Họ tên người nộp <span style="color:red">*</span>:</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="text" placeholder="Nhập họ tên" class="form-control" id="txtNameHS" name="txtNameHS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtPhoneHS">Số điện thoại <span style="color:red">*</span>:</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="text" data-minlength="10" pattern="^[_0-9]{1,}$" placeholder="Nhập số điện thoại" class="form-control" id="txtPhoneHS" name="txtPhoneHS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtCmtHS">Số CMT/Hộ chiếu :</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="text" placeholder="Nhập số CMT/Hộ chiếu" class="form-control" id="txtCmtHS" name="txtCmtHS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtEmailHS">Email :</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <input type="email" placeholder="Nhập Email" class="form-control" id="txtEmailHS" name="txtEmailHS">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtAddressHS">Địa chỉ <span style="color:red">*</span>:</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <textarea placeholder="Nhập địa chỉ" class="form-control" rows="2" id="txtAddressHS" name="txtAddressHS"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="txtDescribeHS">Mô tả :</label>
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <textarea placeholder="Nhập mô tả" class="form-control" rows="2" id="txtDescribeHS" name="txtDescribeHS"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div clas="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="useSMS">Sử dụng dịch vụ SMS</label>
                                                                        <input type="checkbox" id="useSMS" name="useSMS">
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <label class="padding" for="usePostOffice">Nhận KQ hồ sơ qua bưu điện</label>
                                                                        <input type="checkbox" id="usePostOffice" name="usePostOffice">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 margin-top-10px">
                                                        <button type="submit" class="btn btn-danger fl-right">Tiếp theo <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                        <button type="button" id='bt2Back' class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="buoc4" role="tabpanel">
                                            <form id="form_b4">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="chkAll" name="chkAll"></th>
                                                                <th>STT</th>
                                                                <th>Tên giấy tờ</th>
                                                                <th>File đính kèm</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="checkbox" id="chk1" name="chk1"></td>
                                                                <td>1</td>
                                                                <td><label for="chk1">Sơ đồ tỷ lệ 1: 500 thể hiện rõ vị trí,diện tích, địa điểm khảo cổ cần khai quật</label></td>
                                                                <td>
                                                                    <label for="file-upload1" class="custom-file-upload">
                                                                        <i class="fa fa-cloud-upload"></i> Chọn file
                                                                    </label>
                                                                    <input id="file-upload1" type="file"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="checkbox" id="chk2" name="chk2"></td>
                                                                <td>2</td>
                                                                <td><label for="chk2">Văn bản đề nghị cấp phép khai quật khẩn cấp của tổ chức chủ trì thăm dò</label></td>
                                                                <td>
                                                                    <label for="file-upload2" class="custom-file-upload">
                                                                        <i class="fa fa-cloud-upload"></i> Chọn file
                                                                    </label>
                                                                    <input id="file-upload2" type="file"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="checkbox" id="chk3" name="chk3"></td>
                                                                <td>3</td>
                                                                <td><label for="chk3">Văn bản đề nghị cấp phép thăm dò, khai quật khảo cổ của tổ chức phối hợp</label></td>
                                                                <td>
                                                                    <label for="file-upload2" class="custom-file-upload">
                                                                        <i class="fa fa-cloud-upload"></i> Chọn file
                                                                    </label>
                                                                    <input id="file-upload2" type="file"/>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="padding fl-left">CÁC GIẤY TỜ KHÁC</label>
                                                        <label for="file-upload2" class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> Chọn file
                                                        </label>
                                                        <input id="file-upload2" type="file"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <textarea class="form-control" rows="5" id="txtAttach" name="txtAttach"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <?php

                                                                $publickey = _CONST_CLIENT_CAPTCHA_PUBLIC_KEY; // you got this from the signup page
                                                                echo recaptcha_get_html($publickey);
                                                                ?>
                                                                <span id="msg_error_captchar" class="msg_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 margin-top-10px">
                                                            <button type="submit" class="btn btn-danger fl-right" id="btnAddRecord">Nộp hồ sơ</button>
                                                            <button type="button" id='bt3Back' class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<style>
    .padding
    {
        padding:6px 12px;
    }
    .fl-right
    {
        float:right !important;
    }
    .fl-left
    {
        float:left;
    }
    #buoc4 table,th,td
    {
        border: 1px solid #ddd;
        border-collapse: collapse;
    }
    #buoc4 table
    {
        width:100%;
    }
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
    .margin-top-10px
    {
        margin-top: 10px;
    }
    .b1>span,.b2>span,.b3>span,.b4>span
    {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 16px;
        line-height: 1.42857143;
        color: #333;
        font-weight:bold;
    }
    .b1>a>span,.b2>a>span,.b3>a>span,.b4>a>span
    {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 13px;
        font-weight:bold;
    }
</style>
<?php

$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);
