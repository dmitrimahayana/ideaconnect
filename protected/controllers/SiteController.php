<?php

class SiteController extends Controller
{
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
	
	/**
	 * Initialize public template
	 */
	public function init() {
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout'];
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {

		//$this->layout = 'front_main';
		$setting = WebOption::model()->findByPk(1);

		$this->pageTitle = $setting->web_title;
		$this->pageDescription = $setting->meta_description;
		$this->pageMeta = $setting->meta_keyword;
		$this->render('front_index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
				
				$this->layout = 'front_default';
				//$this->render('error');
				$this->render('error', $error);
			}
				
		
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{	
		Yii::import('modules.member.models.CcnJobseekerBio');
		Yii::import('modules.member.models.CcnJobseekerEdu');
		$model=new LoginForm;
		
		// if it is ajax validation request
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			
			$ccnUsers = Users::model()->findByAttributes(array('email' => $model->email));
			if($ccnUsers != null)
				$model->users_group_id = $ccnUsers->users_group_id;
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				$message = array();
				$message['data'] = $this->renderPartial('ajax_front_login',array(
					'model'=>$model
				), true, false);
				$error = json_decode($jsonError, true);
				$merge = array_merge_recursive( $error, $message );
				$resJson = json_encode($merge);
				echo $resJson;

			} else {
				if($model->login()) {
					Yii::app()->session['current_login_group_page'] = 'public';
					
					$user = Users::model()->find(array(
						//'select' => 'actived',
						'condition'=> 'id = :id',
						'params' => array(':id' => Yii::app()->user->id_user)
					));
					if($user->block==1){
						$redirect = Yii::app()->createUrl('member/register/notifier', array('gid'=>Yii::app()->user->id, 'type'=>'blocked'));
						Yii::app()->user->logout();
					}else{
						if($user->actived == 1) {
							$status = Users::model()->find(array(
								'select' => 'status_user',
								'condition' => 'id = :id' ,
								'params' => array(':id'=>Yii::app()->user->id_user) 			
							));
	
							if(Yii::app()->user->id == 6) {
								$redirect = Yii::app()->createUrl('member/employer');
							} else {
								if($status->status_user == 1) {
									$redirect = Yii::app()->createUrl('member/register/notifier', array('gid'=>Yii::app()->user->id, 'type'=>'confirm'));
									Yii::app()->user->logout();
	
								} else if($status->status_user == 2) {
									$redirect = Yii::app()->createUrl('member/register/notifier', array('gid'=>Yii::app()->user->id, 'type'=>'approved'));
									Yii::app()->user->logout();
	
								} else {
									$bio = CcnJobseekerBio::model()->findByAttributes(array('swt_users_id' => Yii::app()->user->id_user));
									if($bio == null) {
										$redirect = Yii::app()->createUrl('member/register/wizard');
	
									} else {
										if ($status->status_user == 3 ) { //aproval admin
                                                                                        $redirect = Yii::app()->createUrl('member/biodata/wizard');
                                                                                }elseif ($status->status_user == 4 ) { //biodata complete
                                                                                        $redirect = Yii::app()->createUrl('member/education/wizard');
										}elseif ($status->status_user >= 5 ) { //education not empty
											if(Yii::app()->user->id == 4){ //if alumni, should filled grade smu
												$checking = CcnJobseekerEdu::model()->find(array(
													'select' => 'degree',
													'condition' => 'swt_users_id = :id AND degree= :name',
													'params'=> array(':id'=>Yii::app()->user->id_user, ':name'=>'SMA')
												));
												if($checking == null ) {
													$redirect = Yii::app()->createUrl('member/education/wizard');
												}else {
                                                                                                      $redirect = Yii::app()->createUrl('member/jobseeker/index');
                                                                                                }
											}else
                                                                                            $redirect = Yii::app()->createUrl('member/jobseeker/index');
										} 
									}
	
								}
							}
						} else {
							$redirect = Yii::app()->createUrl('member/register/notifier', array('gid'=>Yii::app()->user->id, 'type'=>'activation'));
							Yii::app()->user->logout();
						}
					}

					echo CJSON::encode(array(
						'redirect' => $redirect,
					));

				} else {
					print_r($model->getErrors());
				}
			}
			Yii::app()->end();

		} else {
			if(!isset($_GET['type'])) {
				$this->render('front_login',array(
					'model'=>$model
				));
			}
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSignup() {
		$this->render('front_signup');
	}





	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAboutUs() {
		$this->render('front_about_us');
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
				$webOption = WebOption::model()->findByPk(1);
				$fromEmail = $_POST['ContactForm']['email'];
				$nameSender = $_POST['ContactForm']['name'];
				$emailDestination = $webOption->email_admin;
				$nameDestination = 'Politeknik Caltex Riau';
				$subject = $_POST['ContactForm']['subject'];
				$message = $_POST['ContactForm']['body'];
				
				if(Utility::sentEmail($fromEmail, $nameSender, $emailDestination, $nameDestination, $subject, $message)){
					Yii::app()->user->setFlash('success','Terima kasih sudah menghubungi kami. Kami akan segera mengubungi anda segera.');
					$this->refresh();
				}
				/* $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);*/
				 
			}
		}
		$this->render('front_contact',array(
			'model'=>$model
		));
	}


