<div class="login_box">	
	<!-- Login Form -->
	<?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login_form',
        'enableClientValidation' => false,
		'enableAjaxValidation'=>false,
		'clientOptions' => array(
			'inputContainer' => 'div',
            'validateOnSubmit' => false,
		),
		'errorMessageCssClass'=>'error',
    ));
    ?>
		<div class="top_b">Sign in to Backend</div>
		<div class="cnt_b">
			<div class="formRow">
				<div class="input-prepend<?php if(!empty($model->errors['username'])){ echo ' f_error';}?>">
					<span class="add-on"><i class="icon-user"></i></span>
					<?php echo $form->textField($model, 'username', array('placeholder' => 'Username','id'=>'username')); ?>
					<?php echo $form->error($model, 'username'); ?>
				</div>
			</div>
			<div class="formRow">
				<div class="input-prepend<?php if(!empty($model->errors['password'])){ echo ' f_error';}?>">
					<span class="add-on"><i class="icon-lock"></i></span>
					<?php echo $form->passwordField($model, 'password', array('placeholder' => 'Password','id'=>'password')); ?>
					<?php echo $form->error($model, 'password'); ?>
				</div>
			</div>
			<div class="formRow clearfix">
				<label class="checkbox"><input type="checkbox" /> Remember me</label>
			</div>
		</div>
		<div class="btm_b clearfix">
			<button class="btn btn-inverse pull-right" type="submit">Sign In</button>
		</div>  
	<?php $this->endWidget(); ?>
	<div class="links_b links_btm clearfix">
		<span class="linkform"><a href="<?php echo Yii::app()->createUrl('admin/forgot');?>">Forgot password?</a></span>
	</div>
	<!-- End Login Form -->
</div>
<!-- End Login Form -->
<script src="<?php echo Yii::app()->baseUrl;?>/theme_admin/js/jquery.actual.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/theme_admin/lib/validation/jquery.validate.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl;?>/theme_admin/bootstrap/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		
		//* boxes animation
		form_wrapper = $('.login_box');
		function boxHeight() {
			form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);	
		};
		form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
	});
</script>