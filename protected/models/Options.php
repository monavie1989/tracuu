<?php

/**
 * This is the model class for table "tbl_options".
 *
 * The followings are the available columns in table 'tbl_options':
 * @property integer $id
 * @property string $option_name
 * @property string $option_value
 */
class Options extends OptionsBase
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return Options the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getSmtpOptions() {
        
        $criteria = new CDbCriteria();
        $criteria->select = 'option_name, option_value';
        $criteria->addCondition('option_name="SMTP_HOST"', 'OR');
        $criteria->addCondition('option_name="SMTP_SECURE"', 'OR');
        $criteria->addCondition('option_name="SMTP_PORT"', 'OR');
        $criteria->addCondition('option_name="SMTP_AUTH"', 'OR');
        $criteria->addCondition('option_name="SMTP_USERNAME"', 'OR');
        $criteria->addCondition('option_name="SMTP_PASSWORD"', 'OR');
        $criteria->addCondition('option_name="SMTP_FROM_NAME"', 'OR');
        return $this->findAll($criteria);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
        
    }    
    
}