	/**
	 * Displays the login page
	 */
	public function actionForgot()
	{	
		Yii::import('application.modules.member.models.CcnUsers');
		Yii::import('application.modules.email.models.CcnEmailTemplate');
		$model=new CcnUsers;

		if(Yii::app()->request->isPostRequest) {
			if(isset($_POST['CcnUsers'])) {
				$model->attributes=$_POST['CcnUsers'];
				$model->scenario = 'forgot';
				
				if(isset($_GET['type'])) {
					$jsonError = CActiveForm::validate($model);
					if(strlen($jsonError) > 2) {
						echo $jsonError;
					} else {
						
						//generate new password for user
						$resetPassword = CcnUsers::model()->generateRandomString();
						$user = CcnUsers::model()->findByAttributes(array('email'=>$_POST['CcnUsers']['email']));
						//sent new email to user
						$activationTemplate = CcnEmailTemplate::model()->find(array(
							'condition' => 'name = :name',
							'params' => array(
								':name' => 'email_resetpass',
							),
						));
						
						
						$date = date('d F Y');
						$password = $resetPassword;
						$contact = Yii::app()->createUrl('contact/pcr-carrer-center-politeknik-riau?=');
						$replace = array(
							$date, $password, $contact
						);
						$search = array(
							'{$now_date}','{$password}','{$contact}'
						);
						
						$msg = str_ireplace($search, $replace, $activationTemplate->message);
						
						$webOption = WebOption::model()->findByPk(1);
						Utility::sentEmail($webOption->email_admin, 'PCR Career Center', $model->email, $model->email, 'Permintaan Reset Password', $msg);
						
						//encrypt the new database
						$newPassword = CcnUsers::model()->hashPassword($resetPassword);
						
						//update  database
						$sql = 'UPDATE swt_users SET password="'.$newPassword.'" WHERE email = "'.$user->email.'";';
						Yii::app()->db->createCommand($sql)->execute();
							
						echo CJSON::encode(array(
							'type' => 4,
							'get' => Yii::app()->createUrl('site/forgot', array('type'=>'ajax','email'=>$model->email)),
						));
						 
					}
				} else {
					if($model->validate()) {

					} else {
						$this->render('front_forgot', array(
							'model' => $model,
						));
					}
				}
			}

		} else {
			if(isset($_GET['type'])) {
				$message['data'] = $this->renderPartial('ajax_front_forgot',array(
					'model' => $model,
				), true, false);
				echo CJSON::encode($message);

			} else {
				$this->render('front_forgot', array(
					'model' => $model,
				));
			}
		}

	}












