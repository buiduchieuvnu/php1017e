<?php
// Test dữ liệu:
//echo '<pre>';
//print_r($this->DM_TIVI);
//print_r($this->SP_TIVI);
?>

<div class="dong_sanpham">
    <div class="danh_muc">
        <h3><a href="#">Tivi</a></h3>
        <ul>
            <?php
            foreach ($this->DM_TIVI as $key => $value) {
            ?>
                <li><a href="#"><?=$value['ten_danh_muc']?> </a></li>
            <?php
            }
            ?>
            
        </ul>
        <a class="xem_them" href="#">View more ></a>
    </div>
    <ul class="danhsach_sanpham">
        <?php
            foreach ($this->SP_TIVI as $key => $value) {
            ?>
        <li>
            <a href="#">
                <img class="anh_sanpham" src="skins/frontend/images/sanpham/<?=$value['hinh_anh']?>" />
                <div class="dong_1">
                    <img class="logo_hangsx" src="skins/frontend/images/logo/logo_samsung.png"/>
                    <h3 class="loai_sanpham"><?=$value['ten_san_pham']?></h3>
                    <span class="ma_sanpham">(<?=$value['ma_san_phan']?>)</span>
                </div>
                <div class="dong_2">
                    <span class="gia_sanpham"><?=$value['gia_ban']?> <sup>đ</sup></span>
                    <span class="tra_gop"></span>
                </div>

                <p class="khuyen_mai">Có 2 khuyến mại</p>
            </a>
        </li>
        <?php
            }
            ?>
    </ul>
</div>