<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Đăng nhập - ' . Yii::app()->name;
?>

<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Đăng nhập</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="<?php echo Yii::app()->urlManager->createUrl('/user/forgotpassword') ?>">Quên mật khẩu?</a></div>
        </div>     

        <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
            ));
            ?>
            <?php echo $form->errorSummary($model, "", ""); ?>
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Tài khoản')); ?>
            </div>

            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Mật khẩu')); ?>
            </div>

            <div class="input-group">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'rememberMe'); ?> Ghi nhớ
                    </label>
                </div>
            </div>

            <div style="margin-top:10px" class="form-group">
                <div class="col-sm-12 controls">
                    <?php echo CHtml::submitButton('Đăng nhập', array('class' => 'btn btn-success')); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 control">
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                        Bạn chưa có tải khoản? 
                        <a href="<?php echo Yii::app()->urlManager->createUrl('/user/register') ?>">
                            Đăng ký ngay
                        </a>
                    </div>
                </div>
            </div>    
            <?php $this->endWidget(); ?>   
        </div>                     
    </div>  
</div>