	public function actionTes()
	{
		//echo file_get_contents(Yii::app()->createUrl('/vacancy/member/subscribe'));
		echo file_get_contents('http://localhost/pcr.com/vacancy/member/subscribe');
		
		/* $menu = Menu::model()->findAll(array(
			'condition'=>"srbac_items_task_name != '0'"
		));
		foreach($menu as $val){
			$arrMenu[] = $val->id;
		}
		$list = implode(',', $arrMenu);
		MenuAuth::model()->updateAll(array('has_task'=>1), "swt_menu_id IN ($list)"); */
		
	/* 	Yii::import('modules.member.models.CcnJobseekerEdu');
			$checking = CcnJobseekerEdu::model()->find(array(
										'select' => 'degree',
										'condition' => 'swt_users_id = :id and degree = :name',
										'params'=> array(':id'=>19, ':name'=> 'SMA' )
									));
			$items = array();
			foreach($checking as $key => $val){
				$items[$val->id] = $val->id;
					
			}
			echo print_r($items); */
			//Utility::sentEmail('noreplay@swevel.com', 'swevel', 'didik@swevel.com', 'didik', 'test smtp', 'test saja');
	}
	
	public function actionUnsubscribe(){
		Yii::import('application.modules.vacancy.models.CcnSubscribeVacancyJobseeker');
		Yii::import('application.modules.test.models.CcnSubscribeTestCall');
		Yii::import('application.modules.member.models.CcnSubscribeContent');
		Yii::import('application.modules.member.models.CcnSubscribeVacancyEmployer');
		Yii::import('application.modules.member.models.CcnUsers');
		Yii::import('application.modules.member.models.CcnJobseekerBio');
		Yii::import('application.modules.email.models.CcnEmailTemplate');	
		$key = $_GET['key'];
		$email = $_GET['email'];
		$type = $_GET['type'];

		$user = CcnUsers::model()->findByAttributes(array('email'=>$email));
		$hashKey = Users::model()->hashPassword($user->mobile_no);
		if($type == 'weekly-info' || $type == 'recap-vacancy') {
			$hashKey = Users::model()->hashPassword($user->register_date);
		}
		$webOption = WebOption::model()->findByPk(1);
		if($hashKey == $key){
			//delete subscribe type vacancy
			if($type == 'vacancy') {
				$subscribeVacancyJobseeker = CcnSubscribeVacancyJobseeker::model()->findByAttributes(array('swt_users_id'=>$user->id));
				$unsubscribeType = 'Lowongan';
				if($subscribeVacancyJobseeker != null){
					if($subscribeVacancyJobseeker->delete()){
						$activationTemplate = CcnEmailTemplate::model()->find(array(
							'condition' => 'name = :name',
							'params' => array(
								':name' => 'email_subscribe',
							),
						));
						$date = date('d F Y');
						$email = $user->email;
						$content = 'Anda telah berhenti berlagganan email '.$unsubscribeType.'';
						$name = $user->jobseeker_bio1->complete_name;

						$replace = array(
							$date, $name, $content
						);

						$search = array(
							'{$tanggal}','{$nama_tayang}','{$content}',
						);
						
						$msg = str_ireplace($search, $replace, $activationTemplate->message);
						Utility::sentEmail($webOption->email_admin, 'PCR', $user->email, $user->name, 'Berhenti berlangganan lowongan', $msg);
					}
				}
				
			//delete subscribe type news
			}elseif($type == 'content') {
				$subscribeContent = CcnSubscribeContent::model()->findByAttributes(array('swt_users_id'=>$user->id));
				$unsubscribeType = 'Berita';
				if($subscribeContent != null){
					if($subscribeContent->delete()){
						$activationTemplate = CcnEmailTemplate::model()->find(array(
							'condition' => 'name = :name',
							'params' => array(
								':name' => 'email_subscribe',
							),
						));
						$date = date('d F Y');
						$email = $user->email;
						$content = 'Anda telah berhenti berlagganan email '.$unsubscribeType.'';
						$name = $user->jobseeker_bio1->complete_name;

						$replace = array(
							$date, $name, $content
						);

						$search = array(
							'{$tanggal}','{$nama_tayang}','{$content}',
						);
						
						$msg = str_ireplace($search, $replace, $activationTemplate->message);
						Utility::sentEmail($webOption->email_admin, 'PCR', $user->email, $user->name, 'Berhenti berlangganan berita', $msg);
					}
				}

			//delete subscribe type test call
			}elseif($type == 'test-call') {
				$subscribeTestCall = CcnSubscribeTestCall::model()->findByAttributes(array('swt_users_id'=>$user->id));
				$unsubscribeType = 'Panggilan Tes';
				if($subscribeTestCall != null){
					if($subscribeTestCall->delete()){
						$activationTemplate = CcnEmailTemplate::model()->find(array(
							'condition' => 'name = :name',
							'params' => array(
								':name' => 'email_subscribe',
							),
						));
						$date = date('d F Y');
						$email = $user->email;
						$content = 'Anda telah berhenti berlagganan email '.$unsubscribeType.'';
						$name = $user->jobseeker_bio1->complete_name;

						$replace = array(
							$date, $name, $content
						);

						$search = array(
							'{$tanggal}','{$nama_tayang}','{$content}',
						);
						
						$msg = str_ireplace($search, $replace, $activationTemplate->message);
						Utility::sentEmail($webOption->email_admin, 'PCR', $user->email, $user->name, 'Berhenti berlangganan panggilan tes', $msg);
					}
				}
			//employer unsubscribe
			}elseif($type == 'weekly-info' || $type == 'recap-vacancy'){
				$subscribeVacancyEmployer = CcnSubscribeVacancyEmployer::model()->findByAttributes(array('swt_users_id'=>$user->id));
				if($type == 'weekly-info') {
					$unsubscribeType = 'Info Mingguan';
				}elseif($type == 'recap-vacancy') {
					$unsubscribeType = 'Rekap Pelamar';
				}
				
				if($subscribeVacancyEmployer != null){
					if($subscribeVacancyEmployer->delete()){
						$activationTemplate = CcnEmailTemplate::model()->find(array(
							'condition' => 'name = :name',
							'params' => array(
								':name' => 'email_subscribe',
							),
						));
						$date = date('d F Y');
						$email = $user->email;
						$content = 'Anda telah berhenti berlagganan email '.$unsubscribeType.'';
						$name = $user->jobseeker_bio1->complete_name;

						$replace = array(
							$date, $name, $content
						);

						$search = array(
							'{$tanggal}','{$nama_tayang}','{$content}',
						);
						
						$msg = str_ireplace($search, $replace, $activationTemplate->message);
						Utility::sentEmail($webOption->email_admin, 'PCR', $user->email, $user->name, 'Berhenti berlangganan info mingguan', $msg);
					}
				}
			}
			$this->render('front_unsubscribe', array(
				'unsubscribeType'=>$unsubscribeType,
			));
		}
		
	}
	
