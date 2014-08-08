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
	private $measuringOptions = array(0 => ' Creciente (Más es mejor)', 1 => 'Decreciente (Menos es mejor)', 2 => 'Convergente (Más cerca es mejor)');
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
			array('name, calculation, subproject_id, base_date, goal_date, base_value, goal_value, unit, weight', 'required'),
			array('subproject_id, department_id, user_id, update_frequency, review_frequency, measuring, function, parent_id', 'numerical', 'integerOnly'=>true),
			array('base_value, goal_value', 'numerical'),
			array('weight', 'numerical', 'min'=>1),
			array('goal_date','compare','compareAttribute'=>'base_date','operator'=>'>', 'allowEmpty'=>false , 'message'=>'{attribute} debe ser mayor que "{compareValue}".'),
			array('base_date','parentMinDate'),
			array('goal_date','parentMaxDate'),
			array('name', 'length', 'max'=>255),
			array('calculation', 'length', 'max'=>1000),
			array('unit', 'length', 'max'=>100),
			array('measuring', 'calculationValid'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, calculation, subproject_id, update_frequency, review_frequency, base_date, goal_date, base_value, goal_value, unit, department_id, weight, measuring, function', 'safe', 'on'=>'search'),
		);
	}

	public function parentMinDate($elem) {
		//obtenemos el padre
		$parent=$this->parent()->find();
		if ($parent) {
			if ($this->$elem < $parent->base_date) {
				$this->addError($elem, "La fecha base debe ser mayor o igual a '{$parent->base_date}' (fecha base de kpi padre) .");
				return false;				
			}
			if ($this->$elem > $parent->goal_date) {
				$this->addError($elem, "La fecha base debe ser menor o igual a '{$parent->goal_date}' (fecha meta de kpi padre) .");
				return false;				
			}
		}
		return true;
	}

	public function parentMaxDate($elem) {
		//obtenemos el padre
		$parent=$this->parent()->find();
		if ($parent) {
			if ($this->$elem > $parent->goal_date) {
				$this->addError($elem, "La fecha meta debe ser menor o igual a '{$parent->goal_date}' (fecha meta de kpi padre) .");
				return false;				
			}
			if ($this->$elem < $parent->base_date) {
				$this->addError($elem, "La fecha meta debe ser mayor o igual a '{$parent->base_date}' (fecha base de kpi padre) .");
				return false;				
			}
		}
		return true;
	}

	public function calculationValid($elem) {
		if ($this->$elem == 0 && $this->base_value > $this->goal_value) {
			$this->addError($elem, "El valor meta debe ser mayor al valor base, si la forma de medición es creciente.");
			return false;
		}
		if ($this->$elem == 1 && $this->base_value < $this->goal_value) {
			$this->addError($elem, "El valor meta debe ser mejor al valor base, si la forma de medición es 'decreciente'.");
			return false;
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
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'subproject' => array(self::BELONGS_TO, 'Subproject', 'subproject_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'kpiDatas' => array(self::HAS_MANY, 'KpiData', 'kpi_id',
				'order'=>'created DESC', 
			),
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
			'user_id' => 'Usuario responsable',
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
				'defaultOrder'=>'root ASC,lft ASC',
			),*/		
		));
	}

	public function searchTree() {

		if ($this->subproject_id) {

			$rawData = Kpi::model()->findAll("subproject_id=".$this->subproject_id." ORDER BY root,lft ASC");

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

	public function getInCharge() {
		$ret = '';
		if ($this->department) 
			$ret = $this->department->nameWithManager;
		else if ($this->user)
			$ret = $this->user->fullname;
		return $ret;
	}

	public function getPeriodStart() {
		$date = $this->next_due_date;
		switch ($this->update_frequency) {
			case 0: //diario
				return $date;
				break;
			case 1: //semanal
				return date('Y-m-d', strtotime($date . " - 6 day"));
				break;
			case 2: //mensual
				return date('Y-m-01', strtotime($date));
				break;
			case 3: //trimestral
				$mn = date('n', strtotime($date));  // mes 
				return date('Y-'.($mn-2).'-01', strtotime($date));
				break;
			case 4: //semestral
				$mn = date('n', strtotime($date));  // mes 
				return date('Y-'.($mn-5).'-01', strtotime($date));
				break;
			case 5: //anual
				return date('Y-01-01', strtotime($date));
				break;
		}		
	}

	private function next_date($frequency, $date) {
		$date = date('Y-m-d', strtotime($date . ' + 1 day'));
		switch ($frequency) {
			case 0: //diario
				return $date;
				break;
			case 1: //semanal
				$dw = date( "w", strtotime($date));
				$dif = 7-$dw;
				return date('Y-m-d', strtotime($date . " + $dif day"));
				break;
			case 2: //mensual
				return date('Y-m-t', strtotime($date));
				break;
			case 3: //trimestral
				$mn = date('n', strtotime($date))-1;  // mes desde 0 a 11
				$dif = 2 - ($mn%3);
				return date('Y-m-t', strtotime($date . " + $dif month"));
				break;
			case 4: //semestral
				$mn = date('n', strtotime($date))-1;  // mes desde 0 a 11
				$dif = 5 - ($mn%6);
				return date('Y-m-t', strtotime($date . " + $dif month"));
				break;
			case 5: //anual
				return date('Y-12-31', strtotime($date));
				break;
		}
	}

	public function calculateNextDueDate() {

		//si no tiene datos guardados
		$date = $this->base_date;

		//si tiene
		$data = KpiData::model()->findAllByAttributes(array(), array(
			'condition'=>'kpi_id=:kpi_id',
			'params'=>array('kpi_id'=>$this->id),
			'order'=>'period_end DESC',
			)
		);

		if ($data) {
			$d = $data[0];
			$date = $d->period_end;
		}

		$this->next_due_date = Kpi::model()->next_date($this->update_frequency, $date);

	}

	public function getLastDataValue() {
		$datas = $this->kpiDatas;
		if ($datas) {
			$data = $datas[0];
			return $data->value;
		}
		return null;
	}

	public function getCompliance() {
		$value = $this->lastDataValue;
		if ($value===null) return null;

		// Actual (A) / Meta (M) / Base (I)
		$a = $value;
		$m = $this->goal_value;
		$i = $this->base_value;

		//porcentaje de cumplimiento
		if ($this->measuring==0) { // si es creciente
			$compliance = ($a-$i)/($m-$i)*100;
		}
		if ($this->measuring==1) { // si es decreciente
			$compliance = ($a-$i)/($m-$i)*100;
		}
		if ($this->measuring==2) { // más cercano
			$compliance = 1 - abs($m-$a)/($m-$i)*100;
		}

		return $compliance;		
	}

}
