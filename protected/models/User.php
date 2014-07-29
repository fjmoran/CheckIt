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
 * @property string $position
 * @property string $created
 * @property string $lastvisit
 * @property string $token
 * @property string $token_created
 * @property integer $department_id
 *
 * The followings are the available model relations:
 * @property Department $department
 * @property Group[] $groups
 * @property Role[] $roles
 */
class User extends CActiveRecord
{

	public $current_password;
	public $repeat_password;
	public $roleIDs = array();
	public $roleNames = array();

	private $managerOptions = array('0' => 'No', '1' => 'Si');

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
			array('status, department_id, manager', 'numerical', 'integerOnly'=>true),
			array('email, password', 'length', 'max'=>100),
			array('firstname, lastname, position', 'length', 'max'=>255),
			array('email', 'email','message'=>"El email ingresado no es correcto"),
			array('email', 'unique','message'=>'El email ingresado ya existe!'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, firstname, lastname, status, created, lastvisit, position, department_id, manager', 'safe', 'on'=>'search'),
			array('current_password, repeat_password', 'safe', 'on'=>'update'),
			array('created', 'default', 
          		'value'=>new CDbExpression('NOW()'),
          		'setOnEmpty'=>false, 'on'=>'insert'),
		);
	}

	public function beforeSave(){
		if(parent::beforeSave()){
			if ($this->password) {
				if ($this->isNewRecord) {
					$this->password = md5($this->password);
				}
				else {
					$_password = User::model()->findByPk($this->id)->password;
					if ($this->password != $_password) {
						$this->password = md5($this->password);
					}
				}
			}
			else {
				if (!$this->isNewRecord) {
					$_password = User::model()->findByPk($this->id)->password;
					$this->password = $_password;
				}
			}

			/*if ($this->password)
				$this->password = md5($this->password);
			else {
				$_password = User::model()->findByPk($this->id)->password;
				$this->password = $_password;
			}*/

			//vemos si tiene asignado un departamento y si es el unico
			if ($this->department_id && $this->department_id!=new CDbExpression('NULL')) {
				$condition = 'status=:status && department_id=:department_id && id!=:id';
				$params = array(
					':status' => 1,
					':department_id' => $this->department_id,
					':id' => $this->id,
				);
				if ($this->isNewRecord) {
					$condition = 'status=:status && department_id=:department_id';
					$params = array(
						':status' => 1,
						':department_id' => $this->department_id,
					);
				}
				$users = User::model()->findAllByAttributes(
					array(), 
					$condition,
					$params
				);
				if (count($users) == 0) {
					$this->manager = 1;
				}
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
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'groups' => array(self::MANY_MANY, 'Group', 'user_group(user_id, group_id)'),
			'roles' => array(self::MANY_MANY, 'Role', 'user_role(user_id, role_id)', 'order'=>'pos ASC'),
		);
	}

	public function behaviors(){ 
          return array( 'CAdvancedArBehavior' => array(
                'class' => 'application.extensions.CAdvancedArBehavior'));
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
			'position' => 'Cargo',
			'department_id' => Yii::app()->utility->getOption('department_name'),
			'created' => 'Creado en',
			'lastvisit' => 'Última visita',
			'roles' => 'Roles',
			'fullname' => 'Nombre Completo',
			'manager' => 'Administrador',
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
		$criteria->with='department';
		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('position',$this->position, true);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('lastvisit',$this->lastvisit,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('token_created',$this->token_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			  'sort'=>array(
			    'defaultOrder'=>'status DESC, department.name ASC,lastname ASC',
			  )			
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

/*	public function rolesToString()
	{
		$roles = $this->roles;
		if ($roles) 
		{
			$string = '';
			foreach($roles as $role) {
				$string .= $role->name . ', ';
			}
			return substr($string,0,strlen($string)-2);
		}
		return '';
	}*/

	// Get current roles for this user:
	public function afterFind()
	{
		if(!empty($this->roles))
		{
			foreach($this->roles as $role){
				$this->roleIDs[]=$role->id;
				$this->roleNames[]=$role->name;
			}
		}
	}

	public function getAlertTasks() {
		$alert_tasks = 0;
		$department_id = User::model()->find('id='.$this->id)->department_id;
		if ($department_id) {
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('task t')
				->join('subproject s','t.subproject_id = s.id')
				->join('project p', 's.project_id = p.id')
				->where('t.department_id=:id AND t.status=0 AND t.due_date<NOW() + INTERVAL 15 DAY', array(':id'=>$department_id))
				//->order('j.jobno,j.projid')
				->queryRow();
			$alert_tasks = $rows['q'];
			if ($alert_tasks==0) $alert_tasks='';
		}
		return $alert_tasks;
	}

	public function getFullName() {
		return $this->firstname . " " . $this->lastname;
	}

	public function getManagerOptions() {
		return $this->statusOptions;
	}

}
