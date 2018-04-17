<?php
class Gio_hangApp extends AppObject{
	public $app_name="gio_hang";
        
	public function __construct(){
            parent::__construct();
	}
        
	public function display(){
            $this->dir_layout="frontend";
            $this->layout="layout_trangcon";
            $this->view="default";
            
            $view = isset($_REQUEST["view"])?$_REQUEST["view"]:"default"; 
            if($view!="ajax"){
                $this->view=$view;
                parent::display();
            }else{
                $task=isset($_REQUEST["task"])?$_REQUEST["task"]:"task";
                switch ($task) {
                    case "huy":
                        session_destroy();
                         echo json_encode("Hủy giỏ hàng thành công!");
                         break;
                    case "lay":
                         $giohang = $this->GioHang_lay();
                         echo json_encode($giohang);
                         break;
                    case "them":
                        $Id = $_REQUEST["ID"];
                        $Ma = $_REQUEST["MA"];
                        $Ten = $_REQUEST["TEN"];
                        $HinhAnh = $_REQUEST["HINH_ANH"];
                        $Gia = $_REQUEST["GIA"];
                        $SoLuong = $_REQUEST["SO_LUONG"];
                        $this->GioHang_them($Id, $Ma, $Ten, $HinhAnh, $Gia, $SoLuong);
                        echo json_encode("OK");
                        break;
                    case "lay_tong":
                        $tong = $this->GioHang_laytong();
                        echo json_encode($tong);
                        break;
                    default:
                        break;
                }
            }
	}
        
        
        public function GioHang_them($Id, $Ma, $Ten, $HinhAnh, $Gia, $SoLuong){
            $giohang = isset($_SESSION["GIO_HANG"])? $_SESSION["GIO_HANG"]:array();
            $sp = array($Id,$Ma,$Ten, $HinhAnh, $Gia, $SoLuong);
            array_push($giohang,$sp);
            $_SESSION["GIO_HANG"] = $giohang;
        }
        
        public function GioHang_laytong(){
            if(isset($_SESSION["GIO_HANG"])){
                return count($_SESSION["GIO_HANG"]);
            }else{
                return 0;
            }
        }
        
        public function GioHang_lay(){
            if(isset($_SESSION["GIO_HANG"])){
                return $_SESSION["GIO_HANG"];
            }else{
                return array();
            }
        }
}
?>