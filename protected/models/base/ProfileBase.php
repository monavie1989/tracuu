<?php

/**
 * This is the model class for table "tbl_profile".
 *
 * The followings are the available columns in table 'tbl_profile':
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property integer $gender
 * @property string $birthday
 */
class ProfileBase extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProfileBase the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'required', 'on' => 'save'),
            array('user_id, gender', 'numerical', 'integerOnly' => true),
            array('fname, lname', 'length', 'max' => 255),
            array('birthday', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_id, fname, lname, gender, birthday', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'User',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('lname', $this->lname, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('birthday', $this->birthday, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
