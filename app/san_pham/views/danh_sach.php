<link rel="stylesheet" href="libs/Datatables/dataTables.bootstrap.css">
<script src="libs/Datatables/jquery.dataTables.min.js"></script>
<script src="libs/Datatables/dataTables.bootstrap.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Danh mục sản phẩm</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12 well ACTIONS">
        <button type="button" class="btn btn-success" id="btnLamMoi"><i class="fa fa-rotate-left"></i> Làm mới</button> 
        <button type="button" class="btn btn-info" id="btnThemMoi"><i class="fa  fa-plus-circle"></i> Thêm sản phẩm mới</button>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách sản phẩm
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td>1</td>
                            <td>TVSS001</td>
                            <td>Smart Tivi SamSung 40 inch</td>
                            <td class="center">
                                <img src="upload/images/sanpham/tivi_1.png" alt="hinhanh" width="70" height="<50" />
                            </td>
                            <td>Smart ti vi</td>
                            <td class="center">
                                <div class="btn-group dropup">	
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	
                                    <ul role="menu" class="dropdown-menu">		
                                        <li><a href="#" class="btnXoa"><i class="fa fa-trash"></i> Xóa </a></li>
                                        <li><a href="#" class="btnKhoa"><i class="fa fa-lock"></i> Khóa</a></li>
                                        <li><a href="#"class="btnSua"><i class="fa fa-edit"></i> Sửa</a></li>
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
<?php include_once('modules/ecc_dialog/eccdialog.php'); ?>
<!-- /#modal -->
<script>
    var tblDanhSach = $('#tblDanhSach').DataTable({
        "paging": true,
        "autoWidth": false,
        "searching": true,
        "ordering": true,
        "language": {
            "decimal": "",
            "emptyTable": "Danh sách trống",
            "info": "Hiển thị _START_ đến _END_ trong _TOTAL_ kết quả",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Hiển thị _MENU_ kết quả",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "search": "Tìm kiếm nhanh: ",
            "zeroRecords": "No matching records found",
            "paginate": {
                "first": "Đầu ",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }

    });

    var Dialog = new ECC_DIALOG();

    function SanPham_bind() {
        var _gui = {};
        var request = $.ajax({
            url: "?app=san_pham&task=tim&view=ajax", // Địa chỉ file xử lý ajax request
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
            tblDanhSach.clear().draw();
            var aRows = [];
            
            for (var i = 0; i < DS.length; i++) {
                var _row = DS[i];
                var _tacvu = '';
                _tacvu += '<div class="btn-group dropup">';	
                _tacvu += '<button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	';
                _tacvu += '<ul role="menu" class="dropdown-menu">';		
                _tacvu += '<li><a href="#" class="btnXoa"><i class="fa fa-trash"></i> Xóa </a></li>';
                _tacvu += '<li><a href="#" class="btnKhoa"><i class="fa fa-lock"></i> Khóa</a></li>';
                _tacvu += '<li><a href="#"class="btnSua"><i class="fa fa-edit"></i> Sửa</a></li>';
                _tacvu += '</ul>';
                _tacvu += '</div>';
                var _hinhanh = '<img src="'+_row.hinh_anh+'" alt="hinhanh" width="70" height="<50" />';
                aRows.push([
                    (i + 1),
                    _row.ma_san_phan,
                    _row.ten_san_pham,
                    _hinhanh,
                    _row.ten_danh_muc,
                    _tacvu
                ]);

            }
            tblDanhSach.rows.add(aRows).draw();
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    $(function () {

        SanPham_bind();

        $('.ACTIONS').on('click', '#btnThemMoi', function () {
            Dialog.show('Thêm sản phẩm mới', '?app=san_pham&view=chi_tiet', '90%', '700', 'modModal');
        });
    });

</script>