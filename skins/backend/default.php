<?php
if (!defined('AREA')) {
    die('Access denied');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?php echo $meta_keywords; ?>">
        <meta name="description" content="<?php echo $meta_desc; ?>">
        <title><?php echo $page_title; ?></title>
        <link href="<?php echo AppObject::getBaseFile('libs/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php echo AppObject::getBaseFile('public/css/base.css') ?>" rel="stylesheet" media="screen">
        <link href="<?php echo AppObject::getBaseFile('skins/backend/css/style.css') ?>" rel="stylesheet" media="screen">
        <script src="<?php echo AppObject::getBaseFile('libs/jquery/jquery-2.2.4.min.js') ?>"></script>
        <!--<script src="<?php echo AppObject::getBaseFile('libs/jquery/jquery-3.3.1.min.js') ?>"></script>-->
        <script src="<?php echo AppObject::getBaseFile('libs/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo AppObject::getBaseFile('skins/backend/js/default.js') ?>"></script>
        <script src="<?php echo AppObject::getBaseFile('skins/backend/js/scripts.js') ?>"></script>
        <script src="<?= AppObject::getBaseFile('libs/EccLibsJs/Core.Alert.js') ?>"></script>
        <script src="<?= AppObject::getBaseFile('libs/EccLibsJs/Core.Log.js') ?>"></script>
        <script src="<?= AppObject::getBaseFile('libs/EccLibsJs/Core.Utils.js') ?>"></script>
    </head>
    <body>
        <div class="overlay" style="display:none;">
            <div id="dialog-box">
                <div id="dialog-icon" class=""></div>
                <h4 class="dialog-title">Đang xử lý...</h4>
                <p class="dialog-messeage"></p>
                <button type="button" class="btn btn-xs btn-danger dialog-btn" style="display:none;" onclick="dialogMesseage.hide()">x</button></h4>
            </div>
        </div>
        <h2><img class="app_logo" src="<?= AppObject::getBaseFile('skins/backend/images/logo-phutho.jpg') ?>" height="50" />  TRƯỜNG CAO ĐẲNG NGHỀ PHÚ THỌ</h2>
        
        <?php include_once AppObject::getBaseFile('modules/menu/menu_ngang.php'); ?>

        <div class="notice col-xs-12" style="display:none;">
            <div class="alert alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <span class="alert-message"></span>
            </div>
        </div>
        <div class="app_content">
            <?php echo $content; ?>
        </div><!-- /.app_content -->
    </body>
</html>