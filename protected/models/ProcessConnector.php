<?php

/**
 * This is the model class for table "process_connector".
 *
 * The followings are the available columns in table 'process_connector':
 * @property integer $id
 * @property integer $source_task_id
 * @property integer $target_task_id
 *
 * The followings are the available model relations:
 * @property ProcessTask $targetTask
 * @property ProcessTask $sourceTask
 */
class ProcessConnector extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'process_connector';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_task_id, target_task_id', 'required'),
			array('source_task_id, target_task_id, process_id, position', 'numerical', 'integerOnly'=>true),
			array('info', 'checkConnection'),
			//array('source_task_id, target_task_id', 'unique', 'attributes' => array('source_task_id', 'target_task_id')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, source_task_id, target_task_id', 'safe', 'on'=>'search'),
		);
	}

	public function checkConnection($attribute)
	{
		//buscamos si existe una conexion igual en la BD
		$con = ProcessConnector::model()->findByAttributes(array('source_task_id'=>$this->source_task_id, 'target_task_id'=>$this->target_task_id));
		if ($con) {
			$this->addError($attribute, "Error: Ya existe una conexión entre esos elementos.");
			return false;
		}

		//si es actividad, no puede salir más de una conexión
		$con = ProcessConnector::model()->with('sourceTask')->findByAttributes(array('source_task_id'=>$this->source_task_id));
		if ($con) {
			if ($con->sourceTask->type == 0 || $con->sourceTask->type == 1 || $con->sourceTask->type == 2)  {// origen es tarea, inicio o término
				$this->addError($attribute, "Error: Ya existe una conexión para la actividad ".$con->sourceTask->name);
			}
			//$this->addError($attribute, "Error: La actividad no puede tener más de una conexión.");
			return false;
		}

	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'targetTask' => array(self::BELONGS_TO, 'ProcessTask', 'target_task_id'),
			'sourceTask' => array(self::BELONGS_TO, 'ProcessTask', 'source_task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'source_task_id' => 'Source Task',
			'target_task_id' => 'Target Task',
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
		$criteria->compare('source_task_id',$this->source_task_id);
		$criteria->compare('target_task_id',$this->target_task_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProcessConnector the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
