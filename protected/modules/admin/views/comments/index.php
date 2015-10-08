<?php
foreach ($dataProvider as $data) {
    ?>
    <div class="formSep comments_item">
        <div class="search_content">
            <h4>
                <a href="javascript:void(0)" class="sepV_a"><?php echo $data->comment_subject; ?></a>- <small><?php echo $data->comment_date; ?></small>
            </h4>
            <p class="sepH_a">
                <small><?php echo $data->comment_author_name; ?></small> - <small><?php echo $data->comment_author_email; ?></small>
            </p>
            <p class="sepH_b item_description"><?php echo nl2br($data->comment_content); ?></p>
        </div>
        <div class="btn-group">
            <a class="btn" href="javascript:void(0)" onclick="return edit_comments(<?php echo $data->comment_id; ?>);">Edit</a>
            <a class="btn" href="javascript:void(0)" onclick="return delete_comments(<?php echo $data->comment_id; ?>);">Delete</a>
        </div>
    </div>
    <?php
}