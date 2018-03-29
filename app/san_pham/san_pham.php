<?php
class San_phamApp extends AppObject{
	public $app_name="san_pham";
        
	public function __construct(){
            parent::__construct();
	}
        
	public function display(){
            $this->dir_layout="admin_trananh";
            $this->view = isset($_REQUEST["view"])?$_REQUEST["view"]:"danh_sach"; 
            $this->layout = ($this->view=='chi_tiet')?'layout_popup':"layout_admin"; 
            
            if($this->view!="ajax"){
                parent::display();
            }else{
                $task=isset($_REQUEST["task"])?$_REQUEST["task"]:"task";
                switch ($task) {
                    case "tim":
                        $kq = $this->SanPham_tim();
                        echo json_encode($kq);
                        break;
                    case "them":
                        $kq = $this->SanPham_them();
                        echo json_encode($kq);
                        break;
                    case "sua":
                        $kq = $this->SanPham_sua();
                        echo json_encode($kq);
                        break;
                    case "xoa":
                        $kq = $this->SanPham_xoa();
                        echo json_encode($kq);
                        break;
                    case "dm_hang_tim":
                        $kq = $this->DmHang_tim();
                        echo json_encode($kq);
                        break;
                    case "dm_ncc_tim":
                        $kq = $this->DmNcc_tim();
                        echo json_encode($kq);
                        break;
                    case "dm_thuonghieu_tim":
                        $kq = $this->DmThuongHieu_tim();
                        echo json_encode($kq);
                        break;
                    default:
                        break;
                }
            }

	}
        
        function SanPham_tim(){
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL san_pham_tim()");
            return $ketqua;
        }
        
        function SanPham_them(){
            $id_dm_hang = $_REQUEST['selDmHang'];
            $id_dm_nha_cung_cap = $_REQUEST['selDmNCC'];
            $id_dm_thuong_hieu = $_REQUEST['selDmThuongHieu'];
            $ma_san_phan = $_REQUEST['txtMa'];
            $ten_san_pham = $_REQUEST['txtTen'];
            $gia_nhap = $_REQUEST['txtGiaNhap'];
            $gia_ban = $_REQUEST['txtGiaBan'];
            $gia_khuyen_mai = $_REQUEST['txtGiaKM'];
            $hinh_anh = $_REQUEST['imgHinhAnh'];
            $mo_ta_ngan = $_REQUEST['txtMoTaNgan'];
            $mo_ta_chi_tiet = $_REQUEST['txtMoTaChiTiet'];
            $thuoc_tinh = $_REQUEST['txtThuocTinh'];
            $trang_thai = $_REQUEST['selTrangThai'];
            $DB = new Database();
            $sql = "CALL ta_san_pham_them(0,"
                    . "$id_dm_hang,"
                    . "$id_dm_nha_cung_cap,"
                    . "$id_dm_thuong_hieu,"
                    . "'$ma_san_phan',"
                    . "'$ten_san_pham',"
                    . "$gia_nhap,"
                    . "$gia_ban,"
                    . "$gia_khuyen_mai,"
                    . "'$hinh_anh',"
                    . "'$mo_ta_ngan',"
                    . "'$mo_ta_chi_tiet',"
                    . "'$thuoc_tinh',"
                    . "'$trang_thai')";
            $ketqua = $DB->queryAll($sql);
            return $ketqua;
        }
        
        function SanPham_sua(){
            $id_san_pham = $_REQUEST['hdfIdSanPham'];
            $id_dm_hang = $_REQUEST['selDmHang'];
            $id_dm_nha_cung_cap = $_REQUEST['selDmNCC'];
            $id_dm_thuong_hieu = $_REQUEST['selDmThuongHieu'];
            $ma_san_phan = $_REQUEST['txtMa'];
            $ten_san_pham = $_REQUEST['txtTen'];
            $gia_nhap = $_REQUEST['txtGiaNhap'];
            $gia_ban = $_REQUEST['txtGiaBan'];
            $gia_khuyen_mai = $_REQUEST['txtGiaKM'];
            $hinh_anh = $_REQUEST['imgHinhAnh'];
            $mo_ta_ngan = $_REQUEST['txtMoTaNgan'];
            $mo_ta_chi_tiet = $_REQUEST['txtMoTaChiTiet'];
            $thuoc_tinh = $_REQUEST['txtThuocTinh'];
            $trang_thai = $_REQUEST['selTrangThai'];
            $DB = new Database();
            $sql = "CALL ta_san_pham_sua($id_san_pham,"
                    . "$id_dm_hang,"
                    . "$id_dm_nha_cung_cap,"
                    . "$id_dm_thuong_hieu,"
                    . "'$ma_san_phan',"
                    . "'$ten_san_pham',"
                    . "$gia_nhap,"
                    . "$gia_ban,"
                    . "$gia_khuyen_mai,"
                    . "'$hinh_anh',"
                    . "'$mo_ta_ngan',"
                    . "'$mo_ta_chi_tiet',"
                    . "'$thuoc_tinh',"
                    . "'$trang_thai')";
            $ketqua = $DB->queryAll($sql);
            return $ketqua;
        }

        function SanPham_xoa(){
            $id_san_pham = $_REQUEST['hdfIdSanPham'];
            $DB = new Database();
            $sql = "CALL ta_san_pham_xoa($id_san_pham)";
            $ketqua = $DB->queryAll($sql);
            return $ketqua;
        }
        
        function DmHang_tim(){
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL dm_hang_tim()");
            return $ketqua;
        }
        
        function DmNcc_tim(){
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL dm_nha_cung_cap_tim()");
            return $ketqua;
        }
        
        function DmThuongHieu_tim(){
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL dm_thuong_hieu_tim()");
            return $ketqua;
        }
}

?>