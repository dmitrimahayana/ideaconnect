<?php
class EWebUser extends CWebUser
{
	/**
	 * update last login setelah sukses login.
	 */
	protected function afterLogin($fromCookie) {
		parent::afterLogin($fromCookie);
		 file_put_contents(Yii::getPathOfAlias('webroot').'/afterLogin.txt',
			"hello, after Login event\n".date('Y-m-d H:i:s'));
	}

	/**
	 * Load user model.
	protected function loadUser($id=null) {
		if($this->_model === null) {
			if($id !== null) {
				$this->_model = User::model()->findByPk($id);
			}
		}
		return $this->_model;
	}
	*/
}
