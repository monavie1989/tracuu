<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//namespace app\widgets\views;
//
//use yii\helpers\StringHelper;

$modelClass = get_class($model::model());

//echo '<div class="form-group">';
    echo '<label class="control-label" for="'.strtolower($modelClass).'-'.$field.'">'.$model->getAttributeLabel($field).'</label>';
    echo '<textarea class="'.$cssClass.'" id="'.strtolower($modelClass).'-'.$field.'" name="'.$modelClass.'['.$field.']'.'">'.$model->{$field}.'</textarea>';
//echo '</div>';