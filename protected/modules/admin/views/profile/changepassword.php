 <div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Profile - Change Password</h3>
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'changepassword-form',
			'htmlOptions' => array(
				'clsas'=>'form-horizontal'
			),
			'enableClientValidation' => false,
			'enableAjaxValidation'=>false,
			'clientOptions' => array(
				'inputContainer' => 'div',
				'validateOnSubmit' => false,
			),
			'errorMessageCssClass'=>'error',
				));
		?>
		<div class="row-fluid">
			<div class="span8">
				<div class="control-group formSep">
					<div class="controls">
						<div class="sepH_b input-prepend<?php if($model->errors['o_password']){ echo ' f_error';}?>">
							<span class="help-block">Enter your old password</span>
							<?php echo $form->passwordField($model, 'o_password', array('class' => 'input-xlarge')); ?>
							<?php echo $form->error($model, 'o_password'); ?>
						</div>
						<div class="sepH_b input-prepend<?php if($model->errors['n_password']){ echo ' f_error';}?>">
							<span class="help-block">New password</span>
							<?php echo $form->passwordField($model, 'n_password', array('class' => 'input-xlarge')); ?>
							<?php echo $form->error($model, 'n_password'); ?>
						</div>
						<div class="sepH_b input-prepend<?php if($model->errors['n_password_re']){ echo ' f_error';}?>">
							<span class="help-block">New password repeat</span>
							<?php echo $form->passwordField($model, 'n_password_re', array('class' => 'input-xlarge')); ?>
							<?php echo $form->error($model, 'n_password_re'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-gebo">Change Password</button>
		<?php $this->endWidget(); ?>
	</div>
</div>