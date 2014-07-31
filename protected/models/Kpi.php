<?php

/**
 * This is the model class for table "kpi".
 *
 * The followings are the available columns in table 'kpi':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $subproject_id
 * @property string $frequency
 * @property string $base_date
 * @property string $goal_date
 * @property double $base_value
 * @property double $goal_value
 * @property string $unit
 * @property double $real_value
 * @property double $limit_red
 * @property double $limit_yellow
 * @property double $limit_green
 * @property integer $department_id
 *
 * The followings are the available model relations:
 * @property Department $department
 * @property Subproject $subproject
 */
class Kpi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kpi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, subproject_id, frequency, base_date, goal_date, base_value, goal_value, unit, real_value, limit_red, limit_yellow, limit_green, department_id', 'required'),
			array('subproject_id, department_id', 'numerical', 'integerOnly'=>true),
			array('base_value, goal_value, real_value, limit_red, limit_yellow, limit_green', 'numerical'),
			array('name, frequency', 'length', 'max'=>255),
			array('description', 'length', 'max'=>1000),
			array('unit', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, subproject_id, frequency, base_date, goal_date, base_value, goal_value, unit, real_value, limit_red, limit_yellow, limit_green, department_id', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'subproject' => array(self::BELONGS_TO, 'Subproject', 'subproject_id'),
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
			'description' => 'Descripción',
			'subproject_id' => Yii::app()->utility->getOption('subproject_name'),
			'frequency' => 'Frequencia toma de deciciones',
			'base_date' => 'Fecha base',
			'goal_date' => 'Fecha de meta',
			'base_value' => 'Valor base',
			'goal_value' => 'Valor meta',
			'unit' => 'Unidad de medida',
			'real_value' => 'Valor actual',
			'limit_red' => 'Límite rojo',
			'limit_yellow' => 'Límite amarillo',
			'limit_green' => 'Límite verde',
			'department_id' => Yii::app()->utility->getOption('department_name').' responsable',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('subproject_id',$this->subproject_id);
		$criteria->compare('frequency',$this->frequency,true);
		$criteria->compare('base_date',$this->base_date,true);
		$criteria->compare('goal_date',$this->goal_date,true);
		$criteria->compare('base_value',$this->base_value);
		$criteria->compare('goal_value',$this->goal_value);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('real_value',$this->real_value);
		$criteria->compare('limit_red',$this->limit_red);
		$criteria->compare('limit_yellow',$this->limit_yellow);
		$criteria->compare('limit_green',$this->limit_green);
		$criteria->compare('department_id',$this->department_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kpi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
