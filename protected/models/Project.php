<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property integer $department_id
 *
 * The followings are the available model relations:
 * @property Subproject[] $subprojects
 */
class Project extends CActiveRecord
{

	public $subprojectIDs = array();
	public $subprojectNames = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, department_id', 'required'),
			array('department_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, department_id', 'safe', 'on'=>'search'),
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
			'subprojects' => array(self::HAS_MANY, 'Subproject', 'project_id'),
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
			'department_id' => Yii::app()->utility->getOption('department_name').' Responsable',
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
		//$criteria->with='department';
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('department_id',$this->department_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
            	'pageSize'=> Yii::app()->utility->getOption('table_rows'),
              ),			
			  'sort'=>array(
			    'defaultOrder'=>'name ASC',
			  ),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind()
	{
		if(!empty($this->subprojects))
		{
			foreach($this->subprojects as $subproject){
				$this->subprojectIDs[]=$subproject->id;
				$this->subprojectNames[]=$subproject->name;
			}
		}
	}

	public function getOverdueTasks() {
		$tasks = 0;
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('task t')
				->join('subproject s','t.subproject_id = s.id')
				->where('s.project_id=:id AND t.status=0 AND t.due_date<NOW()', array(':id'=>$this->id))
				//->order('j.jobno,j.projid')
				->queryRow();
			$tasks = $rows['q'];
		}
		return $tasks;
	}

	public function getPendingTasks() {
		$tasks = 0;
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('task t')
				->join('subproject s','t.subproject_id = s.id')
				->where('s.project_id=:id AND t.status=0 AND t.due_date>=NOW() + INTERVAL 15 DAY', array(':id'=>$this->id))
				//->order('j.jobno,j.projid')
				->queryRow();
			$tasks = $rows['q'];
		}
		return $tasks;
	}

	public function getNextTasks() {
		$tasks = 0;
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('task t')
				->join('subproject s','t.subproject_id = s.id')
				->where('s.project_id=:id AND t.status=0 AND t.due_date<NOW() + INTERVAL 15 DAY AND t.due_date>=NOW()', array(':id'=>$this->id))
				//->order('j.jobno,j.projid')
				->queryRow();
			$tasks = $rows['q'];
		}
		return $tasks;
	}

/*	public function getRedKpis() {
		$kpis = 0;
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('kpi k')
				->join('subproject s','k.subproject_id = s.id')
				->where('s.project_id=:id AND ((base_value<goal_value AND real_value<limit_yellow) OR (base_value>goal_value AND real_value>limit_yellow))', array(':id'=>$this->id))
				->queryRow();
			$kpis = $rows['q'];
		}
		return $kpis;
	}

	public function getYellowKpis() {
		$kpis = 0;
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('kpi k')
				->join('subproject s','k.subproject_id = s.id')
				->where('s.project_id=:id AND ((base_value<goal_value AND real_value<limit_green AND real_value>=limit_yellow) OR (base_value>goal_value AND real_value>limit_green AND real_value<=limit_yellow))', array(':id'=>$this->id))
				->queryRow();
			$kpis = $rows['q'];
		}
		return $kpis;
	}

	public function getGreenKpis() {
		$kpis = 0;
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('kpi k')
				->join('subproject s','k.subproject_id = s.id')
				->where('s.project_id=:id AND ((base_value<goal_value AND real_value>=limit_green) OR (base_value>goal_value AND real_value<=limit_green))', array(':id'=>$this->id))
				->queryRow();
			$kpis = $rows['q'];
		}
		return $kpis;
	}*/

	public function getCompliance() {

		//1: rojo ; 2: amarillo; 3: verde

		$subprojects = $this->subprojects;
		$t = 0;
		$b = 0;
		foreach ($subprojects as $subproject) {
			$weight = $subproject->weight;
			$compliance = $subproject->compliance;
			$t += $weight*$compliance;
			$b += $weight;
		}

		return $t/$b;

	}

}
