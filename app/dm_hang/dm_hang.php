<?php
class Dm_hangApp extends AppObject{
	public $app_name="trangchu";
        
	public function __construct(){
            parent::__construct();
	}
        
	public function display(){
            $this->dir_layout="admin_trananh";
            $this->layout="layout_admin";
            $this->view="default";
            
            $view = isset($_REQUEST["view"])?$_REQUEST["view"]:"default"; 
            if($view!="ajax"){
                $this->view=$view;
                parent::display();
            }else{
                $task=isset($_REQUEST["task"])?$_REQUEST["task"]:"task";
                switch ($task) {
                    case "tim":
                        $kq = $this->DmHang_tim();
                        echo json_encode($kq);
                        break;
                    default:
                        break;
                }
            }
	}
        
        function DmHang_tim(){
            $DB = new Database();
            $ketqua = $DB->queryAll("CALL dm_hang_tim('')");
            return $ketqua;
        }
}
?>