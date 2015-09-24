<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/app.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/aui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/vendor.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/aui/css/aui.css" media="all">
</head>

<body>
    <div id="page" style="overflow: hidden;">
    <div id="wrapper">
        <header id="header" role="banner">
            <nav class="aui-header aui-dropdown2-trigger-group" role="navigation">
            <div class="aui-header-inner">
            <div class="aui-header-primary">
                <h1 class="aui-header-logo aui-header-logo-bitbucket logged-out" id="logo">
                  <a href="<?php echo Yii::app()->request->baseUrl; ?>">
                      <div id="logo" style="position: relative;top: 50%;margin-top: -12px;"><?php echo CHtml::encode(Yii::app()->name); ?></div>
                  </a>
                </h1>
            </div>
            <div class="aui-header-secondary">
                    <ul role="menu" class="aui-nav nav navbar-nav navbar-right">                       
                        <?php if(Yii::app()->user->isGuest) { ?>
                        <li id="header-signup-button">
                            <a id="sign-up-link" class="aui-button aui-button-primary" href="#">Đăng ký</a>
                        </li>
                        <li id="user-options">
                            <a href="<?php echo $this->createUrl(Yii::app()->user->loginUrl); ?>" class="aui-nav-link login-link">Đăng nhập</a>
                        </li>
                        <?php } else { ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                              <span class="aui-icon aui-icon-small aui-iconfont-configure"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><span class="aui-icon aui-icon-small aui-iconfont-space-personal"></span>  Cá nhân</a></li>
                                    <li><a href="#"><span class="aui-icon aui-icon-small aui-iconfont-locked"></span>  Đổi mật khẩu</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo $this->createUrl('/user/logout'); ?>"><span class="aui-icon aui-icon-small aui-iconfont-devtools-fork"></span>  Thoát</a></li>
                                </ul>
                        </li>
                         <?php } ?>
                    </ul>
                </div>
            </div>
            </nav>
        </header>
        <div id="content" role="main">
            <?php $this->widget('application.widgets.adminmenu'); ?>      
            <div class="aui-page-panel ">
                <div class="aui-page-panel-inner">
                    <div id="repo-content" class="aui-page-panel-content">                   
                        <div id="repo-overview" class="aui-group">
                            <div class="aui-item">
                                <header class="aui-page-header" style="margin-bottom: 30px;">
                                    <div class="aui-page-header-inner">
                                        <div class="aui-page-header-image">
                                            <span class="aui-avatar aui-avatar-large aui-avatar-project">
                                                <span class="aui-avatar-inner">
                                                    <img alt="Atlassian logo" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/images/project-48.png">
                                                </span>
                                            </span>
                                        </div>
                                        <div class="aui-page-header-main">
                                            <?php if(isset($this->breadcrumbs)):?>
                                                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                                    'links'=>$this->breadcrumbs,
                                                )); ?><!-- breadcrumbs -->
                                            <?php endif?>
                                            <h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
                                        </div>
                                        <div class="aui-page-header-actions">
                                        <?php
                                            $this->widget('zii.widgets.CMenu', array(
                                                'itemCssClass'=>'aui-button',
                                                'items'=>$this->menu,
                                                'encodeLabel'=>false,
                                                'htmlOptions'=>array('class'=>'aui-buttons'),
                                            ));
                                        ?>
                                        </div>
                                    </div>
                                </header>
                                <?php
                                    $flash = Yii::app()->user->getFlashes();
                                    foreach ($flash as $key=>$msg)
                                    {
                                        echo '<div class="flash-'.$key.'">'.$msg.'</div>';
                                    }
                                ?>
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" role="contentinfo">
        <section class="footer-body">
            <div id="footer-logo">
            </div>
        </section>
    </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/app.js"></script>
</body>
</html>
