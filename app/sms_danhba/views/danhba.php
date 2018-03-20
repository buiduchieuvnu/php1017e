<?php
if (!defined('AREA')) {
    die('Access denied');
}
// echo "<h1>Test</h1>";
// print_r($this->lsLichSuSMS);
?>
<link rel="stylesheet" href="<?php echo AppObject::getBaseFile('app/class/css/dataTables.bootstrap.css') ?>">
<link rel="stylesheet" href="<?php echo AppObject::getBaseFile('app/class/css/class_style.css') ?>">
<script src="<?php echo AppObject::getBaseFile('app/class/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/class/js/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/class/js/fnAddTr.js') ?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/class/js/scripts.js') ?>"></script>
<div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Tìm kiếm</h4>
        </div>
        <div class="panel-body">
            <form class="form role="form" id="form_filter" >
                  <div class="form-group">
                    <label for="" class="col-sm-4 control-label">Tìm tên nhóm:</label>
                    <div class="col-sm-8">
                        <input type="text" id="txtSearchTenNhom" class="form-control input-md" placeholder="Tên nhóm" />
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="col-sm-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Cập nhật Danh bạ</h4>
        </div>
        <div class="panel-body">
            <div class="well">
                <div class="message" style="display:none;">
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <span class="alert-message"></span>
                    </div>
                </div>
                <table id="action-table" class="table form">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Họ tên:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="txtHoTen" class="form-control input-md" placeholder="Họ tên" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Số điện thoại:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="txtSoDienThoai" class="form-control input-md" placeholder="Số điện thoại" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Email:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="txtEmail" class="form-control input-md" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Địa chỉ:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="txtDiaChi" class="form-control input-md" placeholder="Địa chỉ" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label">Ghi chú:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="txtGhiChu" class="form-control input-md" placeholder="Ghi chú" />
                                </div>
                            </div>
                        </td>

                        <td>
                            <button class="btn btn-success btnLuu"><i class="glyphicon glyphicon-plus-sign"></i> Lưu </button>
                            <button class="btn btn-danger btnXoa" ><i class="glyphicon glyphicon-trash"></i> Xóa </button>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Danh sách</h4>
        </div>
        <div class="panel-body">
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($this->ListItems as $item) {
                        $i++;
                        ?>
                        <tr id="class_<?= $item['id_nhom_danhba'] ?>">
                            <td class="number"><?= $i ?></td>
                            <td class="class_name"><?= $item['ho_ten'] ?></td>
                            <td class="class_name"><?= $item['so_dien_thoai'] ?></td>
                            <td class="class_name"><?= $item['email'] ?></td>
                            <td class="class_name"><?= $item['diachi'] ?></td>
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

    <!-- Ajax xu ly: Made by Duyld2108-->
    <script type="text/javascript">

        (function () {
            var oTable = $('#datatable').DataTable({
                ordering: false,
                fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //                var index = iDisplayIndex +1;
                    //                $('td:eq(0)',nRow).html(index);
                }
            });

            var ajaxUrl = "<?= AppObject::getBaseFile('app/sms_danhba/helpers/ajax.php') ?>";

            $(document).on('click', '.btn', function () {
                $('.message .alert').removeClass('alert-success alert-danger');
                $('.message').hide();
            });

            // Edit
            $('#datatable').on('click', '.editBtn', function () {

                var editData = $(this).parent('td').find('.control_str').val();
                var editData = editData.split(';');
                $('#class_id').val(editData[0]);
                $('#class_name').val(editData[1]);
                $('#class_name_en').val(editData[2]);
                $('#class_code').val(editData[3]);
                $('#id_course').val(editData[4]);
                $('#id_group_field').val(editData[5]);
                $('.addnewBtn').hide();
                $('.updateBtn').show();
                $('.cancelBtn').show();
            });

            // Delete
            $('#datatable').on('click', '.deleteBtn', function () {
                if (confirm("Bạn có chắc chắn xóa mục được chọn không? Lưu ý: Mục đã xóa không thể phục hồi!") == false)
                    return false;
                else {
                    var id = $(this).attr('data-id');
                    $.post(ajaxUrl, {act: 'delete', id: id}, function (data) {
                        if (data == 'success') {
                            oTable.row('#class_' + id).remove().draw(false);
                            $('.alert-message').html('Xoá dữ liệu thành công');
                            $('.message .alert').addClass('alert-success');
                            $('.message').show();
                        }
                        ;
                    });
                }
            });

            // Addnew
            $('#action-table').on('click', '.btnLuu', function () {
                var _ho_ten = $('#txtHoTen').val();
                var _so_dien_thoai = $('#txtSoDienThoai').val();
                var _email = $('#txtEmail').val();
                var _diachi = $('#txtDiaChi').val();
                if (_ho_ten == '') {
                    alert('Không được để trống họ tên!');
                    $('#txtHoTen').focus();
                    return;
                }

                if (_so_dien_thoai == '') {
                    alert('Không được để trống số điện thoại!');
                    $('#txtSoDienThoai').focus();
                    return;
                }

                if (_email == '') {
                    alert('Không được để trống email!');
                    $('#txtEmail').focus();
                    return;
                }

                if (_diachi == '') {
                    alert('Không được để trống địa chỉ!');
                    $('#txtDiaChi').focus();
                    return;
                }

                $.post(ajaxUrl,
                        {
                            act: 'add',
                            ho_ten: _ho_ten,
                            so_dien_thoai: _so_dien_thoai,
                            email: _email,
                            diachi: _diachi
                        }, function (data) {
                    console.log(data)
                    var data = $.parseJSON(data);
                    if (data.status == 'success') {
                        alert('Lưu danh bạ thành công!');
                        location.reload();
                    } else {
                        alert('Lưu danh bạ thất bại!');
                    }
                });


            });

            // Update
            $('#action-table').on('click', '.updateBtn', function () {
                var id = $('#class_id').val();
                var class_name = $('#class_name').val();
                var class_name_en = $('#class_name_en').val();
                var class_code = $('#class_code').val();
                var id_course = $('#id_course').val();
                var id_group_field = $('#id_group_field').val();
                $.post(ajaxUrl, {act: 'update', class_name: class_name, class_name_en: class_name_en, class_code: class_code, id_course: id_course, id_group_field: id_group_field, id: id}, function (data) {
                    var data = $.parseJSON(data);
                    $('.alert-message').html(data.message);
                    $('.message .alert').addClass('alert-' + data.status);
                    $('.message').show();
                    if (data.status == 'success') {
                        var control_str = data.returndata;
                        var tmp = control_str.split(';');
                        $('#class_' + tmp[0] + ' .class_name').html(tmp[1]);
                        $('#class_' + tmp[0] + ' .class_code').html(tmp[3]);
                        $('#class_' + tmp[0] + ' .id_course').html(tmp[6]);
                        $('#class_' + tmp[0] + ' .id_group_field').html(tmp[7]);
                        $('#class_' + tmp[0] + ' .control_str').val(control_str);
                        $('#action-table').find('input, select').val("");
                        $('.updateBtn').hide();
                        $('.cancelBtn').hide();
                        $('.addnewBtn').show();
                    }
                });
            });

            // Cancel
            $('#action-table').on('click', '.cancelBtn', function () {
                $('#action-table').find('input, select').val("");
                $('.updateBtn').hide();
                $('.cancelBtn').hide();
                $('.addnewBtn').show();
            });

            // Bắt sự kiện thay đổi điều kiện lọc trên #form_filter
            $('#form_filter').on('change', '.select_filter', function () {
                $('#str_filter').val($('#filter_course').val() + ";" + $('#filter_group_field').val() + ";" + $('#filter_group_field').val())
                var id_course = $('#filter_course').val();
                var id_group_field = $('#filter_group_field').val();
                $.post(ajaxUrl, {act: 'loadtable', id_course: id_course, id_group_field: id_group_field}, function (data) {
                    var data = $.parseJSON(data);
                    $('.alert-message').html(data.message);
                    $('.message .alert').addClass('alert-' + data.status);
                    $('.message').show();

                    var str_data = data.returndata;
                    var row = str_data.split('#');
                    // Xóa toàn bộ dòng và refresh datatable
                    $('#datatable').DataTable().clear().draw();
                    var i = 0;
                    $.each(row, function (key, value) {
                        i++
                        var tmp = value.split(';');
                        if (tmp[0] != null && tmp[0] != "") {
                            r = '<tr id="class_' + tmp[0] + '">' +
                                    '<td class="number">' + i + '</td>' +
                                    '<td class="class_name">' + tmp[1] + '</td>' +
                                    '<td class="class_code">' + tmp[3] + '</td>' +
                                    '<td class="id_course">' + tmp[6] + '</td>' +
                                    '<td class="id_group_field">' + tmp[7] + '</td>' +
                                    '<td><input type="hidden" name="control_str" class="control_str" value="' + value + '">' +
                                    '<button class="btn btn-xs btn-warning editBtn" data-id="' + tmp[0] + '"><i class="glyphicon glyphicon-pencil"></i> Sửa</button> ' +
                                    '<button class="btn btn-xs btn-danger deleteBtn" data-id="' + tmp[0] + '"><i class="glyphicon glyphicon-remove"></i> Xóa</button></td>' +
                                    '</tr>';
                            $('#datatable').dataTable().fnAddTr($(r)[0]);
                        } else
                            $('#datatable').DataTable().draw();
                    })
                });
            })
        })(jQuery);
    </script>