<?php

class SubprojectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('view','create','update','admin','delete'),
				'roles'=>array('admin', 'strategy_admin'),
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
		$kpis = Kpi::model()->findAllByAttributes(array(), array('condition'=>'subproject_id=:subproject_id AND root=id', 'params'=>array('subproject_id'=>(int)$id)));
		$tasks = Task::model()->findAllByAttributes(array(), array('condition'=>'subproject_id=:subproject_id AND root=id', 'params'=>array('subproject_id'=>(int)$id)));

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
			'kpis'=>$kpis,
			'tasks'=>$tasks,
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
		$model=new Subproject;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subproject']))
		{
			$model->attributes=$_POST['Subproject'];
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

		if(isset($_POST['Subproject']))
		{
			$model->attributes=$_POST['Subproject'];
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
		$dataProvider=new CActiveDataProvider('Subproject');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Subproject('search');
		$model->unsetAttributes();  // clear any default values

		//obtenemos el primer proyecto
		$projects = Project::model()->findAll(array('order'=>'name ASC'));
		if ($projects) $model->project_id = $projects[0]->id;

		if(isset($_GET['Subproject']))
			$model->attributes=$_GET['Subproject'];

		$this->render('admin',array(
			'model'=>$model,
			'projects'=>$projects,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subproject the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subproject::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subproject $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subproject-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
