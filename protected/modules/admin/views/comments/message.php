<div class="row-fluid">
    <div class="span12">
        <div id="message_modal">
            <p><?php echo $message; ?></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#comment_list").load("<?php echo Yii::app()->createUrl('/admin/comments/index', array('post_id' => $model->comment_post_id)) ?>");
    })
</script>