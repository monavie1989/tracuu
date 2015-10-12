<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="vi">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/search.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/bootstrap/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/css/style.css" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>

    <body class="search-result <?php echo Yii::app()->controller->id . '-' . Yii::app()->controller->action->id; ?>">

        <div class="wrapper" id="page">
            <div id="header" class="wrap_container">
                <div id="mainmenu">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Trang chủ', 'url' => Yii::app()->request->getBaseUrl(true)),
                            array('label' => 'Đăng nhập', 'url' => array(Yii::app()->user->loginUrl), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Đăng ký', 'url' => array('/user/register'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Tài khoản', 'url' => array('/user/profile'), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Thoát', 'url' => array('/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
                </div><!-- mainmenu -->
            </div><!-- header -->

            <div id="main_content" class="content wrap_container">
                <?php echo $content; ?>
            </div>
            <div class="clear"></div>

            <div id="footer" class="wrap_container">
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                var advanced = localStorage.getItem('advanced');
                if (advanced == true || advanced == 'true') {
                    $('#advanced-search').css('display', 'block');
                    $('.content').css('margin-top', $('#advanced-search').height());
                }
                //if(advanced == null)
                $('.advance').on('click', function () {
                    $('#advanced-search').toggle().promise().done(function () {
                        advanced = localStorage.getItem('advanced');
                        if (advanced == true || advanced == 'true') {
                            localStorage.setItem('advanced', 'false');
                            $('.content').css('margin-top', '');
                        }
                        else if (advanced == false || advanced == 'false') {
                            localStorage.setItem('advanced', 'true');
                            $('.content').css('margin-top', $('#advanced-search').height());
                        }
                    });
                });

                $('.dropdown-menu li').click(function (e) {
                    e.preventDefault();
                    var selected = $(this).attr('data-value');
                    var text = $(this).text();
                    $('#select-category').html(text + '  <span class="caret"></span>');
                    $('.category').val(selected);
                });
            });
        </script>
    </body>
</html>