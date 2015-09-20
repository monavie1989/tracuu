<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/app.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/aui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/vendor.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
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
                            <form action="https://bitbucket.org/repo/all" method="get" class="aui-quicksearch">
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
                                <form method="post" action="https://bitbucket.org/account/language/setlang/"  data-modules="i18n/header-language-form">
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
                            <a id="sign-up-link" class="aui-button aui-button-primary" href="https://bitbucket.org/account/signup/">Đăng ký</a>
                        </li>
                        <li id="user-options">
                            <a href="https://bitbucket.org/account/signin/?next=/mailchimp/mandrill-api-php" class="aui-nav-link login-link">Đăng nhập</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            </nav>
        </header>

    
        <header id="account-warning" role="banner" data-modules="header/account-warning"
                class="aui-message-banner warning
                ">
            <div class="aui-message-banner-inner">
                <span class="aui-icon aui-icon-warning"></span>
                <span class="message">

                </span>
            </div>
        </header>

    
  
<header id="aui-message-bar">
  
</header>


    <div id="content" role="main">
      
  

<div class="aui-sidebar repo-sidebar" data-modules="components/repo-sidebar">
  <div class="aui-sidebar-wrapper">
    <div class="aui-sidebar-body">
      <header class="aui-page-header">
        <div class="aui-page-header-inner">
          <div class="aui-page-header-image">
            <a href="mandrill-api-php.html" id="repo-avatar-link" class="repo-link">
              <span class="aui-avatar aui-avatar-large aui-avatar-project">
                <span class="aui-avatar-inner">
                  <img  src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/images/default_avatar/64/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/mailchimp/mandrill-api-php/avatar/64/?ts=1437668205" data-src-url-2x="https://bitbucket.org/mailchimp/mandrill-api-php/avatar/128/?ts=1437668205" alt="">
                </span>
              </span>
            </a>
          </div>
          <div class="aui-page-header-main">
            <ol class="aui-nav aui-nav-breadcrumbs">
              <li>
                  <a href="index.html" id="repo-owner-link"><?php echo Yii::app()->user->name; ?></a>
              </li>
            </ol>
            <h1>              
              <span title="<?php echo Yii::app()->user->role_name; ?>" class="entity-name"><?php echo Yii::app()->user->role_name; ?></span>
            </h1>
          </div>
        </div>
      </header>
      <nav class="aui-navgroup aui-navgroup-vertical">
          
        <div class="aui-navgroup-inner">
            <div class="aui-sidebar-group aui-sidebar-group-actions repository-actions forks-enabled">
                <div class="aui-nav-heading">
                  <strong>Quản lý người dùng</strong>
                </div>
                <div id="mainmenu">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('class' => 'aui-nav'),
                        'itemCssClass'=>'aui-nav-item',
                        'activeCssClass'=>'aui-nav-selected',
                        'encodeLabel'=>false,
                        'items'=>array(
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large icon-overview"></span><span class="aui-nav-item-label">Danh sách người dùng</span>',
                                'url'=>array('/admin/user'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                ),
                                'visible'=>!Yii::app()->user->isGuest
                            ),
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large icon-overview"></span><span class="aui-nav-item-label">Nhóm người dùng</span>',
                                'url'=>array('/admin/userrole'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                ),
                                'visible'=>Yii::app()->user->checkAccess('admin.userrole.*')
                            ),
                        ),
                    )); ?>
                </div><!-- mainmenu -->
            </div>
          
            
              <div class="aui-sidebar-group aui-sidebar-group-actions repository-actions forks-enabled">
                <div class="aui-nav-heading">
                  <strong>Actions</strong>
                </div>
                <ul id="repo-actions" class="aui-nav">
                  
                  
                    <li>
                      <a id="repo-clone-button" class="aui-nav-item "
                        href="#clone"
                        data-ct="sidebar.actions.repository.clone"
                        data-ct-data=""
                        data-modules="components/clone/clone-dialog"
                        target="_self">
                        
                          <span class="aui-icon aui-icon-large icon-clone"></span>
                        
                        <span class="aui-nav-item-label">Clone</span>
                      </a>
                    </li>
                  
                    <li>
                      <a id="repo-compare-link" class="aui-nav-item "
                        href="mandrill-api-php/branches/compare.html"
                        data-ct="sidebar.actions.repository.compare"
                        data-ct-data=""
                        
                        target="_self">
                        
                          <span class="aui-icon aui-icon-large aui-icon-small aui-iconfont-devtools-compare"></span>
                        
                        <span class="aui-nav-item-label">Compare</span>
                      </a>
                    </li>
                  
                    <li>
                      <a id="repo-fork-link" class="aui-nav-item "
                        href="https://bitbucket.org/account/signin/?next=/mailchimp/mandrill-api-php/fork"
                        data-ct="sidebar.actions.repository.fork"
                        data-ct-data=""
                        
                        target="_self">
                        
                          <span class="aui-icon aui-icon-large icon-fork"></span>
                        
                        <span class="aui-nav-item-label">Fork</span>
                      </a>
                    </li>
                  
                </ul>
              </div>
          
          <div class="aui-sidebar-group aui-sidebar-group-tier-one repository-sections">
            <div class="aui-nav-heading">
              <strong>Navigation</strong>
            </div>
            <ul class="aui-nav">
              
              
                <li class="aui-nav-selected">
                  <a id="repo-overview-link" class="aui-nav-item "
                    href="mandrill-api-php/overview.html"
                    data-ct="sidebar.navigation.repository.overview"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                    <span class="aui-icon aui-icon-large icon-overview"></span>
                    <span class="aui-nav-item-label"><?php echo CHtml::encode($this->pageTitle); ?></span>
                  </a>
                </li>
              
                <li>
                  <a id="repo-source-link" class="aui-nav-item "
                    href="mandrill-api-php/src.html"
                    data-ct="sidebar.navigation.repository.source"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                    <span class="aui-icon aui-icon-large icon-source"></span>
                    <span class="aui-nav-item-label">Source</span>
                  </a>
                </li>
              
                <li>
                  <a id="repo-commits-link" class="aui-nav-item "
                    href="mandrill-api-php/commits/index.html"
                    data-ct="sidebar.navigation.repository.commits"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                    <span class="aui-icon aui-icon-large icon-commits"></span>
                    <span class="aui-nav-item-label">Commits</span>
                  </a>
                </li>
              
                <li>
                  <a id="repo-branches-link" class="aui-nav-item "
                    href="mandrill-api-php/branches/index.html"
                    data-ct="sidebar.navigation.repository.branches"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                    <span class="aui-icon aui-icon-large icon-branches"></span>
                    <span class="aui-nav-item-label">Branches</span>
                  </a>
                </li>
              
                <li>
                  <a id="repo-pullrequests-link" class="aui-nav-item "
                    href="mandrill-api-php/pull-requests/index.html"
                    data-ct="sidebar.navigation.repository.pullrequests"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                      <span class="aui-badge" title="9 open pull requests" id="pullrequests-count">9</span>
                    
                    <span class="aui-icon aui-icon-large icon-pull-requests"></span>
                    <span class="aui-nav-item-label">Pull requests</span>
                  </a>
                </li>
              
                <li>
                  <a id="repo-wiki-link" class="aui-nav-item "
                    href="mandrill-api-php/wiki/index.html"
                    data-ct="sidebar.navigation.repository.wiki"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                    <span class="aui-icon aui-icon-large icon-wiki"></span>
                    <span class="aui-nav-item-label">Wiki</span>
                  </a>
                </li>
              
                <li>
                  <a id="repo-downloads-link" class="aui-nav-item "
                    href="mandrill-api-php/downloads.html"
                    data-ct="sidebar.navigation.repository.downloads"
                    data-ct-data=""
                    
                    target="_self"
                    >
                    
                    <span class="aui-icon aui-icon-large icon-downloads"></span>
                    <span class="aui-nav-item-label">Downloads</span>
                  </a>
                </li>
              
            </ul>
          </div>
          <div class="aui-sidebar-group aui-sidebar-group-tier-one repository-settings">
            <div class="aui-nav-heading">
              <strong class="assistive">Settings</strong>
            </div>
            <ul class="aui-nav">
              
              
            </ul>
          </div>
          
        </div>
      </nav>
    </div>
    <div class="aui-sidebar-footer">
      <a class="aui-sidebar-toggle aui-sidebar-footer-tipsy aui-button aui-button-subtle"><span class="aui-icon"></span></a>
    </div>
  </div>
  
  <div id="repo-clone-dialog" class="clone-dialog hidden">
  
  
  <div class="clone-url" data-modules="components/clone/url-dropdown">
  <div class="aui-buttons">
    <a href="mandrill-api-php-2.html"
      class="aui-button aui-dropdown2-trigger" aria-haspopup="true"
      aria-owns="clone-url-dropdown-header">
      <span class="dropdown-text">HTTPS</span>
    </a>
    <div id="clone-url-dropdown-header"
        class="clone-url-dropdown aui-dropdown2 aui-style-default"
        data-aui-alignment="bottom left">
      <ul class="aui-list-truncate">
        <li>
          <a href="mandrill-api-php-2.html"
            
              data-command="git clone https://bitbucket.org/mailchimp/mandrill-api-php.git"
            
            class="item-link https">HTTPS
          </a>
        </li>
        <li>
          <a href="ssh://git@bitbucket.org/mailchimp/mandrill-api-php.git"
            
              data-command="git clone git@bitbucket.org:mailchimp/mandrill-api-php.git"
            
            class="item-link ssh">SSH
          </a>
        </li>
      </ul>
    </div>
    <input type="text" readonly="readonly" class="clone-url-input"
      value="git clone https://bitbucket.org/mailchimp/mandrill-api-php.git">
  </div>
  
  <p>Need help cloning? Visit
    <a href="https://confluence.atlassian.com/x/cgozDQ" target="_blank">Bitbucket 101</a>.</p>
  
