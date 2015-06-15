<?php

class AdminbackofficeController extends SBaseController /* Controller */
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	//public $layout='admin';
	public $defaultAction = 'index';

	/**
	 * Initialize admin template
	 */
	public function init() {
		if(!Yii::app()->user->isGuest) {
			$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
			$arrThemes = Utility::getCurrentTemplate($groupPage);
			Yii::app()->theme = $arrThemes['template'];
			$this->layout = $arrThemes['layout'];
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Manages admin backoffice
	 */
	public function actionAdminManage()	{
		 
		$model =CcnUsers::model();
		
		$criteria = new CDbCriteria;
		if(isset($_GET['CcnUsers'])){
			if($_GET['CcnUsers']['name'] != ''){
				$criteria->compare('name', $_GET['CcnUsers']['name']);
			}
			if($_GET['CcnUsers']['users_group_id'] != ''){
				$criteria->compare('users_group_id', $_GET['CcnUsers']['users_group_id']);
			}
			if($_GET['CcnUsers']['email'] != ''){
				$criteria->condition = 'email like "%'.$_GET['CcnUsers']['email'].'%"';
			}
			if($_GET['CcnUsers']['mobile_no'] != ''){
				$criteria->compare('mobile_no', $_GET['CcnUsers']['mobile_no']);
			}
			if($_GET['CcnUsers']['register_date'] != ''){
				$criteria->compare('register_date', date('y-m-d',strtotime($_GET['CcnUsers']['register_date'])),true);
			}
			if($_GET['CcnUsers']['actived'] != ''){
				$criteria->compare('actived', $_GET['CcnUsers']['actived']);
			}
			if($_GET['CcnUsers']['block'] != ''){
				$criteria->compare('block', $_GET['CcnUsers']['block']);
			}
		}
		
		$criteria->order = 'register_date DESC';
		$criteria->with = 'users_group';
		$criteria->addCondition('users_group.group_login = "back_office" ');
		
		$dataProvider = new CActiveDataProvider(get_class($model),array('criteria'=>$criteria));
	
		
		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial('/admin_backoffice/admin_manage',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'columns' => $columns,
			), true, false);

			echo CJSON::encode($message);

		} else {
			$title = 'Admin';
			$this->pageTitle = 'Kelola Member: '.$title;
			$this->render('/admin_backoffice/admin_manage',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'columns' => $columns,
			));
		}

	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdminAdd() {
			$model = new CcnUsers('addAdmin');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnUsers'])) {
			$title = 'admin';			
			$model->attributes = $_POST['CcnUsers'];
		
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			}else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 1,
							'id' => 'partial-ccn-users',
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Member '.$title.' berhasil ditambahkan.').'</strong></div>',
						));
					
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
		}

		$message['data'] = $this->renderPartial('/admin_backoffice/admin_add',array(
			'model'=>$model,
		), true, false);

		echo CJSON::encode($message);

	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdminEditPassword($id, $type)
	{
		
		$model = CcnEditAdminAccount::model()->findByPk($id);
		$model->scenario = 'editPassword';
		
			// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['CcnEditAdminAccount'])) {
			$title = 'admin';			
			$model->attributes = $_POST['CcnEditAdminAccount'];

			$jsonError = CActiveForm::validate($model);			
			if(!$model->validate()) {
				echo $jsonError;
			}else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save(false)) {
						echo CJSON::encode(array(
							'type' => 2,
							'get' => Yii::app()->controller->createUrl('success', array('type'=>'password')),
						));
					
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
		}

 		$message['data'] = $this->renderPartial('/admin_backoffice/admin_edit',array(
			'model'=>$model,
		), true, false);

		echo CJSON::encode($message);
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionSuccess() {
		if($_GET['type'] == 'passsword'){
			$title = 'Ubah Password';
			$desc = 'Password anda berhasil diperbaharui';
		}else{
			$title = 'Ubah Akun';
			$desc = 'Akun anda berhasil diperbaharui';
		}
		
		$data .= '<div class="dialog-header">'.$title.'</div>';
		$data .= '<div class="dialog-content">'.$desc.'</div>';
		$data .= '<div class="dialog-submit">';
		$data .= '<input id="closed" type="button" value="'.Yii::t('', 'Keluar').'" />';
		$data .= '</div>';	

		$result['data'] = $data;
		echo CJSON::encode($result);
	}	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAdminView($id) {
		$this->render('/admin_backoffice/admin_view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAdminDelete($id) {
		$model = $this->loadModel($id);
		$name = $model->name;
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
						
				$model->delete();
				//Yii::app()->user->setFlash('success', Yii::t('', 'Admin '.$name.' berhasil dihapus.'));
				echo CJSON::encode(array(
					'type' => 1,
					'id' => 'partial-ccn-users',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Admin '.$name.' berhasil dihapus.').'</strong></div>',
				));
				
		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">Hapus Member '.$name.'</div>';
			$data .= '<div class="dialog-content">';
			if($id == '2') {
				$data .= Yii::t('', 'Maaf, superadmin tidak bisa dihapus.');		
			} else {
				$data .= Yii::t('', 'Apakah anda yakin ingin menghapus item ini?');			
			}
			$data .= '</div>';
			$data .= '<div class="dialog-submit">';
			$data .= $id != '2' ? '<input type="submit" value="'.Yii::t('', 'Hapus').'" />' : '' ;
			$data .= '<input id="closed" type="button" value="'.Yii::t('', 'Keluar').'" />';
			$data .= '</div>';
			$data .= '</form>';		

			$result['data'] = $data;
			echo CJSON::encode($result);
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CcnUsers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionActivate($gid, $id)
	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('actived' => 1)) > 0){
			// Yo, after save the member registration datas, deliver the activation mail to his/her email..
			// First, select mail template from ccn_email_template which name is 'email_aktivasi'
			$activationMail = CcnEmailTemplate::model()->find(array(
				'select'	=> 'message',
				'condition' => 'name = :name',
				'params' => array(
					':name' => 'email_approval',
				),
			));
							
			$nowDate	= date('l, d F Y');
			$frontPage	= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->getBaseUrl();
			$contactUs	= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->getBaseUrl().'/contact/pcr-carrer-center-politeknik-riau?=';
			
			// prepare some words would changed with variables above
			$search		= array('{$now_date}', '{$front_page}', '{$contact_us}');
					
			// prepare the datas to be wrote on the mail..
			$replace	= array($nowDate, $frontPage, $contactUs);
								
			// here we go, replace the mathced words in $search with all words in $replace.
			$msg		= str_ireplace($search, $replace, $activationMail->message);
					
			// Just for testing whether the email template is succesfully changed or not..
			$filePath	= Yii::app()->basePath.'/../media/employerapproval.html';
			
					
			// Yo, you have to modified the statement below to send the mail...
			//Utility::sentEmail($webOption->email_admin, 'ECC UGM', $user->email, $user->nama_tayang, $emailAktifasi->subjek, $msg);
			Yii::app()->user->setFlash('success', Yii::t('', 'Status keanggotaan '.$model->name.' ('.$model->email.') berhasil disetujui.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
			
			/* Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diaktifkan.'));
			$this->redirect(array('adminmanage','gid'=>$gid)); */
		}
	}
	
	
	public function actionBlock($gid, $id)	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('block' => 1)) > 0){
			Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diblok.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
		}
	}
	
	public function actionUnBlock($gid, $id)	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('block' => 0)) > 0){
			Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diaktifkan kembali.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdminEditAccount($id)
	{
		
		$model = CcnEditAdminAccount::model()->findByPk($id);
		$model->scenario = 'editAccount';
		
			// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['CcnEditAdminAccount'])) {
			$title = 'admin';			
			$model->attributes = $_POST['CcnEditAdminAccount'];
		
			$jsonError = CActiveForm::validate($model);			
			if(!$model->validate()) {
				echo $jsonError;
			}else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save(false)) {
						echo CJSON::encode(array(
							'type' => 2,
							'get' => Yii::app()->controller->createUrl('Success', array('type'=>'account')),
						));
					
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
		}

 		$message['data'] = $this->renderPartial('/admin_backoffice/admin_edit',array(
			'model'=>$model,
		), true, false);

		echo CJSON::encode($message);
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdminEdit($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['CcnUsers'])) {
			$title = 'admin';			
			$model->attributes = $_POST['CcnUsers'];
		
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			}else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 1,
							'id' => 'partial-ccn-users',
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Member '.$title.' berhasil diperbarui.').'</strong></div>',
						));
					
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
		}

		$message['data'] = $this->renderPartial('/admin_backoffice/admin_edit',array(
			'model'=>$model,
		), true, false);

		echo CJSON::encode($message);
	}
	
}
