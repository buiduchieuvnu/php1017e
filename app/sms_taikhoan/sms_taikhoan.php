<?php

/**
 * App quản lý khóa học
 * @author Hieubd <buiduchieuvnu@gmail.com>
 * @version 1.0
 */
session_start();
ob_start();

if (!defined('AREA')) {
    die('Access denied');
}
?>
<?php

class Sms_taikhoanApp extends AppObject {

    public $app_name = "sms_taikhoan";
    public $dir_layout = "backend"; // thư mục chứa layout trong skin
    public $page_title = "Quản lý tin tài khoản";
    public $Class;
    private static $table = 'class';

    public function __construct() {

        if (empty($_SESSION["auth"]["id_user"])) {
            header("Location: " . INDEX); /* Redirect browser */
            exit;
        }

        parent::__construct();
    }

    public function display() {
        $task =(isset($_REQUEST['task']))? $_REQUEST['task']:"";
        $view =(isset($_REQUEST['view']))? $_REQUEST['view']:"default";
        
        if ($view == 'ajax') {
            switch ($task) {
                case 'get_danh_sach':
                    self::ajaxGetDanhSach();
                    break;
                case 'luu_tai_khoan':
                    self::ajaxLuuTaiKhoan();
                    break;
                case 'get_tai_khoan_02':
                    self::ajaxGetChiTiet();
                    break;
                case 'tai_khoan_sua_01':
                    self::ajaxSuaTaiKhoan();
                    break;
                case 'tai_khoan_delete_01':
                    self::ajaxXoaTaiKhoan();
                    break;
                case 'nhom_danhba_get_02':
                    self::ajx_nhom_danhba_get_02();
                    break;
                
                case 'nhom_danhba_get_03':
                    self::ajx_nhom_danhba_get_03();
                    break;
                
                case 'them_phanquyen_nhom':
                    self::ajx_them_phanquyen_nhom();
                    break;
                
                case 'huy_phanquyen_nhom':
                    self::ajx_huy_phanquyen_nhom();
                    break;

                default: break;
            }
            return;
        }

        switch ($view) {
            case 'chitiet' : 
                self::viewChiTiet();
            break;
            case 'phan_quyen' : 
                self::viewPhanQuyen();
            break;
            default: self::viewDanhSach();
        }
    }

    public function viewDanhSach() {
        $this->dir_layout = "backend";
        $this->layout = "default";
        $this->view = "danhsach";
        parent::display();
    }
    
    public function viewChiTiet() {
        $this->dir_layout = "backend";
        $this->layout = "popup";
        $this->view = "chitiet";
        parent::display();
    }

    public function viewPhanQuyen() {
        $this->dir_layout = "backend";
        $this->layout = "popup";
        $this->view = "phan_quyen";
        parent::display();
    }
    
    
    public function ajaxGetDanhSach() {
        $db = new Database;
        $sql = "call proc_taikhoan_get_01();";
        $rs = $db->queryAll($sql);
        echo json_encode(array('status' => 'success', 'message' => 'Thành công!', 'returndata' => $rs));
    }
    
    public function ajaxGetChiTiet() {
        try {
            $ID_USER = $_REQUEST['ID_USER'];
            $db = new Database;
            $sql = "call proc_taikhoan_get_02($ID_USER);";
            $rs = $db->queryAll($sql);
            echo json_encode(array('CODE' => '0', 'MSG' => 'Thành công!', 'DATA' => $rs)); 
        } catch (Exception $ex) {
            echo json_encode(array('CODE' => '1', 'MSG' => 'Lỗi: ' + $ex->getMessage(), 'DATA' => null));
        }
        
        
    }
    
