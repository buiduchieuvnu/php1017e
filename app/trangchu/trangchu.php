<?php
class TrangchuApp extends AppObject{
	public $app_name="trangchu";
        
	public function __construct(){
            parent::__construct();
	}
        
	public function display(){
            $this->dir_layout="frontend";
            $this->layout="layout_trangchu";
            $this->view="default";
            
            // Khởi tạo đối tượng xử lý dữ liệu
            $DB = new Database();
            // Lấy dữ liệu danh mục con của dm tivi
            $this->DM_TIVI = $DB->queryAll("CALL dm_hang_tim_theo_cha(12)");
            // Lấy ra danh sách sản phẩm thuộc danh mục tivi
            $this->SP_TIVI = $DB->queryAll("CALL san_pham_tim_theo_dm(12)");
            
            parent::display();
	}
}
?>