	//count click banner
	public function actionCount(){
		Yii::import('application.modules.banner.models.CcnBanner');
		$id = $_POST['id'];
		
		
		$banner = CcnBanner::model()->findByPk($id);
		$totalCount = $banner->click_count + 1;
		if(!isset(Yii::app()->session['banner-klik'])) {		
			Yii::app()->session['banner-klik'] = date('d:m:Y:H:i:s');
			
			$sql = 'UPDATE `ccn_banner` SET click_count = '.$totalCount.' WHERE id = '.$id.';';
			Yii::app()->db->createCommand($sql)->execute();
		}elseif(isset(Yii::app()->session['banner-klik'])) {
			$arrDate = explode(':',Yii::app()->session['banner-klik']);
			$waktu_tujuan = mktime($arrDate[3], $arrDate[4], $arrDate[5],$arrDate[1],$arrDate[0],$arrDate[2]);
			$waktu_sekarang = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			$selisih_waktu = $waktu_tujuan-$waktu_sekarang;
			$selisih = abs($selisih_waktu);
			file_put_contents('tes.txt', $waktu_tujuan.'------'.$waktu_sekarang);
			if($selisih >= 10){
				file_put_contents('hahaha.txt', Yii::app()->session['banner-klik']);
				$sql = 'UPDATE `ccn_banner` SET click_count = '.$totalCount.' WHERE id = '.$id.';';
				Yii::app()->db->createCommand($sql)->execute();
				Yii::app()->session['banner-klik'] = date('d:m:Y:H:i:s');
			}
		}
		$val['value'] = $banner->target_url;
			
		echo CJSON::encode($val);
	}


}
