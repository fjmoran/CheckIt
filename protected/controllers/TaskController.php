<?php

class TaskController extends Controller
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
				'actions'=>array('view','create','update','admin','delete','ajaxTask'),
				'roles'=>array('admin', 'strategy_admin'),
			),
			array('allow',
				'actions'=>array('changestatus'),
				'roles'=>array('admin', 'strategy_user', 'strategy_manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAjaxTask()
	{
		if ($_POST && $_POST['subproject_id']) {
			$where = 'subproject_id=:subproject_id';
			if ($_POST['this']) $where = $where." AND id!=".(int)$_POST['this'];
			$data=Task::model()->findAll($where, 
						  array(':subproject_id'=>(int) $_POST['subproject_id']));

			$data=CHtml::listData($data,'id','name');
			foreach($data as $value=>$name)
			{
				echo CHtml::tag('option',
						   array('value'=>$value),CHtml::encode($name),true);
			}			
		}
	}

	public function actionChangeStatus($id, $page=0) {
		$model=$this->loadModel($id);

		if(isset($_POST['Task']))
		{
			switch ($model->status):
				case '0':
					$model->status='1';
					$model->end_date = new CDbExpression("NOW()");
					break;
				case '1':
					$model->status='0';
					$model->end_date = new CDbExpression("NULL");
					break;
			endswitch;

			$model->comments = $_POST['Task']['comments'];

			if ($model->saveNode(array('status','end_date','comments'))) {
				if ($page==1) $this->redirect(array('project/completed'));
				else $this->redirect(array('project/todo'));
			}
		}

		$this->renderPartial('changestatus',array(
			'model'=>$model,
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
		$model=new Task;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];

			$ret = false;
			if (!$model->parent_id) {
				$ret = $model->saveNode();
			}
			else {
				$root = Task::model()->findByPk($model->parent_id);
				$ret = $model->appendTo($root);
				//if ($ret) $ret = $model->save();
			}
			//if($model->save())
			if ($ret)
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

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];

			$ret = false;
			if (!$model->parent_id) {
				if (!$model->isRoot()) $ret = $model->moveAsRoot();
				$ret = $model->saveNode();
			}
			else {
				$root = Task::model()->findByPk($model->parent_id);
				$ret = $model->moveAsLast($root);
				$ret = $model->saveNode();
				//if ($ret) $ret = $model->save();
			}
			//if($model->save())
			if ($ret)
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
		$this->loadModel($id)->deleteNode();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$model->unsetAttributes();  // clear any default values

		//obtenemos el primer subproyecto
		$subprojects = Subproject::model()->with('project')->findAll(array('order'=>'project.name ASC, t.name ASC'));
		if ($subprojects) $model->subproject_id = $subprojects[0]->id;

		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