</div>
  
  <div class="sourcetree-callout clone-in-sourcetree"
  data-modules="components/clone/clone-in-sourcetree"
  data-https-url="https://bitbucket.org/mailchimp/mandrill-api-php.git"
  data-ssh-url="ssh://git@bitbucket.org/mailchimp/mandrill-api-php.git">

  <div>
    <button class="aui-button aui-button-primary">
      
        Clone in SourceTree
      
    </button>
  </div>

  <p class="windows-text">
    
      <a href="http://www.sourcetreeapp.com/?utm_source=internal&amp;utm_medium=link&amp;utm_campaign=clone_repo_win" target="_blank">Atlassian SourceTree</a>
      is a free Git and Mercurial client for Windows.
    
  </p>
  <p class="mac-text">
    
      <a href="http://www.sourcetreeapp.com/?utm_source=internal&amp;utm_medium=link&amp;utm_campaign=clone_repo_mac" target="_blank">Atlassian SourceTree</a>
      is a free Git and Mercurial client for Mac.
    
  </p>
</div>
</div>
</div>

      
  <div class="aui-page-panel ">
    
  
  
    <div class="aui-page-panel-inner">
      <div id="repo-content" class="aui-page-panel-content" data-modules="repo/index">
        <div class="aui-group repo-page-header">
          <div class="aui-item section-title">
            <h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
          </div>
          <div class="aui-item page-actions">
            
  <div class="aui-buttons" id="repo-clone-sourcetree">
  <button class="aui-button" id="repo-clone-sourcetree-trigger"
    data-modules="repo/overview/sourcetree-dialog"
    title="Clone in SourceTree">
    <span class="aui-icon aui-icon-small aui-iconfont-devtools-clone">Clone in SourceTree</span>
  </button>
