<!DOCTYPE html>
<html>
    <head>
        <title>Template trananh.vn</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="skins/frontend/assets/css/style.css"/>
        <script src="skins/frontend/assets/js/jquery.min.js"></script>
    </head>
    <body>  
        <!-- dau_trang -->
        <?php include_once 'modules/header/ta_header.php'; ?>
        <!-- ./ dau_trang -->
        <div id="than_trang">
                <?=$content?>   
            <!-- app -->
            
            <!-- ./ app -->
        </div><!-- ./ than_trang -->
        <!-- footer -->
        <?php include_once 'modules/footer/ta_footer.php'; ?>
        <!-- ./ footer -->
        <?php include_once 'modules/gio_hang/cart_icon.php'; ?>
    </body>
</html>












