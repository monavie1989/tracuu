<?php $this->body_class='post'; ?>
<div class="search-item">
    <div class="col-xs-12">
        <h1><?php echo $model->post_title; ?></h1>
        <p style="text-align: justify;"><span class="datetime"><?php echo date('d/m/Y H:i A',  strtotime($model->post_date)); ?></span> - <strong>
        <?php echo strip_tags($model->post_content_head); ?></strong></p>
        <?php echo $model->post_content_body; ?>
        <?php echo $model->post_content_foot; ?>
    </div>
<!--    <div class="col-xs-2">
        <div class="stb-box stb-facebook">
            <span class="stb-text"><img src="<?php echo Yii::app()->baseUrl; ?>/common/images/share_video_f.jpg"/>FACEBOOK</span>
        </div>
        <div class="stb-box stb-twitter">
            <span class="stb-text"><img src="<?php echo Yii::app()->baseUrl; ?>/common/images/share_video_t.jpg"/>TWITTER</span>
        </div>
    </div>-->
<!--    <div class="col-xs-3">
        <img src="<?php echo Yii::app()->baseUrl; ?>/common/images/project_image_1.jpg" style="width: 250px;"/>
        <img src="<?php echo Yii::app()->baseUrl; ?>/common/images/project_image_2.jpg" style="width: 250px;margin-top:10px;"/>
    </div>-->
</div>