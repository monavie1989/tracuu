<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
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
<?php $this->endContent(); ?>