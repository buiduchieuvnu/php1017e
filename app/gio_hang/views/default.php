<style>
    #ChiTietGioHang{margin-top: 20px}
    #TongTien{font-size: 18; padding: 5px; font-weight: bold; color:red}
</style>
<div id="ChiTietGioHang">
    <h2>Chi tiết giỏ hàng</h2>
    <table id="tblGioHang" width="100%" border="1" style="margin-top: 20px">
        <thead>
        <tr>
        <td>STT</td>
        <td>Hình ảnh</td>
        <td>Tên hàng</td>
        <td>Giá</td>
        <td>Số lượng</td>
        <td>Thành tiền</td>
        <td>Tác vụ</td>
        </tr>
        <tbody>
            <tr>
                <td>1</td>
                <td><img width="150" height="100" src="upload/images/sanpham/tivi_1.png" /></td>
                <td>Tivi Samsung</td>
                <td>10000000</td>
                <td><input type="number" value="2" class="txtSoLuong" /></td>
                <td>20000000</td>
                <td><a href="#">Xóa</a></td>
            </tr>
        </tbody>
        </thead>
    </table>
    <p >Tổng tiền: <span id="TongTien"></span><p>
        <br>
        <input type="button" id="btnCapNhat" value="Cập nhật giỏ hàng" />
        <input type="button" id="btnHuy" value="Hủy giỏ hàng" />
</div>

<script>
    function GioHang_bind(){
        var _gui = {};
        var request = $.ajax({
            url: "?app=gio_hang&task=lay&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            var DS = $.parseJSON(ketqua);
            console.log(DS);
            var _html = "";
            var tongtien = 0;
            for (var i = 0; i < DS.length; i++) {
                var sanpham = DS[i];
                var thanhtien = parseInt(sanpham[4]) * parseInt(sanpham[5]);
                tongtien +=thanhtien;
                _html += '<tr>';
                _html += '<td>'+(i+1)+'</td>';
                _html += '<td><img width="150" height="100" src="' + sanpham[3] + '" /></td>';
                _html += '<td>' + sanpham[2] + '</td>';
                _html += '<td>' + sanpham[4] + '</td>';
                _html += '<td><input type="number" value="' + sanpham[5] + '" class="txtSoLuong" /></td>';
                _html += '<td>'+ thanhtien +'</td>';
                _html += '<td><a href="#">Xóa</a></td>';
                _html += '</tr>';
            }
            // Chèn dữ liệu vào bảng
            $('#tblGioHang tbody').html(_html);
            $('#TongTien').html(tongtien);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }
    
    $(function(){
        GioHang_bind();
    });
    
    
    function GioHang_huy(){
        var _gui = {};
        var request = $.ajax({
            url: "?app=gio_hang&task=huy&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            alert(ketqua);
            GioHang_bind();
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }
    
    $(function(){
        GioHang_bind();
        
        $('#btnHuy').on('click',function(){
            
            var xacnhan = confirm("Bạn có chắc chắn muốn hủy giỏ hàng không?");
            if(xacnhan==true){
                GioHang_huy();
            }
        });
    });

</script>