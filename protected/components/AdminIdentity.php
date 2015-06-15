<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
	private $_id;

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
		//$model = Users::model()->findByAttributes(array('username' => $this->username));
		$model = Users::model()->find(array(
			'condition'=>'username = :uname AND users_group_id NOT IN (4,5,6) ',
			'params'=>array(':uname'=>$this->username),
		));
		//echo $model->password; echo '<br>';
		//echo $model->hashPassword($this->password);
		if($model === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;

		}else if($model->password !== $model->hashPassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;

		}else {
			$this->_id = $model->users_group_id;
			$this->username = $model->username;
			$this->setState('username', $model->username);
			$this->setState('name', $model->name);
			$this->setState('group', $model->users_group->name);
			$this->setState('id_user', $model->id);
			$this->setState('last_login', date('Y-m-d H:i:s'));
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->_id;
	}
}
