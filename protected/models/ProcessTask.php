<?php

/**
 * This is the model class for table "process_task".
 *
 * The followings are the available columns in table 'process_task':
 * @property integer $id
 * @property string $name
 * @property integer $process_id
 * @property integer $pos_x
 * @property integer $pos_y
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property ProcessConnector[] $processConnectors
 * @property ProcessConnector[] $processConnectors1
 * @property ProcessStep[] $processSteps
 * @property Process $process
 */
class ProcessTask extends CActiveRecord
{

	private $typeOptions = array('0' => 'Actividad', '1' => 'Inicio', '2' => 'Término');

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'process_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, process_id', 'required'),
			array('process_id, pos_x, pos_y, type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, process_id, pos_x, pos_y, type', 'safe', 'on'=>'search'),
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
			'processConnectors' => array(self::HAS_MANY, 'ProcessConnector', 'target_task_id'),
			'processConnectors1' => array(self::HAS_MANY, 'ProcessConnector', 'source_task_id'),
			'processSteps' => array(self::HAS_MANY, 'ProcessStep', 'process_task_id'),
			'process' => array(self::BELONGS_TO, 'Process', 'process_id'),
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
			'process_id' => 'Proceso',
			'pos_x' => 'Pos X',
			'pos_y' => 'Pos Y',
			'type' => 'Tipo',		);
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
		$criteria->compare('pos_x',$this->pos_x);
		$criteria->compare('pos_y',$this->pos_y);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProcessTask the static model class
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
