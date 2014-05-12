<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record=User::model()->findByAttributes(array('email'=>$this->username));
		if($record===null)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($record->password!==md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($record->status==0)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->id=$record->id;

			//User::model()->updateByPk($this->id,array('lastvisit'=>new CDbExpression('NOW()')));
			$record->lastvisit = new CDbExpression("NOW()");
			$record->update(array('lastvisit'));

			$roles = $record->roleNames;
			$this->setState('roles', $roles);
			$this->setState('firstname', $record->firstname);
			$this->setState('lastname', $record->lastname);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId(){
		return $this->id;
	}
}