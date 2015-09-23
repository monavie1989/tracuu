<div class="aui-sidebar repo-sidebar">
  <div id="left-sidebar" class="aui-sidebar-wrapper" style="height: 9999px;">
    <div class="aui-sidebar-body">
      <header class="aui-page-header">
        <div class="aui-page-header-inner">
          <div class="aui-page-header-image">
            <a href="#" id="repo-avatar-link" class="repo-link">
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
            <div class="aui-sidebar-group aui-sidebar-group-tier-one repository-sections">
                <div class="aui-nav-heading">
                    <strong>Quản lý người dùng</strong>
                </div>
                <div id="mainmenu">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('class' => 'aui-nav'),
                        'activeCssClass'=>'aui-nav-selected',
                        'encodeLabel'=>false,
                        'items'=>array(
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large icon-overview"></span><span class="aui-nav-item-label">Danh sách người dùng</span>',
                                'url'=>array('/admin/user'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                    'original-title'=>'Danh sách người dùng',
                                ),
                                'visible'=>Yii::app()->user->checkAccess('admin.user.index')
                            ),
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large icon-overview"></span><span class="aui-nav-item-label">Nhóm người dùng</span>',
                                'url'=>array('/admin/userrole'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                    'original-title'=>'Nhóm người dùng',
                                ),
                                'visible'=>Yii::app()->user->checkAccess('admin.userrole.index')
                            ),
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large icon-overview"></span><span class="aui-nav-item-label">Quyền người dùng</span>',
                                'url'=>array('/admin/task'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                    'original-title'=>'Nhóm người dùng',
                                ),
                                'visible'=>Yii::app()->user->checkAccess('admin.userrole.index')
                            ),
                        ),
                    )); ?>
                </div><!-- mainmenu -->
            </div>
            
            <div class="aui-sidebar-group aui-sidebar-group-tier-one repository-sections">
                <div class="aui-nav-heading">
                    <strong>Quản lý bài viết</strong>
                </div>
                <div id="mainmenu">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('class' => 'aui-nav'),
                        'activeCssClass'=>'aui-nav-selected',
                        'encodeLabel'=>false,
                        'items'=>array(
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large icon-overview"></span><span class="aui-nav-item-label">Danh sách bài viết</span>',
                                'url'=>array('/admin/user'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                    'original-title'=>'Danh sách bài viết',
                                ),
                                'visible'=>!Yii::app()->user->isGuest
                            ),
                            array(
                                'label'=>'<span class="aui-icon aui-icon-large aui-iconfont-admin-jira-settings"></span><span class="aui-nav-item-label">Danh mục bài viết</span>',
                                'url'=>array('/admin/userrole'),
                                'linkOptions'=> array(
                                    'class' => 'aui-nav-item ',
                                    'original-title'=>'Danh mục bài viết',
                                ),
                                'visible'=>Yii::app()->user->checkAccess('admin.userrole.index')
                            ),
                        ),
                    )); ?>
                </div><!-- mainmenu -->
            </div>
        </div>
      </nav>
    </div>
    <div class="aui-sidebar-footer">
      <a class="aui-sidebar-toggle aui-sidebar-footer-tipsy aui-button aui-button-subtle"><span class="aui-icon"></span></a>
    </div>
  </div>
</div>