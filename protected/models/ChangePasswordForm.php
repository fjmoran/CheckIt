<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePasswordForm extends CFormModel
{
	public $username, $password, $repeat_password;
	private $token_lifetime = 10; //in minutes

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('password, repeat_password', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password' => 'Contraseña',
			'repeat_password' => 'Repetir contraseña',
		);
	}

	public function checkToken($token) {
		$user = User::model()->find('token=:token', array(':token' => $token));
		if ($user) {
			$d=Yii::app()->db->createCommand("SELECT token_created + INTERVAL {$this->token_lifetime} MINUTE > NOW() AS q FROM user WHERE id='{$user->id}'")->queryAll();
			if ($d[0]['q'] == 1) {
				return true;
			}
		}
		return false;
	}

	public function checkpassword($token) {
		// Buscamos al usuario
		$user = User::model()->find('token=:token', array(':token' => $token));
		if ($user) {
			if ($this->password!=$this->repeat_password) {
				$this->addError('repeat_password', 'Las password ingresadas no coinciden.');
			}
			else {
				$user->password = $this->password;
				$user->token = new CDbExpression('NULL');
				$user->token_created = new CDbExpression('NULL');
				$user->save(false,'password,token,token_created');
				return true;

			}

		}

		return false;
	}

}
