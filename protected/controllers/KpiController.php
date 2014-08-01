<?php

class KpiController extends Controller
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
				'actions'=>array('create','update','admin','delete','ajaxKpi','ajaxFillTree'),
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

	public function actionAjaxFillTree() {
        // accept only AJAX request (comment this when debugging)
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        
        if (!isset($_POST['subproject_id'])) exit;

        // parse the user input
        $parent_id = "NULL";
        if (isset($_POST['root']) && $_POST['root'] !== 'source') {
            $parent_id = (int) $_POST['root'];
        }
        // read the data (this could be in a model)
        $children = Yii::app()->db->createCommand(
            "SELECT m1.id, m1.name AS text, m2.id IS NOT NULL AS hasChildren "
            . "FROM kpi AS m1 LEFT JOIN kpi AS m2 ON m1.id=m2.parent_id "
            . "WHERE m1.parent_id <=> $parent_id "
            . "AND m1.subproject_id = ".$_POST['subproject_id']." "
            . "GROUP BY m1.id ORDER BY m1.name ASC"
        )->queryAll();

/*        $treedata=array();
		foreach($children as $child){
			$options=array('href'=>'#','id'=>$child['id'],'class'=>'treenode');
			$nodeText = CHtml::openTag('a', $options);
			$nodeText.= $child['text'];
			$nodeText.= CHtml::closeTag('a')."\n";
			$child['text'] = $nodeText;
			$treedata[]=$child;
		}*/

        echo str_replace(
            '"hasChildren":"0"',
            '"hasChildren":false',
            CTreeView::saveDataAsJson($children)
        );		
	}

	public function actionAjaxKpi()
	{
		if ($_POST && $_POST['subproject_id']) {
			$where = 'subproject_id=:subproject_id';
			if ($_POST['this']) $where = $where." AND id!=".(int)$_POST['this'];
			$data=Kpi::model()->findAll($where, 
						  array(':subproject_id'=>(int) $_POST['subproject_id']));

			$data=CHtml::listData($data,'id','name');
			foreach($data as $value=>$name)
			{
				echo CHtml::tag('option',
						   array('value'=>$value),CHtml::encode($name),true);
			}			
		}
	}

	public function actionChangeStatus($id) {
		$model=$this->loadModel($id);

		if(isset($_POST['Kpi']))
		{
			$model->real_value = $_POST['Kpi']['real_value'];
			$model->modified_date = new CDbExpression("NOW()");
			if ($model->save(array('real_value','modified_date'))) {
				$this->redirect(array('project/view','id'=>$model->subproject->project->id));
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
		$model=new Kpi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kpi']))
		{
			$model->attributes=$_POST['Kpi'];
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

		if(isset($_POST['Kpi']))
		{
			$model->attributes=$_POST['Kpi'];

			$ret = false;
			if (!$model->parent_id) {
				$ret = $model->saveNode();
			}
			else {
				$root = Kpi::model()->findByPk($model->parent_id);
				$ret = $model->moveAsLast($root);
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
		$dataProvider=new CActiveDataProvider('Kpi');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kpi('search');
		$model->unsetAttributes();  // clear any default values

		//obtenemos el primer subproyecto
		$subprojects = Subproject::model()->with('project')->findAll(array('order'=>'project.name ASC, t.name ASC'));
		if ($subprojects) $model->subproject_id = $subprojects[0]->id;

		if(isset($_GET['Kpi']))
			$model->attributes=$_GET['Kpi'];

		$this->render('admin',array(
			'model'=>$model,
			'subproject_id'=>$subprojects[0]->id,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kpi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kpi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kpi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kpi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
