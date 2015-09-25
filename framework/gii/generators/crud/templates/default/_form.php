<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
<div class="formSep">
<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
	echo '	<div class="row-fluid">'."\n";
	switch ($column->dbType) {
		case 'text':
		case 'longtext':
			echo '		<div class="span12">'."\n";
			break;

		default:
			echo '		<div class="span6">'."\n";
			break;
	}
?>
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
			<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
			<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
		</div>
	</div>

<?php
}
?>
</div><!-- form -->
<div class="form-actions">
	<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Thêm mới' : 'Cập nhật',array('class'=>'btn btn-inverse')); ?>\n"; ?>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
