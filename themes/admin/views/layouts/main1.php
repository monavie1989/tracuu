<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
    <title>AUI - Default Page</title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/aui/css/aui.css" media="all">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/aui/js/aui.js"></script>
    </head>
    <body class=""><!-- For a normal page, omit all 'aui-page-' classes here -->
    <div id="page">
      <header id="header" role="banner">
        <nav class="aui-header aui-dropdown2-trigger-group" role="navigation">
          <div class="aui-header-inner">
            <div class="aui-header-primary">
              <h1 id="logo" class="aui-header-logo aui-header-logo-aui"><a href="http://example.com/"><span class="aui-header-logo-device">AUI</span></a></h1>
              <ul class="aui-nav">
                <li><a href="http://example.com/">Nav</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
    <section id="content" role="main">
        <div class="aui-page-panel">
            <div class="aui-page-panel-inner">
                <div class="aui-page-panel-nav">
                    <!-- content such as a vertical nav -->
                    <?php $this->widget('application.widgets.AdminMenu'); ?>
                </div>
                <section class="aui-page-panel-content">
                    <!-- main area for content -->
                    <?php echo $content; ?>
                </section>
                <aside class="aui-page-panel-sidebar">
                    <!-- tangental content here -->
                </aside>
            </div>
        </div>
</section>
      <footer id="footer" role="contentinfo">
        <section class="footer-body">
          <ul>
            <li>I &hearts; AUI</li>
          </ul>
          <div id="footer-logo"><a href="http://www.atlassian.com/" target="_blank">Atlassian</a></div>
        </section>
      </footer>
    </div>
    </body>
</html>