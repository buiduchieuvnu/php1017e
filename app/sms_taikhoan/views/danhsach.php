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

<div class="col-sm-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Quản lý tài khoản</h4>
        </div>
        <div class="panel-body">
            <div class="well row">
                <div class="col-md-12 ACTIONS">
                    <button class="btn btn-success" id="btnThemMoi"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
                    <button class="btn btn-success" id="btnLamMoi"><i class="glyphicon glyphicon-refresh"></i> Làm mới</button>
                    <div id="eccAlert"></div>
                </div>
            </div>
            <h3>Danh sách tài khoản</h3>
            <table class="table table-striped" id="tblDanhSach">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Tài khoản</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div> 

<!-- Ajax xu ly: Made by hieubd-->
<link rel="stylesheet" href="modules/IziModal/css/iziModal.min.css"/>
<script src="modules/IziModal/js/iziModal.min.js"></script>
<?php include_once AppObject::getBaseFile('modules/IziModal/IziModal_v1.php') ?>

<script src="app/sms_taikhoan/js/TAI_KHOAN.js"></script>
<script type="text/javascript">
    var CL = new CORE_LOG();
    var CA = new CORE_ALERT_2('#eccAlert');
    var CU = new CORE_UTILS();
    var TK = new TAI_KHOAN();
    
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
    
    function loadDanhSach(){
        TK.load_DANH_SACH();
        tblDanhSach.clear().draw();
        var aRows = [];
        for (var i = 0; i < TK.DANH_SACH.length; i++) {
            var _row = TK.DANH_SACH[i];
            var _html="";
            _html += "<div class=\"btn-group dropup\">";
            _html += "	<button aria-expanded=\"false\" data-toggle=\"dropdown\" class=\"btn btn-sm btn-warning dropdown-toggle waves-effect waves-light\" type=\"button\"><i class=\"fa fa-bars m-r-5\"><\/i><span class=\"caret\"><\/span><\/button>";
            _html += "	<ul role=\"menu\" class=\"dropdown-menu ACTIONS\">";
            _html += "		<li><a href=\"#\" data-id=\""+_row.id_user+"\" class=\"btnXoa\"><i class=\"glyphicon glyphicon-trash\"><\/i> Xóa<\/a><\/li>";
            _html += "		<li><a href=\"#\" data-id=\""+_row.id_user+"\" class=\"btnPhanQuyen\"><i class=\"glyphicon glyphicon-list\"><\/i> Phân quyền<\/a><\/li>";
            _html += "		<li><a href=\"#\" data-id=\""+_row.id_user+"\" class=\"btnSua\"><i class=\"glyphicon glyphicon-pencil\"><\/i> Sửa<\/a><\/li>";
            _html += "	<\/ul>";
            _html += "<\/div>";
            aRows.push([
                (i + 1), 
                _row.fullname,
                _row.username,
                _html
            ]);
        }
        tblDanhSach.rows.add(aRows).draw();

    }

    (function () {

        loadDanhSach();
        
        $('.ACTIONS').on('click','#btnLamMoi',function(){
            loadDanhSach();
            alert('Đã làm mới danh sách!');
        });
        
        $('.ACTIONS').on('click','#btnLamMoi',function(){
            loadDanhSach();
            alert('Đã làm mới danh sách!');
        });
        
        $('.ACTIONS').on('click','#btnThemMoi',function(){
            var _url = '?app=sms_taikhoan&view=chitiet&id=0';
            var _modal = new IZI_IFRAME_MODAL(_url,'Thêm tài khoản',900,400,loadDanhSach);
            _modal.openModal();
        });
        
        $('#tblDanhSach').on('click','.btnSua',function(){
            var _id = $(this).data('id');
            var _url = '?app=sms_taikhoan&view=chitiet&id=' + _id;
            var _modal = new IZI_IFRAME_MODAL(_url,'Sửa tài khoản',900,400,loadDanhSach);
            _modal.openModal();
        });
        
        $('#tblDanhSach').on('click','.btnXoa',function(){
            var _id = $(this).data('id');
            var _confirm = confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');
            if(_confirm){
                var _rs = TK.xoa(_id);
                CA.show(_rs.CODE, _rs.MSG);
                loadDanhSach();
            }
        });
        
        $('#tblDanhSach').on('click','.btnPhanQuyen',function(){
            var _id = $(this).data('id');
            var _url = '?app=sms_taikhoan&view=phan_quyen&id=' + _id;
            var _modal = new IZI_IFRAME_MODAL(_url,'Phân quyền nhắn tin',1200,600,loadDanhSach);
            _modal.openModal();
        });
    

    })(jQuery);
</script>