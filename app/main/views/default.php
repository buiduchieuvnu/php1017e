<?php
if ( !defined('AREA') ) {
    die('Access denied');
}
?>
<!DOCTYPE html>
<link href="<?php echo AppObject::getBaseFile('app/main/css/style.css')?>" rel="stylesheet" media="screen">




<div class="slide clearfix six-pack">
    <div class="stack active" style="display: block;">
        <div class="stack-inner clearfix">
            <div class="wrap_both">
                <div class="image-content">
                    <a role="thumbnail" class="thumbnail" href="admin.php?app=course">
                        <span></span>
                        <img src="app/main/images/contact_list.png">
                    </a>
                    <a class="explicit-link" href="admin.php?app=course">Quản lý Danh bạ</a>

                </div>
            </div>
        </div>
    </div>
    <div class="stack active" style="display: block;">
        <div class="stack-inner clearfix">
            <div class="wrap_both">
                <div class="image-content">
                    <a role="thumbnail" class="thumbnail" href="admin.php?app=course">
                        <span></span>
                        <img src="app/main/images/sms.png">
                    </a>
                    <a class="explicit-link" href="admin.php?app=course">Quản lý Tin nhắn</a>

                </div>
            </div>
        </div>
    </div>
	<div class="stack active" style="display: block;">
        <div class="stack-inner clearfix">
            <div class="wrap_both">
                <div class="image-content">
                    <a role="thumbnail" class="thumbnail" href="admin.php?app=course">
                        <span></span>
                        <img src="app/main/images/system.png">
                    </a>
                    <a class="explicit-link" href="admin.php?app=course">Cấu hình hệ thống</a>

                </div>
            </div>
        </div>
    </div>
</div>