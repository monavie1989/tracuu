<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Tự động scan task</h3>
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
        Danh sách module có sẵn
        <table class="table">
        <?php
        foreach ($data as $k=>$v)
        {
            echo '<tr><td>'.$v.'</td><td><a href="javascript:void(0);" data-role-value="'.$v.'" class="addrole"><button class="btn btn-primary">Thêm</button></a></td></tr>';
        }
        ?>
        </table>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.addrole').click(function(){
        var rolename = $(this).attr('data-role-value');
        var roletype = 5;
        var elem = $(this);
        $(this).children().html('Đang thêm...');
        $.post('<?php echo Yii::app()->createUrl('admin/task/AjaxAddTask')?>',{name:rolename,type:roletype},function(data){
            var result = $.parseJSON(data);
            //alert(result.message);
            //elem.remove();
            elem.parent().html(result.message);
        });
    });
});
</script>