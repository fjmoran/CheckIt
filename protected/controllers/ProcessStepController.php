<?php

class ProcessStepController extends Controller
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
			'postOnly + createJS', // we only allow deletion via POST request
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','createJS','delete'),
				'roles'=>array('admin'),
			),
/*			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
		$this->layout = 'modal';

		$process_task_id = Yii::app()->request->getQuery("process_task_id"); //$_GET['process_id'];
		if (!(int)$process_task_id) exit;
		$processTask = ProcessTask::model()->findByPk($process_task_id);

		$model=new ProcessStep;
		if (!$model->process_task_id) $model->process_task_id = $process_task_id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProcessStep']))
		{


			$model->attributes = $_POST['ProcessStep'];

			$response = array();

			if ($model->save() === false) {
				$response['success'] = false;
				$response['errors'] = $model->errors;
				//echo CJSON::encode($model->errors);exit;
			} else {
				$response['success'] = true;
				$response['data'] = $model;
			}

			header('Content-type:application/json');
			echo CJSON::encode($response);

			exit();

/*			$model->attributes=$_POST['ProcessStep'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/
		}

		$this->render('create',array(
			'task'=>$processTask,
			'model'=>$model,
		));
	}

	public function actionCreateJS()
	{

		$model=new ProcessStep;
		if (isset($_POST['ProcessStep'])) {



		}

		//use exit() if in debug mode and don't want to return debug output
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

		if(isset($_POST['ProcessStep']))
		{
			$model->attributes=$_POST['ProcessStep'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('ProcessStep');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProcessStep('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProcessStep']))
			$model->attributes=$_GET['ProcessStep'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProcessStep the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProcessStep::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProcessStep $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='process-step-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
