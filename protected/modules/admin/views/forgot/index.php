<div class="login_box">
	<!-- Forgot Form -->
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-forgot-form',
		'enableClientValidation' => false,
		'enableAjaxValidation'=>false,
		'clientOptions' => array(
			'inputContainer' => 'div',
            'validateOnSubmit' => false,
		),
		'errorMessageCssClass'=>'error',
	));
	?>
		<div class="top_b">Can't sign in?</div>
		<?php if(Yii::app()->user->hasFlash('msg')): ?>
			<div class="alert alert-info alert-login">
				<?php echo Yii::app()->user->getFlash('msg'); ?>
			</div>
		<?php else: ?>
			<div class="alert alert-info alert-login">
				Please enter your email address. You will receive a link to create a new password via email.
			</div>
			<div class="cnt_b">
				<div class="formRow clearfix">
					<div class="input-prepend<?php if(!empty($model->errors['email'])){ echo ' f_error';}?>">
						<span class="add-on">@</span>
						<?php echo $form->textField($model, 'email', array('placeholder' => 'Your email address')); ?>
						<?php echo $form->error($model, 'email'); ?>
					</div>
				</div>
			</div>
		<div class="btm_b tac">
			<?php echo CHtml::submitButton("Request New Password", array('class' => 'btn btn-inverse')); ?>
		</div>
		<?php endif; ?>
	<?php $this->endWidget(); ?>
	<!-- End Forgot Form -->
	<div class="links_b links_btm clearfix">
		<span class="linkform">Never mind, <a href="<?php echo Yii::app()->createUrl('admin/login');?>">send me back to the sign-in screen</a></span>
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