<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgotPasswordForm extends CFormModel
{
	public $username;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required'),
			array('username', 'email','message'=>"El email ingresado no es correcto"),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'E-mail',
		);
	}

	public function sendpassword() 
	{   
		// Buscamos al usuario
		$user = User::model()->find('email=:email', array(':email' => $this->username));

		if ($user) {
			//creamos el token
			$token = md5(uniqid(mt_rand(), true));

			$user->token = $token;
			$user->token_created = new CDbExpression('NOW()');
			$user->save(false, 'token,token_created');

			$link = Yii::app()->createAbsoluteUrl('site/changepassword', array('t' => $token));

			$message            = new YiiMailMessage;
			$message->view = "forgotpassword";
			$params              = array('user'=>$user, 'link'=>$link);
			$message->subject    = 'Check!It - Recuperar contraseña';
			$message->setBody($params, 'text/html');
			$message->addTo($this->username);
			$message->from = 'checkit@gmail.com';   
			Yii::app()->mail->send($message);      
		}

		return true; 
	}

}
