<?php if (!defined('SERVER_ROOT')) exit('No direct script access allowed'); ?>
<?php
$VIEW_DATA['title'] = $this->website_name;

$VIEW_DATA['v_banner'] = $v_banner;
$VIEW_DATA['arr_all_website'] = $arr_all_website;
$VIEW_DATA['arr_all_menu_position'] = $arr_all_menu_position;

$VIEW_DATA['arr_css'] = array('tracuu_hs');
$VIEW_DATA['arr_script'] = array();

$this->render('dsp_header', $VIEW_DATA, $this->theme_code);
?>
<section>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="l_right">
                    <div class="lr_top">
                        <div class="lrt_head text-left">
                            <h3>Tra cứu hồ sơ</h3>
                        </div>
                        <div class="lrt_content">
                            <form action="" class="form">
                                <div class="row qrf_row">
                                    <label class="col-sm-2 control-label text-right">Tên chủ hồ sơ:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="" id="txt_tu_khoa">
                                    </div>
                                    <label class="col-sm-2 control-label text-right">Mã hồ sơ:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="" id="txt_tu_khoa">
                                    </div>
                                </div>
                                <div class="row qrf_row">
                                    <label class="col-sm-2 control-label text-right">Trạng thái</label>
                                    <div class="col-sm-4">
                                        <select class='form-control' id="sel_status">
                                            <option value="-1">--- Tất cả ---</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label text-right">Đơn vị thụ lý:</label>
                                    <div class="col-sm-4">
                                        <select class='form-control' id="sel_unit">
                                            <option value="-1">--- Tất cả ---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row qrf_row">
                                    <label class="col-sm-2 control-label text-right">Tiếp nhận từ ngày</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control"/>
                                    </div>
                                    <label class="col-sm-2 control-label text-right">Đến ngày</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control"/>
                                    </div>
                                </div>

                                <div class="row qrf_row">
                                    <div class="col-sm-12 text-right">
                                        <div class="btn_r_search">
                                            <button type="button" class="btn btn-primary qrf_row_btn" id="btn-search">Tìm kiếm <i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="lr_bottom">
                        <div class="row">
                            <div class="col-md-12 lrb_content">
                                <table class='table table-striped table-hover table-responsive table-bordered' id="table-list-tthc">
                                    <colgroup>
                                        <col width="3%"/>
                                        <col width="12%"/>
                                        <col width="15%"/>
                                        <col width="25%"/>
                                        <col width="15%"/>
                                        <col width="10%"/>
                                        <col width="10%"/>
                                        <col width="10%"/>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Mã hồ sơ</th>
                                            <th class="text-center">Tên hồ sơ</th>
                                            <th class="text-center">Tổ chức/công dân, địa chỉ</th>
                                            <th class="text-center">Cơ quan giải quyết</th>
                                            <th class="text-center">Ngày tiếp nhận</th>
                                            <th class="text-center">Ngày hẹn trả</th>
                                            <th class="text-center">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <colgroup>
                                        <col width="3%"/>
                                        <col width="12%"/>
                                        <col width="15%"/>
                                        <col width="25%"/>
                                        <col width="15%"/>
                                        <col width="10%"/>
                                        <col width="10%"/>
                                        <col width="10%"/>
                                    </colgroup>
                                    <tbody>
                                        <tr class="item">   
                                            <td class="text-center">1</td>   
                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   
                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td  class="text-center">29/10/2015</td>   
                                            <td  class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                        <tr class="item">   
                                            <td class="text-center">2</td>   

                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   

                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td  class="text-center">29/10/2015</td>   
                                            <td  class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                        <tr class="item">   
                                            <td class="text-center">3</td>   

                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   

                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td  class="text-center">29/10/2015</td>   
                                            <td  class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                        <tr class="item">   
                                            <td class="text-center">3</td>   

                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   

                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td  class="text-center">29/10/2015</td>   
                                            <td  class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                        <tr class="item">   
                                            <td class="text-center">3</td>   

                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   

                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td  class="text-center">29/10/2015</td>   
                                            <td  class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                        <tr class="item">   
                                            <td class="text-center">3</td>   

                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   

                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td class="text-center">29/10/2015</td>   
                                            <td  class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                        <tr class="item">   
                                            <td class="text-center">3</td>   

                                            <td><a href="javascript:void(0);" class="item-detail" data-id="" data-toggle="modal" data-target="#myModal">48577743883457</a></td>   

                                            <td>Xin phép thành lập hội</td>   
                                            <td>Lê Duy Khanh</td>    
                                            <td>Sở nội vụ</td>   
                                            <td class="text-center">29/10/2015</td>   
                                            <td class="text-center">6/11/2015</td>   
                                            <td>Đã trả kết quả</td>   
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right pag_bottom">
                                <ul class="list-unstyled list-inline ul_pag">
                                    <li><button class="btn btn-default action" value="first">Đầu</button></li>
                                    <li><button class="btn btn-default action" value="prev">Trước</button></li>
                                    <li><button class="btn btn-default item active" value="1">1</button></li>
                                    <li><button class="btn btn-default item" value="2">2</button></li>
                                    <li><button class="btn btn-default item" value="3">3</button></li>
                                    <li><button class="btn btn-default item" value="4">4</button></li>
                                    <li><button class="btn btn-default item" value="5">5</button></li>
                                    <li><button class="btn btn-default item" value="6">6</button></li>
                                    <li><button class="btn btn-default item" value="7">7</button></li>
                                    <li><button class="btn btn-default item" value="8">8</button></li>
                                    <li><button class="btn btn-default item" value="9">9</button></li>
                                    <li><button class="btn btn-default action" value="next">Sau</button></li>
                                    <li><button class="btn btn-default  action" value="last">Cuối</button></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog md_tra_cuu">
        <div class="modal-content">
            <div class="modal-header mh_header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <h4 class="modal-title text-center tc_header" id="myModalLabel">Thông tin hồ sơ</h4>
            </div>
            <div class="modal-body">
                <div class="row loading" style="display: none; text-align: center">
                    <div class="col-lg-12">
                        <img src="<?php echo SITE_ROOT . 'public/images/loading.gif' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 detail">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->render('dsp_footer', $VIEW_DATA, $this->theme_code);

