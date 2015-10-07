<?php

class Sidebar extends CWidget {

    public function init() {
    }
    public function run() {
        $role = Yii::app()->user->role;
        if($role === 'administrator')
            $this->render("AdminSidebar", array(
            ));
        if($role === 'moderator')
            $this->render("ModSidebar", array(
            ));
        if($role === 'publisher')
            $this->render("PublisherSidebar", array(
            ));
        if($role === 'author')
            $this->render("AuthorSidebar", array(
            ));
    }

}

?>
