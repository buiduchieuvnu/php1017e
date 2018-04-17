
<?php
    if(isset($_SESSION["GIO_HANG"])){
        $tong = count($_SESSION["GIO_HANG"]);
    }else{
        $tong = 0;
    }
    
?>

<style>
    .cart-icon{
        position: fixed;
        top:300px;
        left: 20px;
    }
    
    .cart-icon .cart-number{
        width: 15px;
        height: 15px;
        background: #FFF;
        position: absolute;
        top: 10px;
        left: 25px;
        border-radius: 10px;
        padding: 3px 3px 3px 7px;
        font-size: 14px;
        font-weight: bold;
    }
</style>
<a href="?app=gio_hang">
<div class="cart-icon">
    <img src="upload/images/icons/cart-icon.png" width="60" height="60" />
    <span class="cart-number"><?=$tong?></span>
</div>
</a>

<script>
    // ajax thêm sản phẩm vào giỏ hàng
    function GioHang_them(id, ma, ten, hinhanh, gia, soluong) {
        var _gui = {
            ID:id,
            MA: ma,
            TEN: ten,
            HINH_ANH: hinhanh,
            GIA: gia,
            SO_LUONG: soluong
        };
        var request = $.ajax({
            url: "?app=gio_hang&task=them&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            alert('Đã thêm sản phẩm vào giỏ hàng.');
            GioHang_tong();
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }

    function GioHang_tong() {
        var _gui = {};
        var request = $.ajax({
            url: "?app=gio_hang&task=lay_tong&view=ajax", // Địa chỉ file xử lý ajax request
            type: "POST", // Giao thức gửi
            data: _gui,
            dataType: "html"
        });
        // Nếu gửi thành công
        request.done(function (ketqua) {
            // convert chuỗi kết quả thành mảng
            $('.cart-number').html(ketqua);
        });
        // Nếu gửi thất bại
        request.fail(function (jqXHR, textStatus) {
            alert("Lỗi tại server: " + textStatus);
        });
    }
</script>
