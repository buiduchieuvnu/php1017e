<?php
if (!defined('AREA')) {
    die('Access denied');
}
// echo "<h1>Test</h1>";
// print_r($this->lsLichSuSMS);
?>
<link rel="stylesheet" href="<?= AppObject::getBaseFile('libs/datatable2/dataTables.bootstrap.css') ?>">
<script src="<?= AppObject::getBaseFile('libs/datatable2/jquery.dataTables.min.js') ?>"></script>
<script src="<?= AppObject::getBaseFile('libs/datatable2/dataTables.bootstrap.js') ?>"></script>
<script src="<?= AppObject::getBaseFile('libs/datatable2/fnAddTr.js') ?>"></script>

<script src="<?php echo AppObject::getBaseFile('libs/multi_select/bootstrap_multiselect.js') ?>"></script>
<div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Tìm kiếm</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" id="form_filter" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">Người gửi:</label>
                    <div class="col-sm-8">
                        <select name="filter_course" id="filter_course" class="form-control input-sm select_filter">
                            <option value=""><?= $_SESSION["auth"]['username'];?></option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">Trạng thái:</label>
                    <div class="col-sm-8">
                        <select name="filter_group_field" id="filter_group_field" class="form-control input-sm select_filter">
                            <option value="">-- Tất cả --</option>
                            <option value="1">Đã gửi</option>
                            <option value="2">Đang chờ gửi</option>
                            <option value="3">Đang chờ duyệt</option>
                            <option value="4">Hủy</option>
                            <option value="5">Lỗi</option>

                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Nhắn tin theo nhóm</h4>
        </div>
        <div class="panel-body">
            <div class="well">
                <div class="message" style="display:none;">
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <span class="alert-message"></span>
                    </div>
                </div>
                <table id="action-table" class="table">
                    <tr>
                        <td>
                            <label>Nguồn gửi tin</label>
                            <input type="text" id="USERNAME" class="form-control" value="<?= $_SESSION["auth"]['username'];?>" readonly="true" />
                            <input type="hidden" id="ID_USER" value="<?= $_SESSION["auth"]['id_user'];?>" />
                        </td>
                        <td>
                            <!-- <input type="text" id="txtContact" class="form-control input-md" placeholder="Nhập số điện thoại cần gửi" /> -->
                            <label>Nhóm danh bạ</label>
                            <select id="selDanhBa" class="form-control input-sm select_filter">
                                <option value="-1">-- Chọn nhóm danh bạ --</option>
                                <?php foreach ($this->lsNhomDanhBa as $key => $value) { ?>
                                    <option value="<?= $value['id_nhom_danhba'] ?>"><?= $value['ten'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" id="hdfNhomContact" value="";/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Danh sách gửi:</p>
                            <textarea class="form-control" id="txtDanhBaNhom" cols="50" rows="4"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" id="txtContent" class="form-control input-md" placeholder="Nhập số nội dung cần gửi" />

                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="5">
                            <button class="btn btn-success btnSendSMS"><i class="glyphicon glyphicon-plus-sign"></i> Gửi tin</button>
                            <button class="btn btn-danger btnCancel" ><i class="glyphicon glyphicon-remove"></i> Hủy gửi</button>
                        </td>
                    </tr>
                </table>
            </div>
            <h3>Lịch sử tin nhắn</h3>
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người nhắn</th>
                        <th>Thời gian</th>
                        <th>Số gửi</th>
                        <th>Số nhận</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($this->lsLichSuSMS as $item) {
                        $i++;
                        ?>
                        <tr id="class_<?= $item['id_lichsu_sms'] ?>">
                            <td class="number"><?= $i ?></td>
                            <td class="class_name"><?= $item['nguoi_nhan'] ?></td>
                            <td class="class_code"><?= $item['thoi_gian'] ?></td>
                            <td class="id_course"><?= $item['so_di'] ?></td>
                            <td class="id_group_field"><?= $item['so_den'] ?></td>
                            <td class="id_group_field"><?= $item['noi_dung'] ?></td>
                            <td class="id_group_field"><?= $item['trang_thai'] ?></td>
                            <td>
                                <input type="hidden" name="control_str" class="control_str" 
                                       value="<?= $item['id_lichsu_sms'] ?>">
                                <button class="btn btn-xs btn-warning editBtn" data-id="<?= $item['id_lichsu_sms'] ?>"><i class="glyphicon glyphicon-pencil"></i> Sửa</button> 
                                <button class="btn btn-xs btn-danger deleteBtn" data-id="<?= $item['id_lichsu_sms'] ?>"><i class="glyphicon glyphicon-remove"></i> Xóa</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Ajax xu ly: Made by Duyld2108-->
<script type="text/javascript">


    (function () {
        var SendContact = ['0944591392'];
        var oTable = $('#datatable').DataTable({
            ordering: false,
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                //                var index = iDisplayIndex +1;
                //                $('td:eq(0)',nRow).html(index);
            }
        });

        var ajaxUrl = "<?= AppObject::getBaseFile('app/tinnhan/helpers/ajax.php') ?>";

        // Bắt sự kiện thay đổi điều kiện lọc trên #form_filter
        $('#action-table').on('change', '#selDanhBa', function () {
            var _id_nhom_danhba = $('#selDanhBa').val();
            $.post(ajaxUrl, {act: 'get_nhom', id_nhom_danhba: _id_nhom_danhba}, function (data) {
                console.log(data)
                var data = $.parseJSON(data);
                if (data.status === 'success') {
                    console.log(data.returndata);
                    SendContact = ['0944591392'];
                    var _thongtin = '';
                    for (var i = 0; i < data.returndata.length; i++) {
                        var _ct = data.returndata[i];
                        SendContact.push(_ct.so_dien_thoai);
                        _thongtin += '[' + _ct.ho_ten + ': ' + _ct.so_dien_thoai + '],';


                    }

                    $('#txtDanhBaNhom').html(_thongtin);
                    console.log(SendContact);
                }
            });
        });

        $(document).on('click', '.btn', function () {
            $('.message .alert').removeClass('alert-success alert-danger');
            $('.message').hide();
        });

        // Gửi tin nhắn
        $('#action-table').on('click', '.btnSendSMS', function () {
            var _contact = $('#selDanhBa').val();
            var _content = $('#txtContent').val();
            console.log(_contact + '----------' + _content);
            if (SendContact.length <= 1) {
                alert('Không được để trống số gửi đi!');
                $('#selDanhBa').focus();
                return;
            }

            if (_content == '') {
                alert('Không được để trống nội dung gửi!');
                $('#txtContent').focus();
                return;
            }
            for (var i = 0; i < SendContact.length; i++) {
                var _ct = SendContact[i];
                var _num_suc = 0;
                var _num_err = 0;
                var _data = '?Phone=' + _ct + '&Content=' + _content + '&ApiKey=B3F5FC4CC184BC7F20E798C38D83EA&SecretKey=51380F85691CA7A421B032813414D0&SmsType=4';
                var _url = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get' + _data;

                $.post(ajaxUrl, {act: 'add', so_den: _ct, noi_dung: _content}, function (data) {
                    console.log(data);
                });

                $.get(_url, function (data, status) {
                    console.log('data:', data);
                    console.log('status:', status);
                    if (status != 'success') {
                        _num_err++;
                    }

                    if (data.CodeResult == '100') {
                        _num_suc++;
                    } else {
                        _num_err++;
                    }
                });
            }

            alert("Đã xử lý xong tác vụ gửi tin nhắn theo nhóm. Thành công: " + _num_suc + ", thất bại: " + _num_err);
            location.reload();
        });


    })(jQuery);
</script>