</div>
<div id="repo-clone-sourcetree-dialog" class="hidden">
  
  <div class="sourcetree-callout clone-in-sourcetree"
  data-modules="components/clone/clone-in-sourcetree"
  data-https-url="https://bitbucket.org/mailchimp/mandrill-api-php.git"
  data-ssh-url="ssh://git@bitbucket.org/mailchimp/mandrill-api-php.git">

  <div>
    <button class="aui-button aui-button-primary">
      
        Clone in SourceTree
      
    </button>
  </div>

  <p class="windows-text">
    
      <a href="http://www.sourcetreeapp.com/?utm_source=internal&amp;utm_medium=link&amp;utm_campaign=clone_repo_win" target="_blank">Atlassian SourceTree</a>
      is a free Git and Mercurial client for Windows.
    
  </p>
  <p class="mac-text">
    
      <a href="http://www.sourcetreeapp.com/?utm_source=internal&amp;utm_medium=link&amp;utm_campaign=clone_repo_mac" target="_blank">Atlassian SourceTree</a>
      is a free Git and Mercurial client for Mac.
    
  </p>
</div>
</div>
  
  
  <div class="clone-url" data-modules="components/clone/url-dropdown">
  <div class="aui-buttons">
    <a href="mandrill-api-php-2.html"
      class="aui-button aui-dropdown2-trigger" aria-haspopup="true"
      aria-owns="clone-url-dropdown-overview">
      <span class="dropdown-text">HTTPS</span>
    </a>
    <div id="clone-url-dropdown-overview"
        class="clone-url-dropdown aui-dropdown2 aui-style-default"
        data-aui-alignment="bottom left">
      <ul class="aui-list-truncate">
        <li>
          <a href="mandrill-api-php-2.html"
            
              data-command="https://bitbucket.org/mailchimp/mandrill-api-php.git"
            
            class="item-link https">HTTPS
          </a>
        </li>
        <li>
          <a href="ssh://git@bitbucket.org/mailchimp/mandrill-api-php.git"
            
              data-command="git@bitbucket.org:mailchimp/mandrill-api-php.git"
            
            class="item-link ssh">SSH
          </a>
        </li>
      </ul>
    </div>
    <input type="text" readonly="readonly" class="clone-url-input"
      value="https://bitbucket.org/mailchimp/mandrill-api-php.git">
  </div>
  
