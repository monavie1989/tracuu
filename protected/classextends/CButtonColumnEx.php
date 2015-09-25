<?php
Yii::import('zii.widgets.grid.CButtonColumn');
class CButtonColumnEx extends CButtonColumn
{
	protected function initDefaultButtons()
	{
		if($this->viewButtonImageUrl===null)
			$this->viewButtonImageUrl=Yii::app()->baseUrl.'/theme_admin/img/ico/view.png';
		if($this->updateButtonImageUrl===null)
			$this->updateButtonImageUrl=Yii::app()->baseUrl.'/theme_admin/img/ico/update.png';
		if($this->deleteButtonImageUrl===null)
			$this->deleteButtonImageUrl=Yii::app()->baseUrl.'/theme_admin/img/ico/delete.png';
		parent::initDefaultButtons();
	}
}
