<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/app.css">
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
                    <ul role="menu" class="aui-nav">
                        <li>
                            <form action=#" method="get" class="aui-quicksearch">
                                <label for="search-query" class="assistive">owner/repository</label>
                                <input id="search-query" class="bb-repo-typeahead" type="text" placeholder="Find a repository&hellip;" name="name" autocomplete="off" data-bb-typeahead-focus="false">
                            </form>
                        </li>
                        
                        <li id="ace-stp-menu">
                            <a id="ace-stp-menu-link" class="aui-nav-link" href="#" aria-controls="super-touch-point-dialog" data-aui-trigger>
                                <span id="ace-stp-menu-icon" class="aui-icon aui-icon-small aui-iconfont-help"></span>
                            </a>
                        </li>
                        
                        <?php if(Yii::app()->user->isGuest) { ?>
                        <li id="header-signup-button">
                            <a id="sign-up-link" class="aui-button aui-button-primary" href="#">Đăng ký</a>
                        </li>
                        <li id="user-options">
                            <a href="#" class="aui-nav-link login-link">Đăng nhập</a>
                        </li>
                        <?php } else { ?>
                        <li>
                            <a class="" href="#header-language" aria-controls="header-language" aria-owns="header-language" aria-haspopup="true" data-container="#header .aui-header-inner">
                              <span class="aui-icon aui-icon-small aui-iconfont-configure"></span></a>
                            <nav id="header-language" class="aui-dropdown2 aui-style-default aui-dropdown2-radio aui-dropdown2-in-header"
                            aria-hidden="true">
                                <ul>
                                    <li><a href="#"><span class="aui-icon aui-icon-small aui-iconfont-space-personal"></span>  Cá nhân</a></li>
                                    <li><a href="#"><span class="aui-icon aui-icon-small aui-iconfont-locked"></span>  Đổi mật khẩu</a></li>
                                    <li><a href="<?php echo $this->createUrl('site/logout'); ?>"><span class="aui-icon aui-icon-small aui-iconfont-devtools-fork"></span>  Thoát</a></li>
                                </ul>
                            </nav>
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

                            <div class="aui-item sidebar">
                              <?php $this->widget('application.widgets.RightSidebar');?>      
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
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/aui/js/aui.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/aui/js/aui-experimental.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/app.js"></script>
</body>
</html>
