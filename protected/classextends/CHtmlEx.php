<?php

/*
 * @author Quyet2n
 */

class CHtmlEx extends CHtml {

    public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions = array()) {
        self::resolveNameID($model, $attribute, $htmlOptions);
        $selection = self::resolveValue($model, $attribute);
        if ($model->hasErrors($attribute))
            self::addErrorCss($htmlOptions);
        $name = $htmlOptions['name'];
        unset($htmlOptions['name']);

        if (array_key_exists('uncheckValue', $htmlOptions)) {
            $uncheck = $htmlOptions['uncheckValue'];
            unset($htmlOptions['uncheckValue']);
        }
        else
            $uncheck = '';

        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
        $hidden = $uncheck !== null ? self::hiddenField($name, $uncheck, $hiddenOptions) : '';

        return $hidden . self::radioButtonList($name, $selection, $data, $htmlOptions);
    }

    public static function radioButtonList($name, $select, $data, $htmlOptions = array()) {
        $template = isset($htmlOptions['template']) ? $htmlOptions['template'] : '{input} {label}';
        $separator = isset($htmlOptions['separator']) ? $htmlOptions['separator'] : "";
        $container = isset($htmlOptions['container']) ? $htmlOptions['container'] : 'div';
        unset($htmlOptions['template'], $htmlOptions['separator'], $htmlOptions['container']);

        $labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array('class' => 'radio inline');
        unset($htmlOptions['labelOptions']);

        $items = array();
        $baseID = isset($htmlOptions['baseID']) ? $htmlOptions['baseID'] : self::getIdByName($name);
        unset($htmlOptions['baseID']);
        $id = 0;
        foreach ($data as $value => $label) {
            $checked = !strcmp($value, $select);
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID . '_' . $id++;
            $option = self::radioButton($name, $checked, $htmlOptions);
            $label = self::label($option . $label, $htmlOptions['id'], $labelOptions);
            $items[] = $label;
        }

        if (empty($container))
            return implode($separator, $items);
        else
            return self::tag($container, array('id' => $baseID), implode($separator, $items));
    }

    public static function resolveNameID($model, &$attribute, &$htmlOptions) {
        if (!isset($htmlOptions['name']))
            $htmlOptions['name'] = self::resolveName($model, $attribute);
        if (!isset($htmlOptions['id']))
            $htmlOptions['id'] = self::getIdByName($htmlOptions['name']);
        elseif ($htmlOptions['id'] === false)
            unset($htmlOptions['id']);
    }

    public static function resolveNameField($model, $attribute,$language_id='') {
        if (($pos = strpos($attribute, '[')) !== false) {
            if ($pos !== 0)  // e.g. name[a][b]
                return get_class($model) . '[' . substr($attribute, 0, $pos) . ']' . substr($attribute, $pos);
            if (($pos = strrpos($attribute, ']')) !== false && $pos !== strlen($attribute) - 1) {  // e.g. [a][b]name
                $sub = substr($attribute, 0, $pos + 1);
                $attribute = substr($attribute, $pos + 1);
                return get_class($model) . $sub . '[' . $attribute . ']';
            }
            if (preg_match('/\](\w+\[.*)$/', $attribute, $matches)) {
                $name = get_class($model) . '[' . str_replace(']', '][', trim(strtr($attribute, array('][' => ']', '[' => ']')), ']')) . ']';
                $attribute = $matches[1];
                return $name;
            }
        }
        if(!empty($language_id)){
            return get_class($model) . '['.$language_id.'][' . $attribute . ']';
        }else{
            return get_class($model) . '[' . $attribute . ']';
        }
    }

}

