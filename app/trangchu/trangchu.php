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
            parent::display();
	}
}
?>