</div>
  

          </div>
        </div>
        
  <div id="repo-overview" class="aui-group"
    
    
      data-modules="repo/overview/index"
    
    data-admin-url="/mailchimp/mandrill-api-php/admin/hipchat-integration">
  
  
    <div class="aui-item">
        <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
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
      
        <section class="bb-banner" id="signup-banner" data-modules="components/banner">
  <div>
    <p>
      
        Unlimited private and public hosted repositories.  Free for small teams!
      
    </p>
    <a class="aui-button aui-button-primary signup-button" href="https://bitbucket.org/account/signup/">Sign up for free</a>
    <span class="close aui-icon aui-icon-small aui-iconfont-close-dialog" title="Dismiss this banner">Close</span>
  </div>
</section>
      
      
      
        
      

      <section id="repo-activity" class="activity">
        <h2>
          Recent activity
          
          <a href="mandrill-api-php/rss"
            title="Subscribe to activity updates for this repository"
            class="subscribe">
            <span class="aui-icon aui-icon-small aui-iconfont-rss rss-icon"></span>
          </a>
        </h2>
        
          
  <div class="newsfeed">
    
      
        

<article class="news-item pullrequest_unlike">
  
    <a href="https://bitbucket.org/peterculak/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="peterculak" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/peterculak/avatar/48/?ts=1441087108" data-src-url-2x="https://bitbucket.org/account/peterculak/avatar/96/?ts=1441087108">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-None">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 unapproved in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/peterculak/">peterculak</a>
  
    &middot;
    <time datetime="2015-07-23T16:16:45+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_like">
  
    <a href="https://bitbucket.org/peterculak/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="peterculak" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/peterculak/avatar/48/?ts=1441087108" data-src-url-2x="https://bitbucket.org/account/peterculak/avatar/96/?ts=1441087108">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-None">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 approved in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/peterculak/">peterculak</a>
  
    &middot;
    <time datetime="2015-07-23T16:16:44+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_unlike">
  
    <a href="https://bitbucket.org/peterculak/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="peterculak" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/peterculak/avatar/48/?ts=1441087108" data-src-url-2x="https://bitbucket.org/account/peterculak/avatar/96/?ts=1441087108">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-None">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 unapproved in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/peterculak/">peterculak</a>
  
    &middot;
    <time datetime="2015-07-23T16:16:42+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_like">
  
    <a href="https://bitbucket.org/peterculak/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="peterculak" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/peterculak/avatar/48/?ts=1441087108" data-src-url-2x="https://bitbucket.org/account/peterculak/avatar/96/?ts=1441087108">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-None">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 approved in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/peterculak/">peterculak</a>
  
    &middot;
    <time datetime="2015-07-23T16:16:38+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_comment_created">
  
    <a href="https://bitbucket.org/micc83/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Alessandro Benoit" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/micc83/avatar/48/?ts=1436439743" data-src-url-2x="https://bitbucket.org/account/micc83/avatar/96/?ts=1436439743">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-8132904">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 commented on in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/micc83/">Alessandro Benoit</a>
  
    &middot;
    <time datetime="2015-07-09T11:03:39+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_comment_created">
  
    <a href="https://bitbucket.org/micahwalter/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Micah Walter" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/micahwalter/avatar/48/?ts=0" data-src-url-2x="https://bitbucket.org/account/micahwalter/avatar/96/?ts=0">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/11/added-support-to-use-a-proxy-server.html#comment-7747688">added support to use a proxy server</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #11 commented on in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/micahwalter/">Micah Walter</a>
  
    &middot;
    <time datetime="2015-06-23T20:29:50+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_comment_created">
  
    <a href="https://bitbucket.org/sefus/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Roman Dolgopolov" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/sefus/avatar/48/?ts=0" data-src-url-2x="https://bitbucket.org/account/sefus/avatar/96/?ts=0">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/11/added-support-to-use-a-proxy-server.html#comment-7590363">added support to use a proxy server</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #11 commented on in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/sefus/">Roman Dolgopolov</a>
  
    &middot;
    <time datetime="2015-06-17T09:51:45+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_created">
  
    <a href="https://bitbucket.org/micahwalter/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Micah Walter" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/micahwalter/avatar/48/?ts=0" data-src-url-2x="https://bitbucket.org/account/micahwalter/avatar/96/?ts=0">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/11/added-support-to-use-a-proxy-server.html#comment-None">added support to use a proxy server</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #11 created in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/micahwalter/">Micah Walter</a>
  
    &middot;
    <time datetime="2015-06-05T16:32:38+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_like">
  
    <a href="https://bitbucket.org/vicdelfant/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Vic D&#39;Elfant" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/vicdelfant/avatar/48/?ts=0" data-src-url-2x="https://bitbucket.org/account/vicdelfant/avatar/96/?ts=0">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-None">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 approved in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/vicdelfant/">Vic D&#39;Elfant</a>
  
    &middot;
    <time datetime="2015-04-28T17:55:43+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_like">
  
    <a href="https://bitbucket.org/phillprice/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Phill Price" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/phillprice/avatar/48/?ts=1442399985" data-src-url-2x="https://bitbucket.org/account/phillprice/avatar/96/?ts=1442399985">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/6/30x-redirects-in-safe_mode-or-if-an.html#comment-None">30x redirects in safe_mode or if an open_basedir is set</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #6 approved in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/phillprice/">Phill Price</a>
  
    &middot;
    <time datetime="2015-04-15T13:48:00+00:00"></time>
  </div>
