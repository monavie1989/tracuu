<?php
class AdminMenu extends CWidget
{
    public function run() {
        $data = array();
        $this->render('AdminMenu',$data);
    }
}
?>