<?php

/**
 * This is the model class for table "form_property".
 *
 * The followings are the available columns in table 'form_property':
 * @property integer $id
 * @property integer $form_id
 * @property integer $form_field_id
 * @property integer $visible
 * @property integer $required
 *
 * The followings are the available model relations:
 * @property FormField $formField
 * @property Form $form
 */
class FormProperty extends CActiveRecord
{

	private $visibleOptions = array('0' => 'Editable', '1' => 'No editable');
	private $requiredOptions = array('0' => 'Opcional', '1' => 'Obligatorio');

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'form_property';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_id, form_field_id, visible, required, position', 'required'),
			array('form_id, form_field_id, visible, required, position', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, form_id, form_field_id, visible, required, position', 'safe', 'on'=>'search'),
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
			'formField' => array(self::BELONGS_TO, 'FormField', 'form_field_id'),
			'form' => array(self::BELONGS_TO, 'Form', 'form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'form_id' => 'Form',
			'form_field_id' => 'Campo',
			'visible' => 'Es editable',
			'required' => 'Es obligatorio',
			'position' => 'Posición',
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
		$criteria->compare('form_id',$this->form_id);
		$criteria->compare('form_field_id',$this->form_field_id);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('required',$this->required);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array('defaultOrder' => 'position ASC')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getVisibleOptions() {
		return $this->visibleOptions;
	}

	public function getVisibleValue() {
		return $this->visibleOptions[$this->visible];
	}

	public function getRequiredOptions() {
		return $this->requiredOptions;
	}

	public function getRequiredValue() {
		return $this->requiredOptions[$this->required];
	}

}
