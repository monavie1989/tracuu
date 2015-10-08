<?php
/* @var $this SearchController */

$this->breadcrumbs=array(
	'Search',
);
?>
<h1>Kết quả tìm kiếm cho từ khóa "<?php echo $keyword ?>"</h1>

<?php
if(empty($post)) {
    echo 'Không tìm thấy bài viết theo yêu cầu.';
} else {
    foreach ($post as $item) {
        echo '<div class="row">';
            echo '<div class="title"><a href="'.Yii::app()->createUrl('site/post',array('id'=>$item['post_id'])).'">'.$item['post_title'].'</a></div>';
            echo '<p>Lớp vỏ Trái Đất có thể bị thay đổi hình dạng dưới tác động của những phiến băng khổng lồ di chuyển, hậu quả của nóng lên toàn cầu.</p>';
        echo '</div>';
    }
}
?>
 <?php
    $this->widget('CLinkPager', array(
        'currentPage'=>$pages->getCurrentPage(),
        'pages' => $pages,
        'header'=>'',
        'firstPageLabel'=>'<<',
        'lastPageLabel'=>'>>',
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'selectedPageCssClass'=>'active',
        'htmlOptions'=>array('class'=>'pagination')
    ));
?>
