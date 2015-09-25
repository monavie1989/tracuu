 <div class="row-fluid">
	<div class="span12">
		<h3 class="heading">Profile - Change Profile</h3>
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'profile-form',
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
					<?php echo $form->labelEx($model, 'fname', array('class' => 'control-label')); ?>
					<div class="controls">
						<div class="sepH_b input-prepend<?php if($model->errors['fname']){ echo ' f_error';}?>">
							<?php echo $form->textField($model, 'fname', array('class' => 'input-xlarge')); ?>
							<?php echo $form->error($model, 'fname'); ?>
						</div>
					</div>
					<?php echo $form->labelEx($model, 'lname', array('class' => 'control-label')); ?>
					<div class="controls">
						<div class="sepH_b input-prepend<?php if($model->errors['lname']){ echo ' f_error';}?>">
							<?php echo $form->textField($model, 'lname', array('class' => 'input-xlarge')); ?>
							<?php echo $form->error($model, 'lname'); ?>
						</div>
					</div>
					<?php echo $form->labelEx($model, 'gender', array('class' => 'control-label')); ?>
					<div class="controls">
						<div class="sepH_b input-prepend">
							<?php echo CHtmlEx::activeRadioButtonList($model, 'gender', Yii::app()->params['gender']); ?>
						</div>
					</div>
					<?php echo $form->labelEx($model, 'birthday', array('class' => 'control-label')); ?>
					<div class="controls">
						<div class="sepH_b input-prepend<?php if($model->errors['birthday']){ echo ' f_error';}?>">
							<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'model' => $model,
								'attribute' => 'birthday',
								'options'=>array(
									'dateFormat' => 'yy-mm-dd',
									'changeMonth'=>true,
									'changeYear'=>true,
									'yearRange'=>(date('Y')-100).':'.date('Y'),
								),
								'htmlOptions' => array(
									''
								),
							));
							?>
							<?php echo $form->error($model, 'birthday'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-gebo">Change Password</button>
		<?php $this->endWidget(); ?>
	</div>
</div>