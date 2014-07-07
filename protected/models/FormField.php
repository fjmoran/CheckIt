<?php

/**
 * This is the model class for table "form_field".
 *
 * The followings are the available columns in table 'form_field':
 * @property integer $id
 * @property string $name
 * @property integer $process_id
 * @property string $code
 * @property integer $type
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property FormFieldOption[] $formFieldOptions
 * @property FormProperty[] $formProperties
 */
class FormField extends CActiveRecord
{

	private $typeOptions = array('0' => 'Texto', '1' => 'Texto largo', '2' => 'Fecha', '3' => 'Selección Única', '4' => 'Selección Múltiple', '5' => 'Archivo');

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'form_field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, process_id, code, type', 'required'),
			array('process_id, type', 'numerical', 'integerOnly'=>true),
			array('name, code', 'length', 'max'=>255),
			//array('code','unique'),
			array('code','validateCode'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, process_id, code, type', 'safe', 'on'=>'search'),
		);
	}

	public function validateCode($elem) {
		$clean = preg_replace('/[^a-z0-9\_]/', '_', $this->$elem);

		if ($clean != $this->$elem) {
			$this->addError($elem, "El código debe contener sólo minúsculas, números y/o guión bajo (_).");
			return false;
		}
		return true;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'process' => array(self::BELONGS_TO, 'Process', 'process_id'),
			'formFieldOptions' => array(self::HAS_MANY, 'FormFieldOption', 'form_field_id'),
			'formProperties' => array(self::HAS_MANY, 'FormProperty', 'form_field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Nombre',
			'process_id' => 'Process',
			'code' => 'ID / código de referencia',
			'type' => 'Tipo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('process_id',$this->process_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTypeOptions() {
		return $this->typeOptions;
	}

	public function getTypeValue() {
		return $this->typeOptions[$this->type];
	}


}
