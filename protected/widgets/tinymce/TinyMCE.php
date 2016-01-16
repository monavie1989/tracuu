<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//namespace app\widgets\tinymce;
//
//use yii\base\Widget;
//use yii\helpers\StringHelper;
//use yii\web\NotAcceptableHttpException;
//use yii\web\View;
//use app\assets\TinyMCEAsset;

class TinyMCE extends CWidget
{
    public $model;
    
    public $field;
    
    public $cssClass = 'form-control';
    
    public $height = 300;
    
    public $width;
    
    public $theme = 'modern';
    
    public $lang = 'vi';

    public $mode = 'basic';

    public $plugins = '';
    
    public $toolbars = array();
    
    public $image_advtab = '';

    public function init() {
        parent::init();
        
        if(empty($this->model)) {
            throw new Exception('The editor\' model not set');
        }
        
        if(empty($this->field)) {
            throw new Exception('The editor\'s field not set');
        }
        
//        $this->view->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', ['position'=>View::POS_HEAD]);
//        $this->view->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', ['position'=>View::POS_HEAD]);
        $cs=Yii::app()->getClientScript();
        
        //TinyMCEAsset::register($this->view);
        
        if($this->mode == 'basic') {
            if($this->plugins == '') {
                $this->plugins = '[
                    \'advlist autolink lists link image charmap print preview anchor\',
                    \'searchreplace visualblocks code fullscreen\',
                    \'insertdatetime media table contextmenu paste code responsivefilemanager\'
                ]';
            }
            if(empty($this->toolbars)) {
                $this->toolbars = array('insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager');
            }
        } elseif($this->mode = 'advanced') {
            if($this->plugins == '') {
                $this->plugins = '[
                    \'advlist autolink lists link image charmap print preview hr anchor pagebreak\',
                    \'searchreplace wordcount visualblocks visualchars code fullscreen\',
                    \'insertdatetime media nonbreaking save table contextmenu directionality\',
                    \'emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager\'
                ]';
            }
            if(empty($this->toolbars)) {
                $this->toolbars = array(
                    'insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager ',
                    'print preview media | forecolor backcolor'
                );
            }
            
            if(empty($this->image_advtab)) {
                $this->image_advtab = 'true';
            }
        }
        
        $model = $this->model;
        $tinyinit = 'selector:\'#'.  strtolower(get_class($model)) .'-'.$this->field.'\'';
        $tinyinit .= ",\nheight: ".$this->height;
        if(!empty($this->width)) {
            $tinyinit .= ",\nwidth: ".$this->width;
        }
        $tinyinit .= ",\ntheme: '".$this->theme.'\'';
        $tinyinit .= ",\nlanguage: '".$this->lang.'\'';
        if(!empty($this->plugins)) {
            $tinyinit .= ",\nplugins: ".$this->plugins;
        }
        
        if(!empty($this->toolbars)) {
            $i = 1;
            $tool = '';
            foreach($this->toolbars as $toolbar) {
                $tool .= ",\ntoolbar".$i.': \''.$toolbar.'\'';
                $i++;
            }
            $tinyinit .= $tool;
        }
        if(!empty($this->image_advtab)) {
            $tinyinit .= ",\nimage_advtab: ".$this->image_advtab;
        }
        $tinyinit .= ',external_filemanager_path:"'.Yii::app()->baseUrl.'/theme_admin/lib/filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "'.Yii::app()->baseUrl.'/theme_admin/lib/filemanager/plugin.min.js"},
            relative_urls: true,
            document_base_url : "'.Yii::app()->baseUrl.'/"';
        $cs->registerScriptFile(Yii::app()->baseUrl .'/theme_admin/js/tinymce/tinymce.min.js');
        $cs->registerScript('_','tinymce.init({'.$tinyinit.'});');
    }
    
    public function run() {
        return $this->render('tinymce',array(
            'model'=>$this->model,
            'field'=>$this->field,
            'cssClass'=>$this->cssClass,
        ));
    }
}