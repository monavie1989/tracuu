<?php
$this->breadcrumbs = array(
    'Search',
);
?>
<h1>Kết quả tìm kiếm cho từ khóa "<?php echo $keyword ?>"</h1>

<?php
if (empty($post)) {
    echo 'Không tìm thấy bài viết theo yêu cầu.';
} else {
    $Highlight = new Highlight;
    foreach ($post as $item) {
        echo '<div class="item-search">';
        echo '<div class="post-title"><a href="' . Yii::app()->createUrl('site/post', array('id' => $item['post_id'])) . '">' . $Highlight->toHighlight($item['post_title'], $keyword) . '</a></div>';
        echo '<div class="post-short-content">' . $Highlight->toHighlight($item['post_content'], $keyword) . '</div>';
        echo '</div>';
    }
}
?>
<?php
$this->widget('CLinkPager', array(
    'currentPage' => $pages->getCurrentPage(),
    'pages' => $pages,
    'header' => '',
    'firstPageLabel' => '<<',
    'lastPageLabel' => '>>',
    'prevPageLabel' => '<',
    'nextPageLabel' => '>',
    'selectedPageCssClass' => 'active',
    'htmlOptions' => array('class' => 'pagination')
));
?>
