<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="vi">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/search.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/css/bootstrap.css">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
</head>

<body class="search-result">

<div class="wrapper" id="page">
	<div id="header">
            <div class="form-search">
                <form action="">
                    <input type="text" name="q" size="60"/>
                    <input type="submit" value="Tìm kiếm"/>
                    <span class="advance">Nâng cao</span>
                    <div id="advanced-search" style="display: none; position: absolute; top: 57px; left: 0px; height: 50px; width: 100%;padding: 0 40px;">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn dropdown-toggle" id="select-category">Tất cả danh mục  <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li data-value=""><a href="#">Tất cả danh mục</a></li>
                                <li data-value="1"><a href="#">Danh mục 1</a></li>
                                <li data-value="2"><a href="#">Danh mục 2</a></li>
                                <li data-value="3"><a href="#">Danh mục 3</a></li>
                            </ul>
                            <input type="hidden" name="category" class="category">
                        </div>
                    </div>
                </form>
                
            </div>
            <div id="mainmenu">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Trang chủ', 'url'=>Yii::app()->request->getBaseUrl(true)),
                        array('label'=>'Đăng nhập', 'url'=>array(Yii::app()->user->loginUrl), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Đăng ký', 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Tài khoản', 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Thoát', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                )); ?>
            </div><!-- mainmenu -->
        </div><!-- header -->
        
        <div class="content" style="">
            <?php echo $content; ?>
        </div>
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.js"></script>
<script>
    $(document).ready(function(){
        var advanced = localStorage.getItem('advanced');
        if (advanced == true || advanced == 'true') {
            $('#advanced-search').css('display','block');
            $('.content').css('margin-top', $('#advanced-search').height());
        }
        //if(advanced == null)
        $('.advance').on('click',function(){
            $('#advanced-search').toggle().promise().done(function(){
                advanced = localStorage.getItem('advanced');
                if(advanced == true || advanced == 'true') {
                    localStorage.setItem('advanced', 'false');
                    $('.content').css('margin-top','');
                }
                else if(advanced == false || advanced == 'false') {                    
                    localStorage.setItem('advanced', 'true');
                    $('.content').css('margin-top', $('#advanced-search').height());
                }
            });            
        });
        
        $('.dropdown-menu li').click(function(e){
            e.preventDefault();
            var selected = $(this).attr('data-value');
            var text = $(this).text();
            $('#select-category').html(text + '  <span class="caret"></span>');
            $('.category').val(selected);  
        });
    });
</script>
</body>
</html>