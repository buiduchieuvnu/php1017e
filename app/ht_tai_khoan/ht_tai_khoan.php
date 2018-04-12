<?php
class Ht_tai_khoanApp extends AppObject{
	public $app_name="ht_tai_khoan";
        
	public function __construct(){
            parent::__construct();
	}
        
	public function display(){
            $this->dir_layout="admin_trananh";
            $this->view = isset($_REQUEST["view"])?$_REQUEST["view"]:"danh_sach"; 
            $this->layout = ($this->view=='chi_tiet')?'layout_popup':"layout_admin"; 
            
            if($this->view!="ajax"){
                $this->id= isset($_REQUEST["id"])?$_REQUEST["id"]:"0";
                parent::display();
            }else{
                $task=isset($_REQUEST["task"])?$_REQUEST["task"]:"task";
                switch ($task) {
                    case "tim":
                        $kq = $this->TK_tim();
                        echo json_encode($kq);
                        break;
                    case "them":
                        $kq = $this->TK_them();
                        echo json_encode($kq);
                        break;
                    case "sua":
                        $kq = $this->TK_sua();
                        echo json_encode($kq);
                        break;
                    case "khoa":
                        $kq = $this->TK_khoa();
                        echo json_encode($kq);
                        break;
                    case "lay":
                        $kq = $this->TK_lay();
                        echo json_encode($kq);
                        break;
                    default:
                        break;
                }
            }

	}
        
        function TK_tim(){
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL ht_tai_khoan_tim()");
            return $ketqua;
        }
        
        function TK_lay(){
            $id_tai_khoan = $_REQUEST['id_tai_khoan'];
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL ht_tai_khoan_lay($id_tai_khoan)");
            return $ketqua;
        }
        
        function TK_them(){
            $ho_ten = $_REQUEST['ho_ten'];
            $tai_khoan = $_REQUEST['tai_khoan'];
            $mat_khau = $_REQUEST['mat_khau'];
            $mat_khau2 = $_REQUEST['mat_khau2'];
            $trang_thai = $_REQUEST['trang_thai'];
            
            if($mat_khau != $mat_khau2){
                $ketqua = array();
                array_push($ketqua, array("ma"=>"ERR","thong_bao"=>"Lỗi xác nhận mật khẩu.","ket_qua"=>""));
                return $ketqua;
            }
            
            $DB = new Database();
            $mat_khau = md5($mat_khau);
            $sql = "CALL ht_tai_khoan_them("
                    . "'$tai_khoan',"
                    . "'$mat_khau',"
                    . "'$ho_ten',"    
                    . "'$trang_thai')";
            $ketqua = $DB->queryAll($sql);
            return $ketqua;
        }
        
        function TK_sua(){
            $ho_ten = $_REQUEST['ho_ten'];
            $id_tai_khoan = $_REQUEST['id_tai_khoan'];
            $mat_khau = $_REQUEST['mat_khau'];
            $mat_khau2 = $_REQUEST['mat_khau2'];
            $trang_thai = $_REQUEST['trang_thai'];
            
            if($mat_khau != $mat_khau2){
                $ketqua = array();
                array_push($ketqua, array("ma"=>"ERR","thong_bao"=>"Lỗi xác nhận mật khẩu.","ket_qua"=>""));
                return $ketqua;
            }
            $DB = new Database();
            $sql = "CALL ht_tai_khoan_sua("
                    . "$id_tai_khoan,"
                    . "'$ho_ten',"
                    . "'$mat_khau',"
                    . "'$trang_thai')";
            $ketqua = $DB->queryAll($sql);
            return $ketqua;
        }

        function TK_khoa(){
            $id_tai_khoan = $_REQUEST['id_tai_khoan'];
            $trang_thai = $_REQUEST['trang_thai'];
            $DB = new Database();
            $sql = "CALL ht_tai_khoan_khoa($id_tai_khoan,'$trang_thai')";
            $ketqua = $DB->queryAll($sql);
            return $ketqua;
        }

}

?>