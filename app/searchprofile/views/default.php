<?php
if ( !defined('AREA') ) {
    die('Access denied');

}
?>
<link rel="stylesheet" href="<?php echo AppObject::getBaseFile('app/major/css/dataTables.bootstrap.css')?>">

<script src="<?php echo AppObject::getBaseFile('app/major/js/plugins/dataTables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/major/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/major/js/plugins/dataTables/fnAddTr.js')?>"></script>
<script src="<?php echo AppObject::getBaseFile('app/major/js/scripts.js')?>"></script>
<div class="col-sm-3">
	<div class="well">
		<div class="form" role="form" id="filter">
			<form action="" method="post" class="form">
				<div class="input-group">
	                <input type="text" class="form-control" placeholder="Tìm theo tên, mã học viên" name="q">
	                <div class="input-group-btn">
	                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
	                </div>
	            </div>
			</form>
			<hr>
			<div class="form-group">
				<h4>Tìm theo bộ lọc:</h4>
				<label for="" class="control-label">Khóa:</label>
				<select name="filter_course" id="filter_course" class="form-control input-sm filter">
					<option value="">-- Tất cả --</option>
					<?php foreach ($this->courses as $key => $value) { ?>
					<option value="<?=$key?>"><?=$value?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Ngành:</label>
				<select name="filter_group_field" id="filter_group_field" class="form-control input-sm filter">
					<option value="">-- Tất cả --</option>
					<?php foreach ($this->group_fields as $key => $value) { ?>
					<option value="<?=$key?>"><?=$value?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Lớp:</label>
				<select name="filter_class" id="filter_class" class="form-control input-sm">
					<option value="">-- Tất cả --</option>
					<?php foreach ($this->classes as $key => $value) { ?>
					<option value="<?=$key?>" class="class_options"><?=$value?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>

<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Tra cứu hồ sơ học viên</h4>
		</div>
		<div class="panel-body">
			<table class="table table-striped" id="datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>Họ và tên</th>
						<th>Mã học viên</th>
						<th>Ngày sinh</th>
						<th>Giới tính</th>
						<th>Nơi sinh</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					foreach ($this->profiles as $item): ?>
					<tr>
						<td><?=$i++?></td>
						<td><?=$item->last_name?> <?=$item->first_name?></td>
						<td><?=$item->student_code?></td>
						<td><?=$item->birthday?></td>
						<td><?=$item->sex == 1 ? 'Nam' : 'Nữ'?></td>
						<td>
							<?=$this->provices[$item->birth_place]?>
						</td>
						<td>
							<button class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open"></i> Xem</button>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<button class="btn btn-sm btn-primary">Import danh sách</button>
		</div>
	</div>
</div>