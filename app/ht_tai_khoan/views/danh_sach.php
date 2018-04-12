<link rel="stylesheet" href="libs/Datatables/dataTables.bootstrap.css">
<script src="libs/Datatables/jquery.dataTables.min.js"></script>
<script src="libs/Datatables/dataTables.bootstrap.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Danh sách tài khoản</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12 well ACTIONS">
        <button type="button" class="btn btn-success" id="btnLamMoi"><i class="fa fa-rotate-left"></i> Làm mới</button> 
        <button type="button" class="btn btn-info" id="btnThemMoi"><i class="fa  fa-plus-circle"></i> Thêm mới</button>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tài khoản</th>
                            <th>Họ tên</th>
                            <th>Ngày đăng ký</th>
                            <th>Trạng thái</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td>1</td>
                            <td>admin</td>
                            <td>Trần Văn Nam</td>
                            <td class="center">2018-04-05 18:30:35</td>
                            <td>Kích hoạt</td>
                            <td class="center">
                                <div class="btn-group dropup">	
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	
                                    <ul role="menu" class="dropdown-menu">		
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

    function DanhSach_bind() {
        var _gui = {};
        var request = $.ajax({
            url: "?app=ht_tai_khoan&task=tim&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            tblDanhSach.clear().draw();
            var aRows = [];
            for (var i = 0; i < DS.length; i++) {
                var _row = DS[i];
                var _tacvu = '';
                var _nut = _row.trang_thai=='A'?'Khóa':'Mở khóa';
                _tacvu += '<div class="btn-group dropup">';	
                _tacvu += '<button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-bars m-r-5"></i><span class="caret"></span></button>	';
                _tacvu += '<ul role="menu" class="dropdown-menu">';		
                _tacvu += '<li><a href="#" data-id="'+_row.id_tai_khoan+'" class="btnKhoa"><i class="fa fa-lock"></i> '+_nut+'</a></li>';
                _tacvu += '<li><a href="#" data-id="'+_row.id_tai_khoan+'" class="btnSua" ><i class="fa fa-edit"></i> Sửa</a></li>';
                _tacvu += '</ul>';
                _tacvu += '</div>';
                aRows.push([
                    (i + 1),
                    _row.tai_khoan,
                    _row.ho_ten,
                    _row.ngay_dang_ky,
                    _row.trang_thai=='A'?'Kích hoạt':'Khóa',
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
    
    function khoa(id){
        var _gui = {
            id_tai_khoan:id,
            trang_thai:'D'
        };
        var request = $.ajax({
            url: "?app=ht_tai_khoan&task=khoa&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            if(DS[0].ma=='00000'){
                alert('Khóa / mở khóa thành công!');
            }else{
                alert('Khóa / mở khóa thất bại!');
            }
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    $(function () {
        DanhSach_bind();


        $('.ACTIONS').on('click', '#btnThemMoi', function () {
            Dialog.show('Thêm tài khoản mới', '?app=ht_tai_khoan&view=chi_tiet', '70%', '400', 'modModal',DanhSach_bind);
        });
        
        $('.ACTIONS').on('click', '#btnLamMoi', function () {
            DanhSach_bind();
        });
        
        $('#tblDanhSach').on('click', '.btnSua', function () {
            var id = $(this).data('id');
            Dialog.show('Sửa thông tin tài khoản', '?app=ht_tai_khoan&view=chi_tiet&id=' + id, '70%', '400', 'modModal',DanhSach_bind);
        });
        
        $('#tblDanhSach').on('click', '.btnKhoa', function () {
            var id = $(this).data('id');
            if(confirm('Bạn có chắc chắn muốn khóa hay không?')){
                khoa(id);
                DanhSach_bind();
            }
            
        });
    });

</script>