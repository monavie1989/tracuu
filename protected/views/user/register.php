<?php
/* @var $this RegisterFormController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */
$this->body_class = 'register';
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <h2>Đăng ký tài khoản</h2>
        <hr class="colorgraph">
        <?php if($model->hasErrors()){ ?>
        <div class="bg-danger">
        <?php echo CHtml::errorSummary($model); ?>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <?php echo $form->textField($model,'fname',array('class'=>'form-control','placeholder'=>'Họ')); ?>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <?php echo $form->textField($model,'lname',array('class'=>'form-control','placeholder'=>'Tên')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
                <?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>'Tài khoản')); ?>
        </div>
        <div class="form-group">
            <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'Email')); ?>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>'Mật khẩu')); ?>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <?php echo $form->passwordField($model,'password2',array('class'=>'form-control','placeholder'=>'Xác nhận mật khẩu')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->textField($model,'phone',array('class'=>'form-control','placeholder'=>'Điện thoại')); ?>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker'>
                        <?php echo $form->textField($model,'birthday',array('class'=>'form-control','placeholder'=>'Ngày sinh')); ?>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <?php echo $form->dropDownList($model,'gender',array('0'=>'Nam','1'=>'Nữ'),array('class'=>'form-control','placeholder'=>'Giới tính')); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model,'check'); ?>
                        Đồng ý với các  <a href="#" data-toggle="modal" data-target="#t_and_c_m">Điều khoản sử dụng</a> của website.
                    </label>
                </div>
            </div>
        </div>

        <hr class="colorgraph">
        <div class="row">            
            <div class="col-xs-6 col-md-6"><?php echo CHtml::submitButton('Đăng ký', array('class'=>'btn btn-primary btn-block btn-lg')); ?></div>
            <div class="col-xs-6 col-md-6"><a href="<?php echo Yii::app()->urlManager->createUrl(Yii::app()->user->loginUrl); ?>" class="btn btn-success btn-block btn-lg">Đăng nhập</a></div>
        </div>
	</div>
</div>
<?php $this->endWidget(); ?>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/moment-with-locales.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
    	    format: 'DD/MM/YYYY',
            locale :'vi'
    	});
    });
</script>