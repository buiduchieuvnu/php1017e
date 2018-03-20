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
class Sms_danhbaApp extends AppObject {
    public $app_name="sms_danhba";
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
			case "view_nhom": self::viewNhomDanhBa(); break;
			case "view_danhba": self::viewDanhBa(); break;
            case "import_danhba": self::viewImport(); break;
			default: self::views();
		}
        

    }

    /**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function viewImport() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="import_danhba";

        $this->ListItems = self::getListItems();
        
        parent::display();
    }


    /**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function views() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="danhba";

        $this->ListItems = self::getListItems();
        
        parent::display();
    }
	
    /**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function viewNhomDanhBa() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="nhom_danhba";

        $this->ListItems = self::getListItems();
        
        parent::display();
    }

    /**
     * Xuất view
     * @author Hieubd
     * @return [type] [description]
     */
    public function viewDanhBa() {
        $this->dir_layout="backend";
        $this->layout="default";
        $this->view="danhba";

        $this->ListItems = self::getListDanhBa();
        
        parent::display();
    }
	
	
	/**
     * Description: 
     * Author		Date modify		Note
     * hieubd		07-09-2017		Tạo mới
     */
    public static function getListItems() {
        $db = new Database;
        $where="";
        $sql = "call db_sms.proc_nhom_danhba_get_all();";
		$pars = [];
        return $db->queryAll($sql);
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
     * Description: Thêm lịch sử nhắn tin
     * Author		Date modify		Note
     * hieubd		07-09-2017		Tạo mới
     */
    public static function addDanhBa($p_ho_ten, $p_so_dien_thoai, $p_email, $p_diachi, $p_id_nhom_danhba) {
        $db = new Database;
        $sql = "call db_sms.proc_danhba_add('$p_ho_ten','$p_so_dien_thoai','$p_email','$p_diachi','$p_id_nhom_danhba');";
		//echo $sql;
        return $db->queryExecute($sql);
    }
	
	public static function importDanhBa($data, $id_nhom_danhba = 0){
        $db = new Database;
        return false;
    }

}
?>