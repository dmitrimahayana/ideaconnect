<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $email;
	private $_id;
	public $users_group_id;

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
		$key = explode('|separator|',$this->password);
		$password = $key[0];
		$userGroup = $key[1];
		
		if ($userGroup == 4 || $userGroup == 5)
			$record = Users::model()->findByAttributes(array('email' => $this->username), 'users_group_id = 4 OR users_group_id = 5');
		else
			$record = Users::model()->findByAttributes(array('email' => $this->username, 'users_group_id' => 6));
			
		if($record == null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if($record->password !== $record->hashPassword($password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $record->users_group_id;
			$this->username = $record->username;
			$this->setState('id_user', $record->id);
			$this->setState('username', $record->username);
			$this->setState('status_user', $record->status_user);			
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
