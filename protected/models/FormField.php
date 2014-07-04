<?php

/**
 * This is the model class for table "form_field".
 *
 * The followings are the available columns in table 'form_field':
 * @property integer $id
 * @property string $name
 * @property integer $form_id
 * @property integer $required
 * @property integer $type
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property Form $form
 * @property FormFieldOption[] $formFieldOptions
 */
class FormField extends CActiveRecord
{
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
			array('name, form_id, required, type, position', 'required'),
			array('form_id, required, type, position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, form_id, required, type, position', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'form' => array(self::BELONGS_TO, 'Form', 'form_id'),
			'formFieldOptions' => array(self::HAS_MANY, 'FormFieldOption', 'form_field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'form_id' => 'Form',
			'required' => 'Required',
			'type' => 'Type',
			'position' => 'Position',
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
		$criteria->compare('form_id',$this->form_id);
		$criteria->compare('required',$this->required);
		$criteria->compare('type',$this->type);
		$criteria->compare('position',$this->position);

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
}
