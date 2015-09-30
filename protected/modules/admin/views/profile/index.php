<?php if (Yii::app()->user->hasFlash('msg')): ?>
    <div class="alert alert-info">
        <?php echo Yii::app()->user->getFlash('msg'); ?>
    </div>
<?php endif; ?>			
<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Profile</h3>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <div class="control-group">
            <div class="row-fluid">
                <div class="span12">
                    <div class="vcard">
                        <ul style="margin:0 !important;">
                            <li class="v-heading">
                                Account info
                            </li>
                            <li>
                                <span class="item-key">Username</span>
                                <div class="vcard-item"><?php echo $model->username; ?></div>
                            </li>
                            <li>
                                <span class="item-key">Email</span>
                                <div class="vcard-item"><?php echo $model->email; ?></div>
                            </li>
                            <li>
                                <span class="item-key">Registered</span>
                                <div class="vcard-item"><?php echo $model->registered; ?></div>
                            </li>
                            <li>
                                <span class="item-key">Lastvisited</span>
                                <div class="vcard-item"><?php echo $model->lastvisited; ?></div>
                            </li>
                            <li>
                                <span class="item-key">Status</span>
                                <div class="vcard-item"><?php echo Yii::app()->params["status"][$model->status]; ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-gebo" onclick="window.location.href = '<?php echo Yii::app()->createUrl('admin/profile/changepassword'); ?>';
                        return false;">Change Password</button>
        <?php $this->endWidget(); ?>
        <?php
        $form_profile = $this->beginWidget('CActiveForm', array(
            'id' => 'profile-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <div class="control-group">
            <div class="row-fluid">
                <div class="span12">
                    <div class="vcard">
                        <ul style="margin:0 !important;">
                            <li class="v-heading">
                                Profile info
                            </li>
                            <li>
                                <span class="item-key">Full name</span>
                                <div class="vcard-item"><?php echo $modelProfile->fname . ' ' . $modelProfile->lname; ?></div>
                            </li>
                            <li>
                                <span class="item-key"><?php echo $form_profile->labelEx($modelProfile, 'gender'); ?></span>
                                <div class="vcard-item"><?php echo Yii::app()->params["gender"][$modelProfile->gender]; ?></div>
                            </li>
                            <li>
                                <span class="item-key"><?php echo $form_profile->labelEx($modelProfile, 'birthday'); ?></span>
                                <div class="vcard-item"><?php echo $modelProfile->birthday; ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-gebo" onclick="window.location.href = '<?php echo Yii::app()->createUrl('admin/profile/update'); ?>';
                        return false;">Update Profile</button>
        <?php $this->endWidget(); ?>
    </div>
</div>