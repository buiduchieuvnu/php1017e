<!DOCTYPE html>
<html>
    <head>
        <title>Template trananh.vn</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="skins/frontend/assets/css/style.css"/>
    </head>
    <body>  
        <!-- dau_trang -->
        <?php include_once 'modules/header/ta_header.php'; ?>
        <!-- ./ dau_trang -->
        <div id="than_trang">
            <div class="dong_1">
                <div class="cot_1">
                    <!-- menu_chinh -->
                    <?php include_once 'modules/menu/ta_menu_chinh.php'; ?>
                    <!-- ./ menu_chinh -->
                </div>
                <div class="cot_2">
                    <!-- slider -->
                    <?php include_once 'modules/slider/ta_slider.php'; ?>
                    <!-- ./ slider -->
                </div>
                <div class="cot_3">
                    <!-- slider -->
                    <?php include_once 'modules/quangcao/ta_quangcao_trangchu.php'; ?>
                    <!-- ./ slider -->
                </div>
            </div>
            <!-- app -->
            <?=$content?>
            <!-- ./ app -->
        </div><!-- ./ than_trang -->
        <!-- footer -->
        <?php include_once 'modules/footer/ta_footer.php'; ?>
        <!-- ./ footer -->
    </body>
</html>












