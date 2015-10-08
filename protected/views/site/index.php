<form class="search" action="<?php echo Yii::app()->createUrl('search/index')?>">
    <div class="form-border">
        <input type="text" maxlength="2048" name="q" placeholder="Tìm kiếm">
        
    </div>
    <div class="button">
        <input type="submit" value="Tìm kiếm"/>
    </div>
</form>