</article>
      
    
      
        

<article class="news-item pullrequest_updated">
  
    <a href="https://bitbucket.org/gjerokrsteski/">
      <div class="aui-avatar aui-avatar-small">
          <div class="aui-avatar-inner">
            <img alt="Gjero Krsteski" src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/img/default_avatar/48/user_blue.png" class="deferred-image" data-src-url="https://bitbucket.org/account/gjerokrsteski/avatar/48/?ts=0" data-src-url-2x="https://bitbucket.org/account/gjerokrsteski/avatar/96/?ts=0">
          </div>
      </div>
    </a>
  

  <div class="news-item-title">
    
  
    <a href="mandrill-api-php/pull-requests/8/added-result-fetcher-using-dot-notation.html#comment-None">added result-fetcher using &#34;dot&#34; notation and methods for ssl usage</a>
  

  </div>
  <div class="news-item-description">
    
  
    Pull request #8 updated in 
    
    <a href="mandrill-api-php.html" title="mailchimp/mandrill-api-php">
      mailchimp/mandrill-api-php
    </a>
  
  

  </div>
  
  <div class="news-item-info">
    
    
  

  
    <a href="https://bitbucket.org/gjerokrsteski/">Gjero Krsteski</a>
  
    &middot;
    <time datetime="2015-04-09T13:22:57+00:00"></time>
  </div>
