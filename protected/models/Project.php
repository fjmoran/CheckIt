<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property integer $position_id
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
			array('name, position_id', 'required'),
			array('position_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, position_id', 'safe', 'on'=>'search'),
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
			'position' => array(self::BELONGS_TO, 'Position', 'position_id'),
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
			'position_id' => 'Cargo Responsable',
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
		$criteria->compare('position_id',$this->position_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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


}
