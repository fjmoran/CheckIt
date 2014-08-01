<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property string $name
 * @property integer $subproject_id
 * @property string $start_date
 * @property string $due_date
 *
 * The followings are the available model relations:
 * @property Subproject $subproject
 */
class Task extends CActiveRecord
{
	public $parent_id;

	private $statusOptions = array('0' => 'Abierta', '1' => 'Terminada');

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, subproject_id, start_date, due_date', 'required'),
			array('subproject_id, status, department_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('due_date','compare','compareAttribute'=>'start_date','operator'=>'>', 'allowEmpty'=>false , 'message'=>'{attribute} debe ser mayor que "{compareValue}".'),
			array('start_date','parentMinDate'),
			array('due_date','parentMaxDate'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, subproject_id, start_date, due_date, status, department_id', 'safe', 'on'=>'search'),
		);
	}

	public function parentMinDate($elem) {
		//obtenemos el padre
		$parent=$this->parent()->find();
		if ($parent) {
			if ($this->$elem < $parent->start_date) {
				$this->addError($elem, "La fecha inicio debe ser mayor o igual a '{$parent->start_date}' (fecha inicio de padre) .");
				return false;				
			}
			if ($this->$elem > $parent->due_date) {
				$this->addError($elem, "La fecha inicio debe ser menor o igual a '{$parent->due_date}' (fecha término de padre) .");
				return false;				
			}
		}
		return true;
	}

	public function parentMaxDate($elem) {
		//obtenemos el padre
		$parent=$this->parent()->find();
		if ($parent) {
			if ($this->$elem > $parent->due_date) {
				$this->addError($elem, "La fecha término debe ser menor o igual a '{$parent->due_date}' (fecha término de padre) .");
				return false;				
			}
			if ($this->$elem < $parent->start_date) {
				$this->addError($elem, "La fecha término debe ser mayor o igual a '{$parent->start_date}' (fecha inicio de padre) .");
				return false;				
			}
		}
		return true;
	}

	public function behaviors()
	{
		return array(
			'nestedSetBehavior'=>array(
				'class'=>'ext.yiiext.behaviors.model.trees.NestedSetBehavior',
				'hasManyRoots'=>true,
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
				'rootAttribute'=>'root',
			),
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
			'subproject' => array(self::BELONGS_TO, 'Subproject', 'subproject_id'),
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
			'subproject_id' => Yii::app()->utility->getOption('subproject_name'),
			'start_date' => 'Fecha de Inicio',
			'due_date' => 'Fecha de Término',
			'department_id' => Yii::app()->utility->getOption('department_name').' Responsable',
			'parent_id' => Yii::app()->utility->getOption('task_name').' que depende',
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
		$criteria->compare('subproject_id',$this->subproject_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('department_id',$this->department_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
            	'pageSize'=> Yii::app()->utility->getOption('table_rows'),
              ),			
		));
	}

	public function searchTree() {

		if ($this->subproject_id) {

			$rawData = Task::model()->findAll("subproject_id=".$this->subproject_id." ORDER BY root,lft ASC");

			foreach ($rawData as $d) {
				$pre = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $d->level-1);
				if ($d->level%2==0) $pre .= '<i style="font-size: 8px;" class="fa fa-circle-o"></i>&nbsp; ';
				else $pre .= '<i style="font-size: 8px;" class="fa fa-circle"></i>&nbsp; ';
				$d->name = $pre.$d->name;
			}

			$arrayDataProvider=new CArrayDataProvider($rawData, array(
				'id'=>'id',
				/*'sort'=>array(
					'attributes'=>array(
						'username', 'email',
					),
				),*/
				'pagination'=>array(
					'pageSize'=> Yii::app()->utility->getOption('table_rows'),
				),
			));

			return $arrayDataProvider;

		}

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getStatusOptions() {
		return $this->statusOptions;
	}

	public function getStatusText() {
		return $this->statusOptions[$this->status];
	}

}