</article>
      
    
  </div>

        
      </section>
    </div>
  </div>

  

  

        
        
        
      </div>
    </div>
  </div>

    </div>
  </div>

  <footer id="footer" role="contentinfo" data-modules="components/footer">
    <section class="footer-body">
      
  <ul>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="Blog"
       href="http://blog.bitbucket.org/">Blog</a>
  </li>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="Home"
       href="https://bitbucket.org/support">Support</a>
  </li>
  <li>
    <a class="support-ga"
       data-support-gaq-page="PlansPricing"
       href="https://bitbucket.org/plans">Plans &amp; pricing</a>
  </li>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="DocumentationHome"
       href="http://confluence.atlassian.com/display/BITBUCKET">Documentation</a>
  </li>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="DocumentationAPI"
       href="http://confluence.atlassian.com/x/IYBGDQ">API</a>
  </li>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="SiteStatus"
       href="http://status.bitbucket.org/">Site status</a>
  </li>
  <li>
    <a class="support-ga" id="meta-info"
       data-support-gaq-page="MetaInfo"
       href="#">Version info</a>
  </li>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="EndUserAgreement"
       href="http://www.atlassian.com/end-user-agreement?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=footer">Terms of service</a>
  </li>
  <li>
    <a class="support-ga" target="_blank"
       data-support-gaq-page="PrivacyPolicy"
       href="http://www.atlassian.com/company/privacy?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=footer">Privacy policy</a>
  </li>
</ul>
<div id="meta-info-content" style="display: none;">
  <ul>
    
      <li>English</li>
    
    <li>
      <a class="support-ga" target="_blank"
         data-support-gaq-page="GitDocumentation"
         href="http://git-scm.com/">Git 2.1.1</a>
    </li>
    <li>
      <a class="support-ga" target="_blank"
         data-support-gaq-page="HgDocumentation"
         href="http://mercurial.selenic.com/">Mercurial 2.9</a>
    </li>
    <li>
      <a class="support-ga" target="_blank"
         data-support-gaq-page="DjangoDocumentation"
         href="https://www.djangoproject.com/">Django 1.7.8</a>
    </li>
    <li>
      <a class="support-ga" target="_blank"
         data-support-gaq-page="PythonDocumentation"
         href="http://www.python.org/">Python 2.7.3</a>
    </li>
    <li>
      <a class="support-ga" target="_blank"
         data-support-gaq-page="DeployedVersion"
         href="#">1b1c5920eaf5 / 1b1c5920eaf5 @ app22</a>
    </li>
  </ul>
</div>
<ul class="atlassian-links">
  <li>
    <a id="atlassian-jira-link" target="_blank"
       title="Track everything – bugs, tasks, deadlines, code – and pull reports to stay informed."
       href="http://www.atlassian.com/software/jira?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=bitbucket_footer">JIRA</a>
  </li>
  <li>
    <a id="atlassian-confluence-link" target="_blank"
       title="Content Creation, Collaboration & Knowledge Sharing for Teams."
       href="http://www.atlassian.com/software/confluence/overview/team-collaboration-software?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=bitbucket_footer">Confluence</a>
  </li>
  <li>
    <a id="atlassian-bamboo-link" target="_blank"
       title="Continuous integration and deployment, release management."
       href="http://www.atlassian.com/software/bamboo/overview?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=bitbucket_footer">Bamboo</a>
  </li>
  <li>
    <a id="atlassian-stash-link" target="_blank"
       title="Git repo management, behind your firewall and Enterprise-ready."
       href="http://www.atlassian.com/software/stash?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=bitbucket_footer">Stash</a>
  </li>
  <li>
    <a id="atlassian-sourcetree-link" target="_blank"
       title="A free Git and Mercurial desktop client for Mac or Windows."
       href="http://www.sourcetreeapp.com/?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=bitbucket_footer">SourceTree</a>
  </li>
  <li>
    <a id="atlassian-hipchat-link" target="_blank"
       title="Group chat and IM built for teams."
       href="http://www.hipchat.com/?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=bitbucket_footer">HipChat</a>
  </li>
</ul>
<div id="footer-logo">
  <a target="_blank"
     title="Bitbucket is developed by Atlassian in San Francisco and Austin."
     href="http://www.atlassian.com/?utm_source=bitbucket&amp;utm_medium=logo&amp;utm_campaign=bitbucket_footer">Atlassian</a>
</div>

    </section>
  </footer>
</div>


  
  


