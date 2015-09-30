<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Bootstrap framework -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/css/blue.css" />
        <!-- tooltips-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/css/customize.css" />

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />

        <!-- upload -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/plupload/js/jquery.plupload.queue/css/plupload-gebo.css" />
        <!-- colorbox -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/colorbox/colorbox.css" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />

        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
                        <script src="js/ie/respond.min.js"></script>
        <![endif]-->
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
        <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
        <script>
            //* hide all elements & show preloader
            document.documentElement.className += 'js';
        </script>
    </head>
    <body>
        <div id="loading_layer" style="display:none"><img src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/img/ajax_loader.gif" alt="" /></div>
        <div id="maincontainer" class="clearfix">
            <!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="<?php echo Yii::app()->createUrl(Yii::app()->homeUrl[0]); ?>"><i class="icon-home icon-white"></i> <?php echo Yii::app()->name; ?></a>
                            <ul class="nav user_menu pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi <?php echo Yii::app()->user->username; ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Yii::app()->createUrl('admin/profile'); ?>">Profile</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl('admin/logout'); ?>">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                    <?php if(isset($this->breadcrumbs)):?>
                            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                    'links'=>$this->breadcrumbs,
                            )); ?><!-- breadcrumbs -->
                    <?php endif?>
                    <?php
                        $flash = Yii::app()->user->getFlashes();
                        foreach ($flash as $key=>$msg)
                        {
                            echo '<div class="alert alert-'.$key.'">'.$msg.'</div>';
                        }
                    ?>
                    <!--<nav>
                        <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">Sports & Toys</a>
                                </li>
                                <li>
                                    <a href="#">Toys & Hobbies</a>
                                </li>
                                <li>
                                    <a href="#">Learning & Educational</a>
                                </li>
                                <li>
                                    <a href="#">Astronomy & Telescopes</a>
                                </li>
                                <li>
                                    Telescope 3735SX 
                                </li>
                            </ul>
                        </div>
                    </nav>-->
                    <?php echo $content; ?>
                </div>
            </div>
            <!-- sidebar -->
            <a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
                <div class="antiScroll">
                    <div class="antiscroll-inner">
                        <div class="antiscroll-content">
                            <div class="sidebar_inner">
                                <!--<form action="search_page.html" class="input-append" method="post" >
                                    <input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="Search..." /><button type="submit" class="btn"><i class="icon-search"></i></button>
                                </form>-->
                                <?php
                                $this->widget('application.widgets.admin.Sidebar', array());
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- smart resize event -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/jquery.debouncedresize.min.js"></script>
            <!-- hidden elements width/height -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/jquery.actual.min.js"></script>
            <!-- js cookie plugin -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/jquery.cookie.min.js"></script>
            <!-- main bootstrap js -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/bootstrap.plugins.min.js"></script>
            <!-- tooltips -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/qtip2/jquery.qtip.min.js"></script>
            <!-- fix for ios orientation change -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/ios-orientationchange-fix.js"></script>
            <!-- scrollbar -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/antiscroll/antiscroll.js"></script>
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/antiscroll/jquery-mousewheel.js"></script>
            <!-- common functions -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/gebo_common.js"></script>
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/jquery.plugins.js"></script>
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/jquery.form.js"></script>
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/js/autoNumeric.js"></script>
            <!-- colorbox -->
            <script src="<?php echo Yii::app()->baseUrl; ?>/theme_admin/lib/colorbox/jquery.colorbox.min.js"></script>
            <script>
                $(document).ready(function() {
                    //* show all elements & remove preloader
                    setTimeout('$("html").removeClass("js")',1000);
                });
            </script>

        </div>
    </body>
</html>