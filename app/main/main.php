<?php

if ( !defined('AREA') ) { die('Access denied'); }
?>
<?php
class MainApp extends AppObject{
	public $app_name="main";
	public function __construct(){
            parent::__construct();
	}
	public function display(){
            $this->dir_layout="admin_trananh";
            $this->layout="layout_admin";
            $this->view="bangdieukhien";
            parent::display();
	}
}
?>