<script src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/jsi18n/en/djangojs.js"></script>

  <script src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/dist/webpack/vendor.js"></script>
  <script src="../../d3oaxc4q5k2d6q.cloudfront.net/m/1b1c5920eaf5/dist/webpack/app.js"></script>



<script>
  (function () {
    var ga = document.createElement('script');
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    ga.setAttribute('async', 'true');
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  }());
</script>


  

<div data-modules="components/mentions/index">
  <script id="mention-result" type="text/html">
    
<div class="aui-avatar aui-avatar-small">
  <div class="aui-avatar-inner">
    <img src="[[avatar_url]]">
  </div>
</div>
[[#display_name]]
  <span class="display-name">[[&display_name]]</span> <small class="username">[[&username]]</small>
[[/display_name]]
[[^display_name]]
  <span class="username">[[&username]]</span>
[[/display_name]]
[[#is_teammate]][[^is_team]]
  <span class="aui-lozenge aui-lozenge-complete aui-lozenge-subtle">teammate</span>
[[/is_team]][[/is_teammate]]

  </script>
  <script id="mention-call-to-action" type="text/html">
    
[[^query]]
<li class="bb-typeahead-item">Begin typing to search for a user</li>
[[/query]]
[[#query]]
<li class="bb-typeahead-item">Continue typing to search for a user</li>
[[/query]]

  </script>
  <script id="mention-no-results" type="text/html">
    
[[^searching]]
<li class="bb-typeahead-item">Found no matching users for <em>[[query]]</em>.</li>
[[/searching]]
[[#searching]]
<li class="bb-typeahead-item bb-typeahead-searching">Searching for <em>[[query]]</em>.</li>
[[/searching]]

  </script>
</div>

  <div data-modules="components/typeahead/emoji/index">
    <script id="emoji-result" type="text/html">
    
<div class="aui-avatar aui-avatar-small">
  <div class="aui-avatar-inner">
    <img src="[[src]]">
  </div>
</div>
<span class="name">[[&name]]</span>

  </script>
  </div>


<div data-modules="components/repo-typeahead/index">
  <script id="repo-typeahead-result" type="text/html">
    <span class="aui-avatar aui-avatar-project aui-avatar-xsmall">
  <span class="aui-avatar-inner">
    <img src="[[avatar]]">
  </span>
</span>
<span class="owner">[[&owner]]</span>/<span class="slug">[[&slug]]</span>

  </script>
</div>
<script id="share-form-template" type="text/html">
    

<div class="error aui-message hidden">
  <span class="aui-icon icon-error"></span>
  <div class="message"></div>
</div>
<form class="aui">
  <table class="widget bb-list aui">
    <thead>
    <tr class="assistive">
      <th class="user">User</th>
      <th class="role">Role</th>
      <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
      <tr class="form">
        <td colspan="2">
          <input type="text" class="text bb-user-typeahead user-or-email"
                 placeholder="Username or email address"
                 autocomplete="off"
                 data-bb-typeahead-focus="false"
                 [[#disabled]]disabled[[/disabled]]>
        </td>
        <td class="actions">
          <button type="submit" class="aui-button aui-button-light" disabled>Add</button>
        </td>
      </tr>
    </tbody>
  </table>
</form>

  </script>
<script id="share-detail-template" type="text/html">
    

[[#username]]
<td class="user
    [[#hasCustomGroups]]custom-groups[[/hasCustomGroups]]"
    [[#error]]data-error="[[error]]"[[/error]]>
  <div title="[[displayName]]">
    <a href="/[[username]]/" class="user">
      <span class="aui-avatar aui-avatar-xsmall">
        <span class="aui-avatar-inner">
          <img src="[[avatar]]">
        </span>
      </span>
      <span>[[displayName]]</span>
    </a>
  </div>
</td>
[[/username]]
[[^username]]
<td class="email
    [[#hasCustomGroups]]custom-groups[[/hasCustomGroups]]"
    [[#error]]data-error="[[error]]"[[/error]]>
  <div title="[[email]]">
    <span class="aui-icon aui-icon-small aui-iconfont-email"></span>
    [[email]]
  </div>
</td>
[[/username]]
<td class="role
    [[#hasCustomGroups]]custom-groups[[/hasCustomGroups]]">
  <div>
    [[#group]]
      [[#hasCustomGroups]]
        <select class="group [[#noGroupChoices]]hidden[[/noGroupChoices]]">
          [[#groups]]
            <option value="[[slug]]"
                [[#isSelected]]selected[[/isSelected]]>
              [[name]]
            </option>
          [[/groups]]
        </select>
      [[/hasCustomGroups]]
      [[^hasCustomGroups]]
      <label>
        <input type="checkbox" class="admin"
            [[#isAdmin]]checked[[/isAdmin]]>
        Administrator
      </label>
      [[/hasCustomGroups]]
    [[/group]]
    [[^group]]
      <ul>
        <li class="permission aui-lozenge aui-lozenge-complete
            [[^read]]aui-lozenge-subtle[[/read]]"
            data-permission="read">
          read
        </li>
        <li class="permission aui-lozenge aui-lozenge-complete
            [[^write]]aui-lozenge-subtle[[/write]]"
            data-permission="write">
          write
        </li>
        <li class="permission aui-lozenge aui-lozenge-complete
            [[^admin]]aui-lozenge-subtle[[/admin]]"
            data-permission="admin">
          admin
        </li>
      </ul>
    [[/group]]
  </div>
</td>
<td class="actions
    [[#hasCustomGroups]]custom-groups[[/hasCustomGroups]]">
  <div>
    <a href="#" class="delete">
      <span class="aui-icon aui-icon-small aui-iconfont-remove">Delete</span>
    </a>
  </div>
</td>

  </script>
<script id="share-team-template" type="text/html">
    

<div class="clearfix">
  <span class="team-avatar-container">
    <span class="aui-avatar aui-avatar-medium">
      <span class="aui-avatar-inner">
        <img src="[[avatar]]">
      </span>
    </span>
  </span>
  <span class="team-name-container">
    [[display_name]]
  </span>
</div>
<p class="helptext">
  
    Existing users are granted access to this team immediately.
    New users will be sent an invitation.
  
</p>
<div class="share-form"></div>

  </script>


  





<aui-inline-dialog

      id="super-touch-point-dialog"
      data-aui-alignment="bottom right"

      
      data-aui-alignment-static="true"
      data-aui-responds-to="toggle"
      data-modules="header/help-menu,js/connect/connect-views,js/connect/super-touch-point"
      aria-hidden="true">

    <div id="ace-stp-section" class="no-touch-point">
      <div id="ace-stp-help-section">
        <h1 class="ace-stp-heading">Help</h1>

        <form id="ace-stp-search-form" class="aui" target="_blank" method="get"
            action="https://support.atlassian.com/customer/search">
          <span id="stp-search-icon" class="aui-icon aui-icon-large aui-iconfont-search"></span>
          <input id="ace-stp-search-form-input" name="q" class="text" type="text" placeholder="Ask a question">
        </form>

        <ul id="ace-stp-help-links">
          <li>
            <a class="support-ga" data-support-gaq-page="DocumentationHome"
                href="https://confluence.atlassian.com/x/bgozDQ" target="_blank">
              Online help
            </a>
          </li>
          <li>
            <a class="support-ga" data-support-gaq-page="GitTutorials"
                href="https://www.atlassian.com/git?utm_source=bitbucket&amp;utm_medium=link&amp;utm_campaign=help_dropdown&amp;utm_content=learn_git"
                target="_blank">
              Learn Git
            </a>
          </li>
          <li>
            <a id="keyboard-shortcuts-link"
               href="#">Keyboard shortcuts</a>
          </li>
          <li>
            <a href="https://bitbucket.org/whats-new/" id="features-link">
              Latest features
            </a>
          </li>
          <li>
            <a class="support-ga" data-support-gaq-page="DocumentationTutorials"
                href="https://confluence.atlassian.com/x/Q4sFLQ" target="_blank">
              Bitbucket tutorials
            </a>
          </li>
          <li>
            <a class="support-ga" data-support-gaq-page="SiteStatus"
                href="http://status.bitbucket.org/" target="_blank">
              Site status
            </a>
          </li>
          <li>
            <a class="support-ga" data-support-gaq-page="Home" href="https://bitbucket.org/support">
              Support
            </a>
          </li>

        </ul>
      </div>

      
    </div>


</aui-inline-dialog>

  




</body>
</html>
