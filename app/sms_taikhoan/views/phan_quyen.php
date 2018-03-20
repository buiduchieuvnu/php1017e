<?php
if (!defined('AREA')) {
    die('Access denied');
}
?>
<div class="popup">
    <div class="well row">
        <div class="col-md-3 form-group">
            <label>Họ và tên:</label>
            <input type="text" class="form-control" id="FULLNAME"  readonly="true" />
        </div>
        <div class="col-md-3 form-group">
            <label>Tài khoản:</label>
            <input type="text" class="form-control" id="USERNAME" readonly="true"/>
        </div>
        
        <div class="col-md-3 form-group">
            <label>Thêm nhóm danh bạ:</label>
            <select id="ID_NHOM_DANHBA" class="form-control">
                <option value="0">Thêm nhóm</option>
            </select>
        </div>
        
        <div class="col-md-12 ACTIONS">
            <input  type="hidden" id="ID_USER" />
            <button class="btn btn-success" id="btnThem"><i class="glyphicon glyphicon-plus"></i> Thêm</button>
            <div id="eccAlert"></div>
        </div>
    </div>
    <br
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Nhóm danh bạ</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="tblDanhSach">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên nhóm</th>
                                <th>Ghi chú</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#</td>
                                <td>Tên nhóm</td>
                                <td>Ghi chú</td>
                                <td><button type="button" id="" class="btn btn-sm btn-danger"> - </button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>

<script src="app/sms_taikhoan/js/TAI_KHOAN.js"></script>
<script>
    var CL = new CORE_LOG();
    var CA = new CORE_ALERT_2('#eccAlert');
    var CU = new CORE_UTILS();
    var TK = new TAI_KHOAN();

    function loadDsChuaPhan(pID_USER){
        TK.get_NHOM_DANHBA_CHUA_PHAN(pID_USER);
        $('#ID_NHOM_DANHBA').html('');
        var _html ='';
        for (var i = 0; i < TK.DS_NHOM_CHUAPHAN.length; i++) {
            var _nhom = TK.DS_NHOM_CHUAPHAN[i];
            _html +='<option value="'+_nhom.id_nhom_danhba+'">'+_nhom.ten+'</option>';
        }
        $('#ID_NHOM_DANHBA').html(_html);
    }
    
    function loadDsDaPhan(pID_USER){
        TK.get_NHOM_DANHBA_DA_PHAN(pID_USER);
        $('#tblDanhSach > tbody').html('');
        var _html ='';
        for (var i = 0; i < TK.DS_NHOM_DAPHAN.length; i++) {
            var _nhom = TK.DS_NHOM_DAPHAN[i];
            _html += '<tr>';
                    _html += '<td>'+ (i+1) +'</td>';
                    _html += '<td>'+_nhom.ten+'</td>';
                    _html += '<td>'+_nhom.ghi_chu+'</td>';
                    _html += '<td><button type="button" data-id="'+_nhom.id_users_nhom_danhba+'" class="btn btn-sm btn-danger btnHuy"> - </button></td>';
            _html += '</tr>';
        }
        $('#tblDanhSach > tbody').html(_html);
    }

    function initPage() {
        var _id = CU.getParameterByName('id') !== null ? CU.getParameterByName('id') : '0';
        $('#ID_USER').val(_id);
        loadDsChuaPhan(_id);
        loadDsDaPhan(_id);
    }

</script>
<script>

    $().ready(function () {
        initPage();

        $('.ACTIONS').on('click', '#btnThem', function () {
            var _id = $('#ID_USER').val();
            var _id_nhom_danhba = $('#ID_NHOM_DANHBA').val();
            var _rs = TK.them_phanquyen_nhom(_id,_id_nhom_danhba);
            loadDsChuaPhan(_id);
            loadDsDaPhan(_id);
            CA.show(_rs.CODE, _rs.MSG);
            
        });
        
        $('#tblDanhSach').on('click', '.btnHuy', function () {
            var _id = $(this).data('id');
            var _rs = TK.huy_phanquyen_nhom(_id);
            
            var _id_user = $('#ID_USER').val();
            loadDsChuaPhan(_id_user);
            loadDsDaPhan(_id_user);
            CA.show(_rs.CODE, _rs.MSG);
            
        });


    });



</script>
