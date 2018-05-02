<?php
class Test_rssApp extends AppObject{
	public $app_name="test_rss";
        
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
                    case "rss":
                        $kq = $this->RSS_get();
                        echo json_encode($kq);
                        break;
                    default:
                        break;
                }
            }
	}
        
        function RSS_get(){
            $chude=  $_REQUEST['chu_de'];
            $xml = "";
            switch ($chude) {
                case "sukien":
                    $xml = "http://dantri.com.vn/su-kien.rss";
                    break;
                case "xahoi":
                    $xml = "http://dantri.com.vn/xa-hoi.rss";
                    break;
                case "thegioi":
                    $xml = "http://dantri.com.vn/the-gioi.rss";
                    break;
                default:
                    $xml = "http://dantri.com.vn/su-kien.rss";
                    break;
            }
            $xmlDoc = simplexml_load_file($xml);
            $_rs = array();
            foreach($xmlDoc->channel->item as $value){
                //print_r($value);
                $itemTitle =  (string)$value->title;
		$itemLink =  (string)$value->link;
		$itemDescription =  (string)$value->description;
                $_item = array("tieude"=>$itemTitle,"mota"=>$itemDescription,"link"=>$itemLink);
                //echo($itemTitle);
		array_push($_rs,$_item);
            }
            return $_rs;
        }
}
?>