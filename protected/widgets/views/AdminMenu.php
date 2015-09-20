<div class="aui-sidebar repo-sidebar" data-modules="components/repo-sidebar">
  <div class="aui-sidebar-wrapper" style="height: 628px;">
    <div class="aui-sidebar-body">
      <header class="aui-page-header">
        <div class="aui-page-header-inner">
          <div class="aui-page-header-image">
            <a href="mandrill-api-php.html" id="repo-avatar-link" class="repo-link">
              <span class="aui-avatar aui-avatar-large aui-avatar-project">
                <span class="aui-avatar-inner">
                  <img  src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/images/default_avatar/64/user_blue.png" class="deferred-image" alt="">
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
        </div>
      </nav>
    </div>
    <div class="aui-sidebar-footer">
      <a class="aui-sidebar-toggle aui-sidebar-footer-tipsy aui-button aui-button-subtle"><span class="aui-icon"></span></a>
    </div>
  </div>
</div>