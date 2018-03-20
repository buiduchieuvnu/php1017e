<?php 
if ( !defined('AREA') ) {
    die('Access denied');
	
}
// echo "<h1>Test</h1>";
	// print_r($this->lsLichSuSMS);
?>
<link rel="stylesheet" href="<?php echo AppObject::getBaseFile('app/class/css/dataTables.bootstrap.css')?>">
<link rel="stylesheet" href="<?php echo AppObject::getBaseFile('app/class/css/class_style.css')?>">
<script src="<?php echo AppObject::getBaseFile('app/class/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/class/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/class/js/fnAddTr.js')?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/class/js/scripts.js')?>"></script>
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
                            <option value="">-- Tất cả --</option>
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
            <h4>Cập nhật tin nhắn mẫu</h4>
        </div>
        <div class="panel-body">
            <div class="well">
                <div class="message" style="display:none;">
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <span class="alert-message"></span>
                    </div>
                </div>
                <div class="form" id="action-table">
					<div class="form-group">
                        <label for="" class="col-sm-4 control-label">Nhóm mẫu:</label>
                        <div class="col-sm-8">
                            <select name="filter_group_field" id="filter_group_field" class="form-control input-sm select_filter">
                            <option value="">-- Tất cả --</option>
                            <option value="1">Thông báo họp</option>
							<option value="2">Thông báo điểm</option>
							<option value="3">Chúc mừng sinh nhật</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Tên mẫu tin nhắn:</label>
                        <div class="col-sm-8">
                            <input type="text" id="txtTenMau" class="form-control input-md" placeholder="Tên mẫu" />
                        </div>
                    </div>
					<div class="form-group">
                        <label for="" class="col-sm-4 control-label">Nội dung tin nhắn mẫu:</label>
                        <div class="col-sm-8">
                            <input type="text" id="txtTinMau" class="form-control input-md" placeholder="Nội dung tin mẫu" />
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btnSendSMS"><i class="glyphicon glyphicon-plus-sign"></i> Lưu </button>
                        <button class="btn btn-danger btnCancel" ><i class="glyphicon glyphicon-remove"></i> Xóa</button>
                    </div>
                </div>
                <table id="action-table" class="table">
                    <tr>
                        <td>
                            <select name="id_course" id="id_course" class="form-control input-md">
                                <option value="">-- Chọn nhóm --</option>
                                <option value="1">Admin</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="txtContact" class="form-control input-md" placeholder="Nhập số điện thoại cần gửi" />
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
			<h3>Lịch sử gửi tin</h3>
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
                    <tr id="class_<?=$item['id_lichsu_sms']?>">
                        <td class="number"><?=$i?></td>
                        <td class="class_name"><?=$item['nguoi_nhan']?></td>
                        <td class="class_code"><?=$item['thoi_gian']?></td>
                        <td class="id_course"><?=$item['so_di']?></td>
                        <td class="id_group_field"><?=$item['so_den']?></td>
						<td class="id_group_field"><?=$item['noi_dung']?></td>
						<td class="id_group_field"><?=$item['trang_thai']?></td>
                        <td>
                            <input type="hidden" name="control_str" class="control_str" 
                                   value="<?=$item['id_lichsu_sms']?>">
                            <button class="btn btn-xs btn-warning editBtn" data-id="<?=$item['id_lichsu_sms']?>"><i class="glyphicon glyphicon-pencil"></i> Sửa</button> 
                            <button class="btn btn-xs btn-danger deleteBtn" data-id="<?=$item['id_lichsu_sms']?>"><i class="glyphicon glyphicon-remove"></i> Xóa</button>
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

    (function(){
        var oTable = $('#datatable').DataTable({
            ordering: false,
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
                //                var index = iDisplayIndex +1;
                //                $('td:eq(0)',nRow).html(index);
            }
        });

        var ajaxUrl = "<?=AppObject::getBaseFile('app/tinnhan/helpers/ajax.php')?>";

        $(document).on('click', '.btn', function(){
            $('.message .alert').removeClass('alert-success alert-danger');
            $('.message').hide();
        });

        // Edit
        $('#datatable').on('click', '.editBtn', function() {

            var editData = $(this).parent('td').find('.control_str').val();
            var editData = editData.split(';');
            $('#class_id').val(editData[0]);
            $('#class_name').val(editData[1]);
            $('#class_name_en').val(editData[2]);
            $('#class_code').val(editData[3]);
            $('#id_course').val(editData[4]);
            $('#id_group_field').val(editData[5]);
            $('.addnewBtn').hide();$('.updateBtn').show();$('.cancelBtn').show();
        });

        // Delete
        $('#datatable').on('click', '.deleteBtn', function() {
            if(confirm("Bạn có chắc chắn xóa mục được chọn không? Lưu ý: Mục đã xóa không thể phục hồi!") == false)
                return false;
            else{
                var id = $(this).attr('data-id');
                $.post(ajaxUrl, {act: 'delete', id: id}, function(data) {
                    if (data == 'success') {
                        oTable.row('#class_' + id).remove().draw(false);
                        $('.alert-message').html('Xoá dữ liệu thành công');
                        $('.message .alert').addClass('alert-success');
                        $('.message').show();
                    };
                });
            }
        });

        // Addnew
        $('#action-table').on('click', '.btnSendSMS', function() {
            var _contact = $('#txtContact').val();
			var _content = $('#txtContent').val();
			console.log(_contact + '----------' + _content);
			if(_contact == ''){
				alert('Không được để trống số gửi đi!');
				$('#txtContact').focus();
				return;
			}
			
			if(_content == ''){
				alert('Không được để trống nội dung gửi!');
				$('#txtContent').focus();
				return;
			}
			var _data = '?Phone=' + _contact + '&Content='+ _content +'&ApiKey=B3F5FC4CC184BC7F20E798C38D83EA&SecretKey=51380F85691CA7A421B032813414D0&SmsType=4';
			var _url = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get' +  _data;
			
			$.post(ajaxUrl, {act: 'add',so_den: _contact, noi_dung:_content}, function(data) {
				console.log(data)
				var data = $.parseJSON(data);
				if (data.status == 'success') {
					alert('Đang tiến hành xử lý tin nhắn!');
				}
			});
			
			$.get(_url, function(data, status){
				console.log('data:',data);
				console.log('status:',status);
				if(status!='success'){
					alert('Có lỗi trong quá trình xử lý!');
					return;
				}
				
				if(data.CodeResult=='100'){
					alert('Gửi thành công!');
					return;
				}else{
					alert('Gửi thất bại! Lỗi: ' + data.ErrorMessage);
				}
			});
        });

        // Update
        $('#action-table').on('click', '.updateBtn', function() {
            var id = $('#class_id').val();
            var class_name = $('#class_name').val();
            var class_name_en = $('#class_name_en').val();
            var class_code = $('#class_code').val();
            var id_course = $('#id_course').val();
            var id_group_field = $('#id_group_field').val();
            $.post(ajaxUrl, {act: 'update', class_name: class_name,class_name_en: class_name_en, class_code: class_code, id_course:id_course, id_group_field:id_group_field, id: id}, function(data) {
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
                    $('.updateBtn').hide();$('.cancelBtn').hide();$('.addnewBtn').show();
                }
            });
        });

        // Cancel
        $('#action-table').on('click', '.cancelBtn', function() {
            $('#action-table').find('input, select').val("");
            $('.updateBtn').hide();$('.cancelBtn').hide();$('.addnewBtn').show();
        });

        // Bắt sự kiện thay đổi điều kiện lọc trên #form_filter
        $('#form_filter').on('change','.select_filter', function(){
            $('#str_filter').val($('#filter_course').val()+";"+$('#filter_group_field').val()+";"+$('#filter_group_field').val())
            var id_course = $('#filter_course').val();
            var id_group_field = $('#filter_group_field').val();
            $.post(ajaxUrl, {act: 'loadtable', id_course:id_course, id_group_field:id_group_field}, function(data) {
                var data = $.parseJSON(data);
                $('.alert-message').html(data.message);
                $('.message .alert').addClass('alert-' + data.status);
                $('.message').show();

                var str_data = data.returndata;
                var row = str_data.split('#');
                // Xóa toàn bộ dòng và refresh datatable
                $('#datatable').DataTable().clear().draw();
                var i=0;
                $.each(row,function(key,value){
                    i++
                    var tmp = value.split(';');
                    if(tmp[0]!=null&&tmp[0]!=""){
                        r = '<tr id="class_' + tmp[0] + '">'+
                            '<td class="number">'+i+'</td>'+
                            '<td class="class_name">' + tmp[1] + '</td>'+
                            '<td class="class_code">' + tmp[3] + '</td>'+
                            '<td class="id_course">' + tmp[6] + '</td>'+
                            '<td class="id_group_field">' + tmp[7] + '</td>'+
                            '<td><input type="hidden" name="control_str" class="control_str" value="' + value + '">'+
                            '<button class="btn btn-xs btn-warning editBtn" data-id="' + tmp[0] + '"><i class="glyphicon glyphicon-pencil"></i> Sửa</button> '+
                            '<button class="btn btn-xs btn-danger deleteBtn" data-id="' + tmp[0] + '"><i class="glyphicon glyphicon-remove"></i> Xóa</button></td>'+
                            '</tr>';
                        $('#datatable').dataTable().fnAddTr($(r)[0]);
                    }else
                        $('#datatable').DataTable().draw();
                })
            });
        })
    })(jQuery);
</script>