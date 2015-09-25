<!DOCTYPE html>
<html lang="en" class="login_page">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/theme_admin/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/theme_admin/bootstrap/css/bootstrap-responsive.min.css" />
        <!-- theme color-->
            <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/theme_admin/css/blue.css" />
        <!-- tooltip -->    
			<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/theme_admin/lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
            <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/theme_admin/css/style.css" />
    
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
    
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    
        <!--[if lte IE 8]>
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
    </head>
    <body>
		<?php
			echo $content;
		?>
    </body>
</html>
