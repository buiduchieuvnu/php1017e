<?php
if (!defined('AREA')) {
    die('Access denied');
}
?>
<div class="popup">
    <div class="well row">
        <div class="col-md-3 form-group">
            <label>Họ và tên:</label>
            <input type="text" class="form-control" id="txtFULLNAME" placeholder="Họ và tên" />
        </div>
        <div class="col-md-3 form-group">
            <label>Tài khoản:</label>
            <input type="text" class="form-control" id="txtUSERNAME" placeholder="Tài khoản" />
        </div>
        <div class="col-md-3 form-group">
            <label>Mật khẩu:</label>
            <input type="password" class="form-control" id="txtPASSWORD"/>
        </div>
        <div class="col-md-3 form-group">
            <label>Xác nhận mật khẩu:</label>
            <input type="password" class="form-control" id="txtPASSWORD_1"/>
        </div>
        <div class="col-md-12 ACTIONS">
            <input  type="hidden" id="ID_USER" />
            <button class="btn btn-warning" id="btnLuu"><i class="glyphicon glyphicon-save"></i> Lưu</button>
            <button class="btn btn-danger" id="btnLamMoi"><i class="glyphicon glyphicon-pause"></i> Hủy</button>
            <div id="eccAlert"></div>
        </div>
    </div>
</div>

<script src="app/sms_taikhoan/js/TAI_KHOAN.js"></script>
<script>
    var CL = new CORE_LOG();
    var CA = new CORE_ALERT_2('#eccAlert');
    var CU = new CORE_UTILS();
    var TK = new TAI_KHOAN();



    function initPage() {
        var _id = CU.getParameterByName('id') !== null ? CU.getParameterByName('id') : '0';
        $('#ID_USER').val(_id);
        
        if($('#ID_USER').val() ==='0'){
            $('#txtFULLNAME').val('');
            $('#txtUSERNAME').val('');
            $('#txtPASSWORD').val('');
            $('#txtPASSWORD_1').val('');
        }else{
            var _rs = TK.get_TAI_KHOAN_02(_id);
            if(TK.CHI_TIET !== null){
                $('#txtFULLNAME').val(TK.CHI_TIET.FULLNAME);
                $('#txtUSERNAME').val(TK.CHI_TIET.USERNAME);
            }else{
                CA.show(_rs.CODE, _rs.MSG);
            }
            
        }

        
    }




</script>
<script>

    $().ready(function () {
        initPage();

        $('.ACTIONS').on('click', '#btnLuu', function () {
            var _id = $('#ID_USER').val();
            if(_id==='0'){
                var _FULLNAME = $('#txtFULLNAME').val();
                var _USERNAME = $('#txtUSERNAME').val();
                var _PASSWORD = $('#txtPASSWORD').val();
                var _rs = TK.them_TAI_KHOAN(_FULLNAME, _USERNAME, _PASSWORD);
                CA.show(_rs.CODE, _rs.MSG);
            }else{
                var _FULLNAME = $('#txtFULLNAME').val();
                var _USERNAME = $('#txtUSERNAME').val();
                var _rs = TK.sua(_id,_FULLNAME, _USERNAME);
                CA.show(_rs.CODE, _rs.MSG);
            }
            
        });
        

    });



</script>
