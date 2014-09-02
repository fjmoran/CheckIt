<?php

class SiteController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';	
	public $attempts = 5; // allowed 5 attempts
	public $counter;

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','error','forgotpassword','changepassword','captcha'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('logout','index'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('report'),
				'roles'=>array('admin', 'dashboard_user', 'dashboard_manager', 'viewer'),
			),
			array('allow',
				'actions'=>array('admin'),
				'roles'=>array('dashboard_admin', 'strategy_admin', 'workflow_admin', 'admin', 'system_admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionReport() {

		$projects = Project::model()->findAll();

		/*$detail = array();
		foreach ($projects as $project) {
			$d = array();
			$d['title'] = $project->name;
			$d['compliance'] = round($project->compliance,0);
			$detail[] = $d;
		}*/

		$this->render('report',array(
			'yellow' => Yii::app()->utility->getOption('kpi_yellow') / 100,
			'red' => Yii::app()->utility->getOption('kpi_red') / 100,
			'projects'=>$projects,
		));
	}

	public function actionAdmin() {
		$admins = array('admin','strategy_admin','workflow_admin','dashboard_admin');
		$roles = User::model()->findByPk(Yii::app()->user->id)->roleIDs;
		if ($roles) {
			foreach ($roles as $rol) {
				$data = Role::model()->findByPk($rol);
				if (in_array($data->name, $admins) && $data->start_page) {
					$this->redirect(array($data->start_page));
					exit;
				}
			}
		}
		exit;
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$roles = User::model()->findByPk(Yii::app()->user->id)->roleIDs;
		if ($roles) {
			$rol = Role::model()->findByPk($roles[0]);
			if ($rol->start_page) {
				$this->redirect(array($rol->start_page));
			}
		}
		exit;

/*		if (in_array(2, $roles)) {
			$this->redirect(array('site/report'));
			exit;
		}
		if (in_array(3, $roles)) {
			$this->redirect(array('user/login'));
			exit;
		}
		if (in_array(4, $roles)) {
			$this->redirect(array('project/myprojects'));
			exit;
		}
		if (in_array(1, $roles)) {
			$this->redirect(array('user/admin'));
			exit;
		}*/
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionForgotPassword() {
		$this->layout='//layouts/column1';	

		$model=new ForgotPasswordForm;

		if(isset($_POST['ForgotPasswordForm']))
		{
			$model->attributes=$_POST['ForgotPasswordForm'];
			if ($model->validate() && $model->sendpassword()) {
				Yii::app()->user->setFlash('message', 'La contraseña fue enviada al e-mail indicado.');
			}
			else {
				Yii::app()->user->setFlash('message', 'El e-mail ingresado no corresponde.');
			}
		}

		$this->render('forgotpassword',array(
			'model'=>$model,
		));		
	}

	public function actionChangePassword($t) {
		$this->layout='//layouts/column1';	

		$model=new ChangePasswordForm;
		if (!$model->checkToken($t)) {
			Yii::app()->user->setFlash('error', 'Debe solicitar nuevamente la recuperación de la contraseña.');
			$model->addError('message','Debe solicitar nuevamente la recuperación de la contraseña.');
		}

		if(isset($_POST['ChangePasswordForm']))
		{
			$model->attributes=$_POST['ChangePasswordForm'];
			if ($model->validate() && $model->checkpassword($t)) {
				Yii::app()->user->setFlash('message', 'La contraseña fue cambiada exitosamente. <a href="'.Yii::app()->createUrl('site/login').'">Puede ingresar nuevamente haciendo click aquí</a>');
			}
		}

		$this->render('changepassword',array(
			'model'=>$model,
		));		
	}

	private function captchaRequired(){
		return Yii::app()->session->itemAt('captchaRequired') >= $this->attempts;
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='//layouts/column1';	

		$model = $this->captchaRequired()? new LoginForm('captchaRequired') : new LoginForm;
		//$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
			else {
				$this->counter = Yii::app()->session->itemAt('captchaRequired') + 1;
				Yii::app()->session->add('captchaRequired',$this->counter);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}