<?php
/**
 * App quản lý khóa học
 * @author Hieubd <buiduchieuvnu@gmail.com>
 * @version 1.0
 */
session_start();
ob_start();

if ( !defined('AREA') ) {
    die('Access denied');
}

?>
<?php
class TinnhanApp extends AppObject {
    public $app_name="tinnhan";
    public $dir_layout="backend"; // thư mục chứa layout trong skin
    public $page_title = "Quản lý tin nhắn";
    public $Class;

    private static $table = 'class';

    public function __construct() {

        if(empty($_SESSION["auth"]["id_user"])) {
            header("Location: ".INDEX); /* Redirect browser */
            exit;
        }

        parent::__construct();
    }

    public function display() {
        $task="";
        if(isset($_REQUEST['task'])) {
            $task=$_REQUEST['task'];
        }
		
		switch($task){
			case "tinmau": self::viewMau(); break;
			case "view_danhba": self::viewDanhBa(); break;
			case "nhom": self::viewNhom(); break;
			default: self::views();
		}

    }

    /**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function views() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="default";

        $this->lsLichSuSMS = self::getLichSuNhanTin();
	$this->lsDanhBa = self::getListNhomByUser();
        
        parent::display();
    }
	
	/**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function viewNhom() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="nhantin_nhom";

        $this->lsLichSuSMS = self::getLichSuNhanTin();
	$this->lsNhomDanhBa = self::getListNhomByUser();
        //print_r ($this->lsNhomDanhBa );
        parent::display();
    }
	
	/**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function viewMau() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="tinnhan_mau";

        $this->lsLichSuSMS = self::getLichSuNhanTin();
        
        parent::display();
    }
	
	/**
     * Description: 
     * Author       Date modify     Note
     * hieubd       07-09-2017      Tạo mới
     */
    public static function getListDanhBa() {
        $db = new Database;
        $where="";
        $sql = "call db_sms.proc_danhba_get_all();";
        $pars = [];
        return $db->queryAll($sql);
    }
	
	
	/**
		- Date modify: 
     * Description: Lấy danh sách lịch sử nhắn tin
     * Author		Date modify		Note
     * hieubd		06-09-2017		Tạo mới
     */
    public static function getDanhBaByNhom($id_nhom_danhba) {
        $db = new Database;
        $sql = "call db_sms.proc_danhba_get_by_nhom($id_nhom_danhba);";
        return $db->queryAll($sql);
    }
	
	/**
		- Date modify: 
     * Description: Lấy danh sách lịch sử nhắn tin
     * Author		Date modify		Note
     * hieubd		06-09-2017		Tạo mới
     */
    public static function getLichSuNhanTin() {
        $db = new Database;
        $table = 'lichsu_sms';
        $where="";
        $sql = "call db_sms.proc_lichsu_sms_get_all();";
		$pars = [];
        return $db->queryAll($sql);
    }
	
	/**
		- Date modify: 
     * Description: Thêm lịch sử nhắn tin
     * Author		Date modify		Note
     * hieubd		06-09-2017		Tạo mới
     */
    public static function addLichSuNhanTin($p_nguoi_nhan, $p_thoi_gian, $p_so_di, $p_so_den, $p_noi_dung) {
        $db = new Database;
        $where="";
        $sql = "call db_sms.proc_lichsu_sms_add('$p_nguoi_nhan','$p_thoi_gian','$p_so_di','$p_so_den','$p_noi_dung');";
		$pars = [];
		//echo $sql;
        return $db->queryExecute($sql);
    }
	
	/**
		- Date modify: 
     * Description: Thêm lịch sử nhắn tin
     * Author		Date modify		Note
     * hieubd		06-09-2017		Tạo mới
     */
    public static function getListNhom() {
        $db = new Database;
        
        $sql = "call db_sms.proc_nhom_danhba_get_all();";
		//echo $sql;
        return $db->queryAll($sql);
    }
    
    public static function getListNhomByUser() {
        $db = new Database;
        $ID_USER = $_SESSION['auth']['id_user'];
        $sql = "call db_sms.proc_nhom_danhba_get_02($ID_USER);";
		//echo $sql;
        return $db->queryAll($sql);
    }
	
	
}
?>