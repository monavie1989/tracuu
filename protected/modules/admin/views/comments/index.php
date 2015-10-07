<?php
foreach ($dataProvider as $data) {
    ?>
    <div class="formSep comments_item">
        <div class="search_content">
            <h4>
                <a href="javascript:void(0)" class="sepV_a"><?php echo $data->comment_subject; ?></a><br><small>Từ <?php echo $data->comment_author_name; ?> - <?php echo $data->comment_date; ?></small>
            </h4>
            <p class="sepH_a">

            </p>
            <p class="sepH_b item_description"><?php echo nl2br($data->comment_content); ?></p>
        </div>
        <div class="btn-group">
            <?php
            if (Yii::app()->user->id == $data->comment_user_id) {
                echo '
                <a class="btn" href="javascript:void(0)" onclick="return edit_comments(' . $data->comment_id . ');">Sửa</a>
                <a class="btn" href="javascript:void(0)" onclick="return delete_comments(' . $data->comment_id . ');">Xóa</a>';
            } else {
//                echo '<a class="btn" href="javascript:void(0)" onclick="return reply_comments(' . $data->comment_id . ');">Trả lời</a>';
            }
            ?>
        </div>
    </div>
    <?php
}