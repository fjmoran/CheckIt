<?php

class ProjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	//public $model_id = 0;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('create','update','admin','delete'),
				'roles'=>array('admin', 'strategy_admin'),
			),
			array('allow',
				'actions'=>array('myprojects','strategyData','toDo','completed','myteam'),
				'roles'=>array('admin', 'strategy_user', 'strategy_manager'),
			),
			array('allow',
				'actions'=>array('report'),
				'roles'=>array('admin', 'dashboard_user', 'dashboard_manager', 'viewer'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionReport($id) {
		$model=$this->loadModel($id);
		$subprojects = Subproject::model()->findAllByAttributes(array('project_id'=>(int)$id));

		/*$detail = array();
		foreach ($subprojects as $subproject) {
			$d = array();
			$d['title'] = $subproject->name;
			$d['compliance'] = round($subproject->compliance,0);
			$detail[] = $d;
		}*/

		//$this->model_id = $model->id;

		$this->render('report',array(
			'model' => $model,
			'yellow' => Yii::app()->utility->getOption('kpi_yellow') / 100,
			'red' => Yii::app()->utility->getOption('kpi_red') / 100,
			'subprojects'=>$subprojects,
		));		
	}

	public function actionMyTeam() {

		$user = User::model()->find('id='.Yii::app()->user->id);
		$department_id = $user->department_id;

		//si es jefe, le muestro los KPI y Tareas del departamento

		if (!$department_id || $user->manager == 0)  exit;

		//obtenemos los kpi y tareas del departamento
		$kpi_d=$task_d=array();
		//$kpi_d = Kpi::model()->findAllByAttributes(array('department_id'=>$department_id));
		//$task_d = Task::model()->findAllByAttributes(array('department_id'=>$department_id));

		//si soy jefe, puedo ver un nivel más abajo
		$dep = Department::model()->findByPk($department_id);
		$dep_users = $dep->users;
		$user_ids = array();
		foreach ($dep_users as $user) {
			if ($user->id != Yii::app()->user->id) $user_ids[] = $user->id;
		}

		//obtengo los KPI y Tareas de todos los usuarios
		$kpi = Kpi::model()->findAllByAttributes(array('user_id'=>$user_ids));
		$task = Task::model()->findAllByAttributes(array('user_id'=>$user_ids));

		//obtenemos los objetivos estrategicos
		$kpi_d_arr = array();
		$task_d_arr = array();
		$kpi_arr = array();
		$task_arr = array();
		
		$oe_kpi = $oe_task = array();
		foreach ($kpi_d as $k) $oe_kpi[] = $k->subproject_id;
		foreach ($task_d as $k) $oe_task[] = $k->subproject_id;
		foreach ($kpi as $k) $oe_kpi[] = $k->subproject_id;
		foreach ($task as $k) $oe_task[] = $k->subproject_id;
		$oe_kpi = array_unique($oe_kpi);
		$oe_task = array_unique($oe_task);

		foreach ($kpi_d as $k) $kpi_arr[$k->subproject_id][] = $k;
		foreach ($task_d as $k) $task_arr[$k->subproject_id][] = $k;
		foreach ($kpi as $k) $kpi_arr[$k->subproject_id][] = $k;
		foreach ($task as $k) $task_arr[$k->subproject_id][] = $k;

		$array_merge = array_merge($oe_kpi, $oe_task);
		$projects = array();
		if (count($array_merge)>0)
			$projects = Project::model()->with('subprojects')->findAll('subprojects.id IN ('.join(',',$array_merge).')');

		$this->render('myteam',array(
			'kpis'=>$kpi_arr,
			'tasks'=>$task_arr,
			'subproject_kpi_ids'=>$oe_kpi,
			'subproject_task_ids'=>$oe_task,
			'projects'=>$projects,
		));

	}

	public function actionCompleted() {

		//kpi
		$kpidata = KpiData::model()->findAllByAttributes(array(), array(
			'condition'=>'user_id=:user_id',
			'params'=>array(':user_id'=>Yii::app()->user->id),
			'order'=>'created DESC',
			'limit'=>5,
		));

		$user = User::model()->find('id='.Yii::app()->user->id);
		$department_id = $user->department_id;

		//task
		if ($department_id && $user->manager == 1) {
			$tasks = Task::model()->findAllByAttributes(array(), array(
				'condition'=>'(user_id=:user_id OR department_id=:department_id) AND status=1',
				'params'=>array(':user_id'=>Yii::app()->user->id, ':department_id'=>$department_id),
				'order'=>'end_date DESC',
				'limit'=>5,
			));
		}
		else {
			$tasks = Task::model()->findAllByAttributes(array(), array(
				'condition'=>'user_id=:user_id AND status=1',
				'params'=>array(':user_id'=>Yii::app()->user->id),
				'order'=>'end_date DESC',
				'limit'=>5,
			));
		}

		$this->render('completed',array(
			'kpidata'=>$kpidata,
			'tasks'=>$tasks,
			//'tasks'=>$task,
		));		
	}

	public function actionToDo() {

		$user = User::model()->find('id='.Yii::app()->user->id);
		$department_id = $user->department_id;

		//si es jefe, le muestro los KPI y Tareas del departamento

		if ($department_id && $user->manager == 1) {

			//obtenemos los kpi y tareas del departamento y usuario
			$kpi = Kpi::model()->findAllByAttributes(array(), array(
				'condition' => 'user_id=:user_id OR department_id=:department_id',
				'params' => array('department_id'=>$department_id, 'user_id'=>Yii::app()->user->id), 
				'order'=>'next_due_date DESC',
			));
			$task = Task::model()->findAllByAttributes(array(), array(
				'condition' => '(user_id=:user_id OR department_id=:department_id) AND status=0',
				'params' => array('department_id'=>$department_id, 'user_id'=>Yii::app()->user->id), 
				'order'=>'due_date DESC',
			));

		}
		else {
			$kpi = Kpi::model()->findAllByAttributes(array(), array(
				'condition' => 'user_id=:user_id',
				'params' => array('user_id'=>Yii::app()->user->id), 
				'order'=>'next_due_date DESC',
			));
			$task = Task::model()->findAllByAttributes(array(), array(
				'condition' => 'user_id=:user_id',
				'params' => array('user_id'=>Yii::app()->user->id), 
				'order'=>'due_date DESC',
			));

		}

		$this->render('todo',array(
			'kpis'=>$kpi,
			'tasks'=>$task,
		));		
	}

	public function actionStrategyData() {
		$mision = Option::model()->findByAttributes(array('name'=>'mision'))->value;
		$vision = Option::model()->findByAttributes(array('name'=>'vision'))->value;
		$this->render('strategydata',array(
			'mision'=>$mision,
			'vision'=>$vision,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Project;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Project');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionMyProjects()
	{
		$user = User::model()->find('id='.Yii::app()->user->id);
		$department_id = $user->department_id;

		//si es jefe, le muestro los KPI y Tareas del departamento

		if ($department_id && $user->manager == 1) {

			//obtenemos los kpi y tareas del departamento
			$kpi_d = Kpi::model()->findAllByAttributes(array('department_id'=>$department_id));
			$task_d = Task::model()->findAllByAttributes(array('department_id'=>$department_id));

			//si soy jefe, puedo ver un nivel más abajo

		}

		//obtengo los KPI y Tareas del usuario
		$kpi = Kpi::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		$task = Task::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));

		//obtenemos los objetivos estrategicos
		$kpi_d_arr = array();
		$task_d_arr = array();
		$kpi_arr = array();
		$task_arr = array();
		
		$oe_kpi = $oe_task = array();
		if ($department_id && $user->manager == 1) {
			foreach ($kpi_d as $k) $oe_kpi[] = $k->subproject_id;
			foreach ($task_d as $k) $oe_task[] = $k->subproject_id;
		}
		foreach ($kpi as $k) $oe_kpi[] = $k->subproject_id;
		foreach ($task as $k) $oe_task[] = $k->subproject_id;
		$oe_kpi = array_unique($oe_kpi);
		$oe_task = array_unique($oe_task);

		if ($department_id && $user->manager == 1) {
			foreach ($kpi_d as $k) $kpi_arr[$k->subproject_id][] = $k;
			foreach ($task_d as $k) $task_arr[$k->subproject_id][] = $k;
		}
		foreach ($kpi as $k) $kpi_arr[$k->subproject_id][] = $k;
		foreach ($task as $k) $task_arr[$k->subproject_id][] = $k;

		$merge = array_merge($oe_kpi, $oe_task);
		$projects = array();
		if (count($merge))
			$projects = Project::model()->with('subprojects')->findAll('subprojects.id IN ('.join(',',array_merge($oe_kpi, $oe_task)).')');

		$this->render('myprojects',array(
			//'kpi_d'=>$kpi_d_arr,
			//'task_d'=>$task_d_arr,
			'kpis'=>$kpi_arr,
			'tasks'=>$task_arr,
			'subproject_kpi_ids'=>$oe_kpi,
			'subproject_task_ids'=>$oe_task,
			'projects'=>$projects,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Project the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Project $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
