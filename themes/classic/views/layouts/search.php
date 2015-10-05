<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="vi">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">

	
</head>

<body>

<div class="container" id="page">
	<div id="header">
            <div id="mainmenu">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Trang chủ', 'url'=>Yii::app()->request->getBaseUrl(true)),
                        array('label'=>'Đăng nhập', 'url'=>array(Yii::app()->user->loginUrl), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Đăng ký', 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Tài khoản', 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Thoát', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                )); ?>
            </div><!-- mainmenu -->
        </div><!-- header -->
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