    public function ajaxLuuTaiKhoan() {
        $db = new Database;
        
        $FULLNAME = isset($_REQUEST["FULLNAME"])? $_REQUEST["FULLNAME"]:"";
        $USERNAME = isset($_REQUEST["USERNAME"])? $_REQUEST["USERNAME"]:"";
        $PASSWORD = isset($_REQUEST["PASSWORD"])? $_REQUEST["PASSWORD"]:"";
        $PASSWORD = md5($PASSWORD);
        if($FULLNAME == "" || $USERNAME == "" || $PASSWORD  == ""){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_taikhoan_add_01('$USERNAME','$PASSWORD','$FULLNAME');";
        $rs = $db->queryAll($sql);
        echo json_encode(array('status' => 'success', 'message' => 'Thành công!', 'returndata' => $rs));
    }
    
    public function ajaxSuaTaiKhoan() {
        $db = new Database;
        
        $FULLNAME = isset($_REQUEST["FULLNAME"])? $_REQUEST["FULLNAME"]:"";
        $USERNAME = isset($_REQUEST["USERNAME"])? $_REQUEST["USERNAME"]:"";
        $ID_USER = isset($_REQUEST["ID_USER"])? $_REQUEST["ID_USER"]:"";
        
        if($FULLNAME == "" || $USERNAME == "" || $ID_USER  == ""){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_taikhoan_update_02($ID_USER,'$USERNAME','$FULLNAME');";
        $rs = $db->queryAll($sql);
        echo json_encode(array('status' => 'success', 'message' => 'Thành công!', 'returndata' => $rs));
    }
    
    public function ajaxXoaTaiKhoan() {
        $db = new Database;
        $ID_USER = isset($_REQUEST["ID_USER"])? $_REQUEST["ID_USER"]:"";
        
        if($ID_USER  == ""){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_taikhoan_delete_01($ID_USER);";
        $rs = $db->queryAll($sql);
        echo json_encode(array('CODE' => '0', 'MESSAGE' => 'Xóa thành công.', 'DATA' => $rs));
    }

    public function ajx_nhom_danhba_get_02() {
        $db = new Database;
        $ID_USER = isset($_REQUEST["ID_USER"])? $_REQUEST["ID_USER"]:"";
        
        if($ID_USER  == ""){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_nhom_danhba_get_02($ID_USER);";
        $rs = $db->queryAll($sql);
        echo json_encode(array('CODE' => '0', 'MESSAGE' => 'Thành công!', 'DATA' => $rs));
    }
    
    public function ajx_nhom_danhba_get_03() {
        $db = new Database;
        $ID_USER = isset($_REQUEST["ID_USER"])? $_REQUEST["ID_USER"]:"";
        
        if($ID_USER  == ""){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_nhom_danhba_get_03($ID_USER);";
        $rs = $db->queryAll($sql);
        echo json_encode(array('CODE' => '0', 'MESSAGE' => 'Thành công!', 'DATA' => $rs));
    }
    
    public function ajx_them_phanquyen_nhom() {
        $db = new Database;
        
        $ID_USER = isset($_REQUEST["ID_USER"])? $_REQUEST["ID_USER"]:"";
        $ID_NHOM_DANHBA = isset($_REQUEST["ID_NHOM_DANHBA"])? $_REQUEST["ID_NHOM_DANHBA"]:"";
        
        if($ID_USER == "" || $ID_NHOM_DANHBA == ""){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_users_nhom_danhba_add_01($ID_USER,$ID_NHOM_DANHBA);";
        $rs = $db->queryAll($sql);
        echo json_encode(array('CODE' => '0', 'MESSAGE' => 'Thành công!', 'DATA' => $rs));
    }
    
    public function ajx_huy_phanquyen_nhom() {
        $db = new Database;
        $ID_USERS_NHOM_DANHBA = isset($_REQUEST["ID_USERS_NHOM_DANHBA"])? $_REQUEST["ID_USERS_NHOM_DANHBA"]:"";
        
        if($ID_USERS_NHOM_DANHBA == "" ){
            echo json_encode(array('CODE' => '1', 'MESSAGE' => 'Thông tin không hợp lệ!', 'DATA' => ''));
            return;
        }
        
        $sql = "call proc_users_nhom_danhba_delete_01($ID_USERS_NHOM_DANHBA);";
        $rs = $db->queryAll($sql);
        echo json_encode(array('CODE' => '0', 'MESSAGE' => 'Thành công!', 'DATA' => $rs));
    }
    
    
}
