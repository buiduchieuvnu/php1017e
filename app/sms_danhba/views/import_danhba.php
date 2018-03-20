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
            <h4>Import Danh bạ từ file Excel</h4>
        </div>
        <div class="panel-body">
            <div class="well">
                <div class="message" style="display:none;">
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <span class="alert-message"></span>
                    </div>
                </div>
				<div id="action-table">
					<div class="form">
						<div class="form-group">
							<label for="" class="control-label">Chọn file import: (<a href="<?php echo AppObject::getBaseFile('app/sms_danhba/helpers/Import_DanhBa.xlsx')?>">Tải file mẫu import học viên</a>)</label>
							<input type="file" name="import_file" id="import_file">
						</div>
						<button class="btn btn-xs btn-primary" id="btnImport">Import danh bạ</button>
					</div>
					<input type="hidden" id="uploaded_file" value="">
				</div>
                
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

        var ajaxUrl = "<?=AppObject::getBaseFile('app/sms_danhba/helpers/ajax.php')?>";

        $(document).on('click', '.btn', function(){
            $('.message .alert').removeClass('alert-success alert-danger');
            $('.message').hide();
        });
		
		$(document)
	.on('click', '.btn', function(){
		$('.message .alert').removeClass('alert-success alert-danger');
		$('.message').hide();
	})
	.on('click', '#btnImport', function(){
		var file = $('#import_file').prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file);
		form_data.append('act', 'import');
		$.ajax({
			url: ajaxUrl,
			type: 'post',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(response){
				console.log(response);
				var data = $.parseJSON(response);
				if (data.status == 'success') {
					alert('Import file thành công! Ấn Ok để chuyển về trang quản lý danh bạ.');
					window.location.replace("?app=sms_danhba&task=view_danhba");
				} else {
					alert('Import thất bại! Vui lòng kiểm tra lại file Import.');
					$('.alert-message').html(data.message);
					$('.message .alert').addClass('alert-' + data.status);
					$('.message').show();
				}
			}
		})
	})
	      
})(jQuery);
</script>