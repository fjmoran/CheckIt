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
	public $parent_id;

	private $frequencyOptions = array(0 => 'Diario', 1 => 'Semanal', 2 => 'Mensual', 3 => 'Trimestral', 4 => 'Semestral', 5 => 'Anual');
	private $measuringOptions = array(0 => 'Más es mejor (creciente)', 1 => 'Menos es mejor (decreciente)', 2 => 'Más cerca es mejor');
	private $functionOptions = array(0 => 'Promedio', 1 => 'Suma');

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
			array('name, calculation, subproject_id, base_date, goal_date, base_value, goal_value, unit, department_id, weight', 'required'),
			array('subproject_id, department_id, update_frequency, review_frequency, measuring, function, parent_id', 'numerical', 'integerOnly'=>true),
			array('base_value, goal_value', 'numerical'),
			array('weight', 'numerical', 'min'=>1),
			array('name', 'length', 'max'=>255),
			array('calculation', 'length', 'max'=>1000),
			array('unit', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, calculation, subproject_id, update_frequency, review_frequency, base_date, goal_date, base_value, goal_value, unit, department_id, weight, measuring, function', 'safe', 'on'=>'search'),
		);
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
			'subproject_id' => Yii::app()->utility->getOption('subproject_name'),
			'update_frequency' => 'Frecuencia de actualización',
			'review_frequency' => 'Frecuencia de revisión',
			'base_date' => 'Fecha base',
			'goal_date' => 'Fecha de meta',
			'base_value' => 'Valor base',
			'goal_value' => 'Valor meta',
			'unit' => 'Unidad de medida',
			'department_id' => Yii::app()->utility->getOption('department_name').' responsable',
			'measuring' => 'Forma de medición',
			'calculation' => 'Forma de cálculo',
			'function' => 'Función de cálculo',
			'weight' => 'Peso',
			'parent_id' => 'KPI del que depende',
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
		$criteria->compare('update_frequency',$this->update_frequency);
		$criteria->compare('review_frequency',$this->review_frequency);
		$criteria->compare('base_date',$this->base_date,true);
		$criteria->compare('goal_date',$this->goal_date,true);
		$criteria->compare('base_value',$this->base_value);
		$criteria->compare('goal_value',$this->goal_value);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('measuring',$this->measuring);
		$criteria->compare('calculation',$this->calculation);
		$criteria->compare('function',$this->function);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
            	'pageSize'=> Yii::app()->utility->getOption('table_rows'),
            ),
			/*'sort'=>array(
				'defaultOrder'=>'lft ASC',
			),*/		
		));
	}

/*	private function queryTree($params='') {
		$data = Kpi::model()->findAll(array('condition'=>'root IS NULL', 'order'=>'name ASC'));
		foreach ($data as $d) {
			$root_id = $d->id;
			$children = Kpi::model()->findAll(array('condition'=>'root=?','order'=>'lft'),array($root_id));
		}
	}*/

	public function searchTree() {

		if ($this->subproject_id) {

			//$rawData=$this->queryTree('AND subproject_id='.$this->subproject_id);
//			Kpi::model()->findAll(array('condition'=>'root=?','order'=>'lft'),array($root_id));
//			$rawData = Kpi::model()->findAll("subproject_id=".$this->subproject_id." ORDER BY lft ASC");

			$rawData = Kpi::model()->findAll("subproject_id=".$this->subproject_id." ORDER BY root,lft ASC");

			foreach ($rawData as $d) {
				$pre = str_repeat('--', $d->level);
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

			//echo "<pre>";
			//print_r($arrayDataProvider);
			//echo "</pre>";

			return $arrayDataProvider;

		}

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

	public function getUpdateFrequencyOptions() {
		return $this->frequencyOptions;
	}

	public function getUpdateFrequencyText() {
		return $this->frequencyOptions[$this->update_frequency];
	}

	public function getReviewFrequencyOptions() {
		return $this->frequencyOptions;
	}

	public function getReviewFrequencyText() {
		return $this->frequencyOptions[$this->review_frequency];
	}

	public function getMeasuringOptions() {
		return $this->measuringOptions;
	}

	public function getMeasuringText() {
		return $this->measuringOptions[$this->measuring];
	}

	public function getFunctionOptions() {
		return $this->functionOptions;
	}

	public function getFunctionText() {
		return $this->functionOptions[$this->function];
	}

}
