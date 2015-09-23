<?php
/* @var $this TaskController */
/* @var $model UserAuth */

$this->breadcrumbs=array(
	'Quản lý quyền'=>array('index'),
	'Thêm quyền mới',
);

$this->menu=array(
	array('label'=>'Danh sách quyền', 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<table class="table">
<?php
foreach ($data as $k=>$v)
{
    echo '<tr><td>'.$k;
    if($v==7)
    {
        if(preg_match('/((\w+.)\w+.)/', $k, $matches))
                echo ' - ' . $matches[1] . '* - ' . $matches[2] . '*';
    }
    
    if($v==6)
    {
        if(preg_match('/(\w+.)/', $k, $matches))
                echo ' - ' . $matches[1] . '*';
    }
    
    echo '</td><td>'.$v.'</td><td>???</td></tr>';
}
?>
</table>