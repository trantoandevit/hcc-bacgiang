<!-- Modal -->
<div class="modal fade" id="myModalLookupRecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog md_tra_cuu">
        <div class="modal-content">
            <div class="modal-header mh_header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center tc_header" id="myModalLabel">Thông tin hồ sơ</h4>
            </div>
            <div class="modal-body">
                <div class="row loading" style="display: none; text-align: center">
                    <div class="col-lg-12">
                        <img src="<?php echo SITE_ROOT . 'public/images/loading.gif'?>">
                    </div>
                </div>
                <div class="not-found" style="display: none; text-align: center">
                    <h2>Xin lỗi, hệ thống không tìm thấy hồ sơ bạn yêu cầu!!!</h2>
                </div>
                <div class="record-info">
                    <div class="box_head">
                        <div class="clearfix ng-scope" ng-show="visibaleTTHS">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <label class="col-sm-3 control-label-bold">Tên TTHC:</label>
                                            <label class="col-md-9 tab_data record-type-name"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-5 control-label-bold">Số biên nhận:</label>
                                            <label class="col-md-6  tab_data record-code"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <label class="col-md-5 control-label-bold">Ngày tiếp nhận:</label>
                                            <label class="col-md-6  tab_data record-receive-date"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <label class="col-md-5 control-label-bold">Số ngày quy đinh:</label>
                                            <label class="col-md-6  tab_data record-day-require"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-5 control-label-bold">Người nộp:</label>
                                            <label class="col-md-6  tab_data record-submitter"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <label class="col-md-5 control-label-bold">Ngày hẹn trả:</label>
                                            <label class="col-md-6  tab_data record-return-date"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <label class="col-md-5 control-label-bold">Trạng thái:</label>
                                            <label class="col-md-6  tab_data record-status"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_th_content">
                        <div class='table-responsive'>
                            <table class="table table-striped table-bordered dataTable record-process-detail">
                                <thead>
                                    <tr>
                                        <th>
                                            <span>STT</span>
                                        </th>
                                        <th style="width:22%" class=" text-center">
                                            <span class="tab_data">Quy trình xử lý</span>
                                        </th>
                                        <th style="width:24%" class=" text-center">
                                            <span class="tab_data">Phòng ban xử lý</span>
                                        </th>
                                        <th style="width:16%" class=" text-center">
                                            <span class="tab_data">Cán bộ xử lý</span>
                                        </th>
                                        <th style="width:12%" class=" text-center">
                                            <span class="tab_data ">Thời gian quy định</span>
                                        </th>
                                        <th style="width:12%" class=" text-center">
                                            <span class="tab_data">Thời gian bắt đầu</span>
                                        </th>
                                        <th style="width:12%" class=" text-center">
                                            <span class="tab_data">Thời gian kết thúc</span>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>