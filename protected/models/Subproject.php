<?php

/**
 * This is the model class for table "subproject".
 *
 * The followings are the available columns in table 'subproject':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Task[] $tasks
 */
class Subproject extends CActiveRecord
{

	public $taskIDs = array();
	public $taskNames = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subproject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, project_id', 'required'),
			array('project_id, department_id', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical', 'min'=>1),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, project_id, department_id, weight', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'tasks' => array(self::HAS_MANY, 'Task', 'subproject_id'),
			'kpis' => array(self::HAS_MANY, 'Kpi', 'subproject_id'),
			'childTasks' => array(self::HAS_MANY, 'Task', 'subproject_id', 'condition'=>'childTasks.id = childTasks.root'),
			'childKpis' => array(self::HAS_MANY, 'Kpi', 'subproject_id', 'condition'=>'childKpis.id = childKpis.root'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
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
			'project_id' => Yii::app()->utility->getOption('project_name'),
			'department_id' => Yii::app()->utility->getOption('department_name').' Responsable',
			'weight' => 'Peso',
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
		$criteria->with='project';
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('weight',$this->weight);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
            	'pageSize'=> Yii::app()->utility->getOption('table_rows'),
              ),			
			  'sort'=>array(
	    		'defaultOrder'=>'project.name ASC',
	 		 ),		
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subproject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind()
	{
		if(!empty($this->tasks))
		{
			foreach($this->tasks as $task){
				$this->taskIDs[]=$task->id;
				$this->taskNames[]=$task->name;
			}
		}
	}

	public function getCompliance() {

		//1: rojo ; 2: amarillo; 3: verde

		$kpis = $this->kpis;
		$t = 0;
		$b = 0;
		foreach ($kpis as $kpi) {
			$weight = $kpi->weight;
			$compliance = $kpi->compliance;
			$t += $weight*$compliance;
			$b += $weight;
		}

		if ($b==0) return 0;
		else return $t/$b;

	}

}
