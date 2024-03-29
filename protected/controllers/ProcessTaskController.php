<?php

class ProcessTaskController extends Controller
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
			'postOnly + updateJS', // we only allow deletion via POST request
			'postOnly + deleteJS', // we only allow deletion via POST request
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
				'actions'=>array('createjs','updatejs','deletejs','update','delete'),
				'roles'=>array('admin', 'workflow_admin'),
			),
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
	public function actionCreateJS()
	{
		//read the post input (use this technique if you have no post variable name):
//		$post = file_get_contents("php://input");

		//decode json post input as php array:
//		$data = CJSON::decode($post, true);

		//contact is a Yii model:
		$model=new ProcessTask;

		//load json data into model:
		$model->attributes = $_POST;
		//this is for responding to the client:
		$response = array();

		//save model, if that fails, get its validation errors:
		if ($model->save() === false) {
			$response['success'] = false;
			$response['errors'] = $model->errors;
			//echo CJSON::encode($model->errors);exit;
		} else {
			$response['success'] = true;
			$response['data'] = $model;

			//respond with the saved contact in case the model/db changed any values
			//$response['contacts'] = $contact; 
		}

		//respond with json content type:
		header('Content-type:application/json');

		//encode the response as json:
		echo CJSON::encode($response);

		//use exit() if in debug mode and don't want to return debug output
		exit();
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateJS($id)
	{

		$model=$this->loadModel($id);
		$model->attributes = $_POST;

		$response = array();

		if ($model->save() === false) {
			$response['success'] = false;
			$response['errors'] = $model->errors;
		} else {
			$response['success'] = true;
		}

		header('Content-type:application/json');
		echo CJSON::encode($response);
		exit();
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteJS($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionUpdate($id) {
		//$this->layout = 'modal';

		$model=$this->loadModel($id);

		$step=new ProcessStep('search');
		$step->unsetAttributes();  // clear any default values
		$step->process_task_id = $model->id;

		if(isset($_POST['ProcessTask']))
		{
			$model->attributes=$_POST['ProcessTask'];
			if($model->save())
				$this->redirect(array('process/view','id'=>$model->process_id));
		}

		$this->render('update',array(
			'model'=>$model,
			'process'=>$model->process,
			'step'=>$step,
		));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		
		ProcessConnector::model()->deleteAllByAttributes(array('source_task_id'=>$model->id));
		ProcessConnector::model()->deleteAllByAttributes(array('target_task_id'=>$model->id));
		
		$process_id = $model->process_id;
		$model->delete();
		$this->redirect(array('process/view', 'id'=>$process_id));
		exit;

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ProcessTask');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProcessTask('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProcessTask']))
			$model->attributes=$_GET['ProcessTask'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProcessTask the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProcessTask::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProcessTask $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='process-task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
