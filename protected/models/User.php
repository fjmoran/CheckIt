<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property integer $status
 * @property string $created
 * @property string $lastvisit
 *
 * The followings are the available model relations:
 * @property UserRole $id0
 */
class User extends CActiveRecord
{

	public $current_password;
	public $repeat_password;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, firstname, lastname, status', 'required'),
			array('password', 'required', 'on' => 'insert'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('email, password', 'length', 'max'=>100),
			array('firstname, lastname', 'length', 'max'=>255),
			array('email', 'email','message'=>"El email ingresado no es correcto"),
			array('email', 'unique','message'=>'El email ingresado ya existe!'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, firstname, lastname, status, created, lastvisit', 'safe', 'on'=>'search'),
			array('current_password, repeat_password', 'safe', 'on'=>'update'),
			array('created', 'default', 
          		'value'=>new CDbExpression('NOW()'),
          		'setOnEmpty'=>false, 'on'=>'insert'),
		);
	}

	public function beforeSave(){
		if(parent::beforeSave()){
			if ($this->password)
				$this->password = md5($this->password);
			else {
				$_password = User::model()->findByPk($this->id)->password;
				$this->password = $_password;
			}
			return true;
		}
		return false;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'id0' => array(self::BELONGS_TO, 'UserRole', 'id'),
			'roles' => array(self::MANY_MANY, 'Role', 'user_role(user_id, role_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'firstname' => 'Nombre',
			'lastname' => 'Apellido',
			'status' => 'Estado',
			'created' => 'Creado en',
			'lastvisit' => 'Última visita',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('lastvisit',$this->lastvisit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getStatusOptions() {
		return array('0' => 'Inactivo', '1' => 'Activo');
	}
}
