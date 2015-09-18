<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
 *
 * The followings are the available model relations:
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            default:
                echo 'mixed $'.$name."\n";
        }
	}
    ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?php echo $modelClass; ?> extends <?php echo $modelClass."Base\n"; ?>
{
    /**
        * Returns the static model of the specified AR class.
        * @param string $className active record class name.
        * @return <?php echo $modelClass; ?> the static model class
        */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    protected function afterDelete() {
        // code modify insert here
        foreach (<?php echo $modelClass; ?>Detail::model()->findAllByAttributes(array('<?php echo strtolower($modelClass); ?>_id'=>$this->id)) as $item) {
            $item->delete();
        }
        return parent::afterDelete();
    }
    public function beforeSave() {
        // code modify insert here
        if ($this->isNewRecord)
            $this->create_date = new CDbExpression('NOW()');
        else
            $this->modified_date = new CDbExpression('NOW()');
        return parent::beforeSave();
    }
    public function afterFind() {
        // code modify insert here

        return parent::afterFind();
    }
    
    
}