
<div id="ChiTietSanPham" style="padding: 20px;">
    <div class="row well">
        <div class="form-group col-xs-6">
            <label>Tài khoản <span class="text-warning">(*)</span>: </label>
            <input type="text" class="form-control input-xs" id="txtTaiKhoan" placeholder="Tài khoản" />
        </div>
        <div class="form-group col-xs-6">
            <label>Họ và tên <span class="text-warning">(*)</span>: </label>
            <input type="text" class="form-control input-xs" id="txtHoTen" placeholder="Họ và tên" />
        </div>
        <div class="form-group col-xs-4">
            <label>Mật khẩu <span class="text-warning">(*)</span>: </label>
            <input type="password" class="form-control input-xs" id="txtMatKhau" />
        </div>
        <div class="form-group col-xs-4">
            <label>Xác nhận mật khẩu <span class="text-warning">(*)</span>: </label>
            <input type="password" class="form-control input-xs" id="txtMatKhau2" />
        </div>
        <div class="form-group col-xs-4">
            <label>Trạng thái<span class="text-warning">(*)</span>: </label>
            <select class="form-control" id="selTrangThai">
                <option value="A">Kích hoạt</option>
                <option value="D">Khóa</option>
            </select>
        </div>
       
    </div>
    <div class="well row" id="ACTIONS">
        <input type="hidden" value="<?=$this->id?>" id="hdfId" />
        <button type="button" class="btn btn-success" id="btnLuu"><i class="icon icon-floppy-disk"></i> Lưu </button>
        <button type="button" class="btn btn-danger" id="CLOSE"><i class="icon icon-eject"></i> Đóng </button>
    </div>
</div>

<!-- App objects -->
<script type="text/javascript">
    function them(){
        var mat_khau = $('#txtMatKhau').val();
        var  mat_khau2 = $('#txtMatKhau2').val();
        if(mat_khau!=mat_khau2){
            alert('Lỗi: mật khẩu không khớp nhau.');
            return false;
        }
        var _gui = {
            
            ho_ten:$('#txtHoTen').val(),
            tai_khoan:$('#txtTaiKhoan').val(),
            mat_khau:$('#txtMatKhau').val(),
            mat_khau2:$('#txtMatKhau2').val(),
            trang_thai:$('#selTrangThai').val()
        };
        var request = $.ajax({
            url: "?app=ht_tai_khoan&task=them&view=ajax", // Địa chỉ file xử lý ajax request
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
                alert('Thêm thành công!');
            }else{
                alert('Thêm thất bại!');
            }
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }
    
    function sua(){
        var mat_khau = $('#txtMatKhau').val();
        var  mat_khau2 = $('#txtMatKhau2').val();
        if(mat_khau!=mat_khau2 || mat_khau=='' || mat_khau2==''){
            alert('Lỗi: mật khẩu không hợp lệ.');
            return false;
        }
        var _gui = {
            id_tai_khoan:$('#hdfId').val(),
            ho_ten:$('#txtHoTen').val(),
            tai_khoan:$('#txtTaiKhoan').val(),
            mat_khau:$('#txtMatKhau').val(),
            mat_khau2:$('#txtMatKhau2').val(),
            trang_thai:$('#selTrangThai').val()
        };
        var request = $.ajax({
            url: "?app=ht_tai_khoan&task=sua&view=ajax", // Địa chỉ file xử lý ajax request
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
                alert('Sửa thành công!');
            }else{
                alert('Sửa thất bại!');
            }
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    function lay(){
        if($('#hdfId').val()=='0'){
            return false;
        }
        var _gui = {
            id_tai_khoan:$('#hdfId').val()
        };
        var request = $.ajax({
            url: "?app=ht_tai_khoan&task=lay&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            console.log(ketqua);
            var DS = $.parseJSON(ketqua);
            var _tk = DS[0];
            $('#txtTaiKhoan').val(_tk.tai_khoan);
            $('#txtHoTen').val(_tk.ho_ten);
            $('#selTrangThai').val(_tk.trang_thai);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    (function () {
        lay();    
            
        $('#btnLuu').click(function(){
            var id = $('#hdfId').val();
            if(id=='0'){
                alert('them: ' + id);
                them();
            }else{
                sua();
            }
        });
    })(jQuery);

</script>
