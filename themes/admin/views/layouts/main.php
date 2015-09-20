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
<div id="page">
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

                        <li>
                            <a class="aui-dropdown2-trigger" href="#header-language" aria-controls="header-language" aria-owns="header-language" aria-haspopup="true" data-container="#header .aui-header-inner">
                              <span>English</span></a>
                            <nav id="header-language" class="aui-dropdown2 aui-style-default aui-dropdown2-radio aui-dropdown2-in-header"
                            aria-hidden="true">
                                <form method="post" action="#"  data-modules="i18n/header-language-form">
                                    <input type="hidden" name="language" value="">
                                    <ul>
                                    <li><a class="aui-dropdown2-radio interactive checked"  data-value="en" href="#en">English</a></li>

                                    <li><a class="aui-dropdown2-radio interactive "  data-value="ja" href="#ja">日本語</a></li>
                                    </ul>
                                </form>
                            </nav>
                        </li>
                        <?php if(Yii::app()->user->isGuest) { ?>
                        <li id="header-signup-button">
                            <a id="sign-up-link" class="aui-button aui-button-primary" href="#">Đăng ký</a>
                        </li>
                        <li id="user-options">
                            <a href="#" class="aui-nav-link login-link">Đăng nhập</a>
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
                    <div id="repo-content" class="aui-page-panel-content" data-modules="repo/index">                   
                        <div id="repo-overview" class="aui-group">
                            <div class="aui-item">
                                <div class="aui-group repo-page-header">
                                    <div class="aui-item section-title">
                                        <?php if(isset($this->breadcrumbs)):?>
                                            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                                'links'=>$this->breadcrumbs,
                                            )); ?><!-- breadcrumbs -->
                                        <?php endif?>
                                        <h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
                                    </div>
                                </div>
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

    <footer id="footer" role="contentinfo" data-modules="components/footer">
        <section class="footer-body">
            <div id="footer-logo">
            </div>
        </section>
    </footer>
</div>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/djangojs.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/vendor.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/js/app.js"></script>
</body>
</html>
