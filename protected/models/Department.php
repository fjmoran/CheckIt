<?php

/**
 * This is the model class for table "department".
 *
 * The followings are the available columns in table 'department':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 */
class Department extends CActiveRecord
{

	public $userIDs = array();
	public $userNames = array();
	public $managerID = 0;
	public $managerName = '';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, parent_id', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Department', 'parent_id'),
			'users' => array(self::HAS_MANY, 'User', 'department_id'),
			'projects' => array(self::HAS_MANY, 'Project', 'department_id'),
			'manager' => array(self::HAS_MANY, 'User', 'department_id', 'condition'=>'manager.manager=1'),
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
			'parent_id' => 'Superior Jerárquica',
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
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			  'sort'=>array(
			    'defaultOrder'=>'parent_id ASC, name ASC',
			  )

		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Department the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterFind() 
	{
		if(!empty($this->users))
		{
			foreach($this->users as $user){
				$this->userIDs[]=$user->id;
				$this->userNames[]=$user->firstname." ".$user->lastname;
			}
		}
		if (!empty($this->manager)) {
			foreach ($this->manager as $m) {
				$this->managerID = $m->id;
				$this->managerName = $m->firstname." ".$m->lastname;
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
				->join('project p', 's.project_id = p.id')
				->where('p.department_id=:id AND t.status=0 AND t.due_date<NOW()', array(':id'=>$this->id))
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
				->join('project p', 's.project_id = p.id')
				->where('p.department_id=:id AND t.status=0 AND t.due_date>=NOW() + INTERVAL 15 DAY', array(':id'=>$this->id))
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
				->join('project p', 's.project_id = p.id')
				->where('p.department_id=:id AND t.status=0 AND t.due_date<NOW() + INTERVAL 15 DAY AND t.due_date>=NOW()', array(':id'=>$this->id))
				//->order('j.jobno,j.projid')
				->queryRow();
			$tasks = $rows['q'];
		}
		return $tasks;
	}

	public function getDeepProjects() {
		$projects = array();
		if ($this->id) {
			$rows = Yii::app()->db->createCommand()
				->select('p.id as p_id')
				->from('task t')
				->join('subproject s','t.subproject_id = s.id')
				->join('project p', 's.project_id = p.id')
				->where('p.department_id=:id OR s.department_id=:id OR t.department_id=:id', array(':id'=>$this->id))
				->queryAll();
			foreach ($rows as $row) {
				$projects[] = $row['p_id'];
			}
			$projects = array_unique($projects);
		}
		return $projects;
	}

}
