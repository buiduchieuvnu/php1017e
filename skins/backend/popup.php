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
        <script src="<?php echo AppObject::getBaseFile('libs/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo AppObject::getBaseFile('skins/backend/js/default.js') ?>"></script>
        <script src="<?php echo AppObject::getBaseFile('skins/backend/js/scripts.js') ?>"></script>
        <script src="<?= AppObject::getBaseFile('libs/EccLibsJs/Core.Alert.js') ?>"></script>
        <script src="<?= AppObject::getBaseFile('libs/EccLibsJs/Core.Log.js') ?>"></script>
        <script src="<?= AppObject::getBaseFile('libs/EccLibsJs/Core.Utils.js') ?>"></script>
    </head>
    <body>
        <div class="app_content">
            <?php echo $content; ?>
        </div><!-- /.app_content -->
    </body>
</html>