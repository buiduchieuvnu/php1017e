<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh mục hàng hóa</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12 well">
        <button type="button" class="btn btn-success"><i class="fa fa-rotate-left"></i> Làm mới</button> 
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa  fa-plus-circle"></i> Thêm mới</button>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách danh mục hàng hóa
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã DM hàng</th>
                            <th>Tên DM hàng</th>
                            <th>Hình ảnh</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td>1</td>
                            <td>TIVI</td>
                            <td>Smart Tvi</td>
                            <td class="center">
                                <img src="" alt="hinhanh" width="70" height="50" />
                            </td>
                            <td class="center">
                                <div class="btn-group dropup">	
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	
                                    <ul role="menu" class="dropdown-menu">		
                                        <li><a href="#"><i class="fa fa-trash"></i> Xóa </a></li>
                                        <li><a href="#"><i class="fa fa-lock"></i> Khóa</a></li>
                                        <li><a href="#" data-id="20171219000037" class="btnSua"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Sửa</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- #modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-success modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thêm danh mục sản phẩm mới</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Danh mục hàng hóa</label>
                        <select class="form-control">
                            <option> Danh mục 1</option>
                            <option> Danh mục 2</option>
                            <option> Danh mục 3</option>
                            <option> Danh mục 4</option>
                            <option> Danh mục 5</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Mã dm sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Mã dm sản phẩm" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tên dm sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Tên dm sản phẩm" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputFile">Ảnh 1</label>
                        <input type="file">
                        <p class="help-block">Upload ảnh đại diện.</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputFile">Ảnh 2</label>
                        <input type="file">
                        <p class="help-block">Upload ảnh đại diện.</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputFile">Ảnh 3</label>
                        <input type="file">
                        <p class="help-block">Upload ảnh đại diện.</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputFile">Ảnh 4</label>
                        <input type="file">
                        <p class="help-block">Upload ảnh đại diện.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Thông tin khuyến mãi</label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Chính sách bảo hành</label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Thông số kỹ thuật</label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mô tả sản phẩm</label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"><i class="fa fa-rotate-left"></i> Làm mới</button>
                <button type="button" class="btn btn-warning"><i class="fa fa-save"></i> Lưu danh mục</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- /#modal -->
<script>

    function DmHang_find() {
        var _gui = {};
        var request = $.ajax({
            url: "?app=dm_hang&task=tim&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            var _html = "";
            for (var i = 0; i < DS.length; i++) {
                var sv = DS[i];
                _html += '<tr class="odd gradeX">';
                _html += '<td>' + (i + 1) + '</td>';
                _html += '<td>' + sv.ma_danh_muc + '</td>';
                _html += '<td>' + sv.ten_danh_muc + '</td>';
                _html += '<td class="center">';
                _html += '<img src="' + sv.hinh_anh + '" alt="hinhanh" width="70" height="50" />';
                _html += '</td>';
                _html += '<td class="center">';
                _html += '<div class="btn-group dropup">	';
                _html += '<button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	';
                _html += '<ul role="menu" class="dropdown-menu">		';
                _html += '<li><a href="#"><i class="fa fa-trash"></i> Xóa </a></li>';
                _html += '<li><a href="#"><i class="fa fa-lock"></i> Khóa</a></li>';
                _html += '<li><a href="#" data-id="20171219000037" class="btnSua"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Sửa</a></li>';
                _html += '</ul>';
                _html += '</div>';
                _html += '</td>';
                _html += '</tr>';
            }
            // Chèn dữ liệu vào bảng
            $('#tblDanhSach tbody').html(_html);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    $(function () {
        DmHang_find();
    });

</script>