<?php

class RegisterController extends Controller
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
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		//$this->layout = $arrThemes['layout'];
		$this->layout = 'front_register';
	}

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','employerdata','success','notifier','activation','selectcity','lupapassword'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('wizard','finish'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Member register
	 */
	public function actionIndex() {
		$gid = $_GET['gid'];
		if ($gid == 5) { //jobseeker
			$model = new CcnUsers('addJobseeker');
		}else { //employer
			$model = new CcnUsers('addEmployer');
		}

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnUsers'])) {
			$model->attributes=$_POST['CcnUsers'];
			$model->statistic_member_signal = true;
			if($gid == 5) {
				if($model->member_type == 4) {
					$model->scenario = 'addJobseekerAlumni';
					$model->users_group_id = 4;
				} else {
					$model->scenario = 'addJobseeker';
					$model->users_group_id = 5;
				}
			}
			$model->activation = md5(uniqid(mt_rand(), true)); // This is the activation key..
			$password	= $model->password; // -> The member's password
				$pay_model = CcnPayment::model()->find(array(
					'select'=>'total_payment',
					'condition' => 'user_group_id = '.$gid.''
				));
				$pay = substr($pay_model->total_payment, 0, -3 );
			$payAmount	= $pay.'.'.substr($model->mobile_no, -3).',00'; // Some rupiahs that member must pay... :)
			
			if($model->save()) {
				if($gid == 5) { //jobseeker
					
					// Check for member type, if he/she is an alumni then update his/her alumni data connected to swt_users table
					if($model->member_type == 4) {
						$alumni = new CcnAlumni;
						$alumni->updateAll(array('swt_users_id' => $model->id),'nim = :nim',array(':nim' => $model->nim));
					}
					
					// Yo, after save the member registration datas, deliver the activation mail to his/her email..
					// First, select mail template from ccn_email_template which name is 'email_aktivasi'
					$activationMail = CcnEmailTemplate::model()->find(array(
						'select'	=> 'subject, message',
						'condition' => 'name = :name',
						'params' => array(
							':name' => 'email_aktivasi',
						),
					));
					Yii::import('application.modules.finance.models.CcnOfficialBank');
					$bank = CcnOfficialBank::model()->find();
					$bankName = $bank->name.' '.$bank->branch;
					$noRek = $bank->account_no;
					$behalf = $bank->behalf;
					
					$pcrUrl				= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->getBaseUrl();
					$nowDate			= date('l, d F Y');
					$activationLink		= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->controller->createUrl('register/activation',array('key'=>$model->activation));
					$confirmationLink	= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('finance/confirm');
					$faq				= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('contact/pcr-carrer-center-politeknik-riau?=');
					$contactUs			= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('contact/pcr-carrer-center-politeknik-riau?=');
					$listBank			= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('finance/confirm/bank');
					/* $activationLink	= Yii::app()->createUrl('member/register/activation', array('key' => $model->activation));
					$serverName		= 'http://'.$_SERVER['SERVER_NAME'];
					$name			= $model->name;
					$htmlLink		= "<a href=\"$serverName$activationLink\">Link aktivasi</a>";
					$justLink		= $serverName.$activationLink;
					$baseUrl		= $serverName.Yii::app()->getBaseUrl();
					
					Yii::app()->session['activation_link']      = $htmlLink;
					Yii::app()->session['activation_link_bak']  = $justLink;
									
					$jobseekerLink	= "<a href=\"$serverName".Yii::app()->createUrl('site/page', array('view'=>'prosedur')) . "\">Klik link ini</a>";
					$paymentConfirmationLink = "<a href=\"$serverName/konfirmasi\">Klik di sini</a>";
					
					Yii::app()->session['payment_link']   = $paymentConfirmationLink;
					Yii::app()->session['procedure_link'] = $jobseekerLink; */
					
					// prepare some words would changed with variables above
					$search		= array(
						'{$pcr_url}',
						'{$now_date}',
						'{$email}',
						'{$password}',
						'{$activation_link}',
						'{$nominal}',
						'{$list_bank}', 
						'{$confirmation_link}',
						'{$faq}',
						'{$contact_us}',
						'{$bank_name}',
						'{$no_rekening}',
						'{$behalf}',
					);
					/* $search		= array('{$base_url}', '{$nama_tayang}', '{$email_user}', '{$nama_user}', '{$pwd}', '{$link_konf}', '{$link_cad}',
										'{$link_jobseeker}', '{$link_konfirmasi_pembayaran}', '{$nominal_pembayaran}'); */
					
					// prepare the datas to be wrote on the mail..
					$replace	= array(
						$pcrUrl, 
						$nowDate, 
						$model->email, 
						$password, 
						$activationLink, 
						$payAmount, 
						$listBank, 
						$confirmationLink, 
						$faq, 
						$contactUs,
						$bankName,
						$noRek,
						$behalf,
					);
					/* $replace	= array($baseUrl, $model->name, $model->email, $model->name, $password, $htmlLink, $justLink,
										$jobseekerLink, $paymentConfirmationLink, $payAmount); */
										
					// here we go, replace the mathced words in $search with all words in $replace.
					$msg		= str_ireplace($search, $replace, $activationMail->message);
					
					// Just for testing whether the email template is succesfully changed or not..
					//$filePath	= Yii::app()->basePath.'/../media/tes.html';
					//file_put_contents ($filePath, $msg);
					
					// Yo, you have to modified the statement below to send the mail...
					$subject = "User #{$model->id}: ".$activationMail->subject;
					Utility::sentEmail('noreply@career-center.pcr.ac.id', 'PCR Career Center', $model->email, $model->name, $subject, $msg);
					
					Yii::app()->user->setFlash('success', Yii::t('', 'CcnUsers success created.'));
					$this->redirect(array('success','id'=>$model->id,'gid'=>5));

				}else { //employer user
					// Yo, after save the member registration datas, deliver the activation mail to his/her email..
					// First, select mail template from ccn_email_template which name is 'email_aktivasi'
					$activationMail = CcnEmailTemplate::model()->find(array(
						'select'	=> 'subject, message',
						'condition' => 'name = :name',
						'params' => array(
							':name' => 'email_aktivasi_employer',
						),
					));					
					
					$pcrUrl				= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->getBaseUrl();
					$nowDate			= date('l, d F Y');
					$activationLink		= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->controller->createUrl('register/activation',array('key'=>$model->activation));
					$confirmationLink	= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('finance/confirm');
					$faq				= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('contact/pcr-carrer-center-politeknik-riau?=');
					$contactUs			= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('contact/pcr-carrer-center-politeknik-riau?=');
					$listBank			= 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('finance/confirm/bank');
				
					
					// prepare some words would changed with variables above
					$search		= array(
						'{$nama_tayang}',
						'{$email_user}',
						'{$nama_user}',
						'{$pwd}',
						'{$link_konf}',
						'{$link_cad}',
					);
					/* $search		= array('{$base_url}', '{$nama_tayang}', '{$email_user}', '{$nama_user}', '{$pwd}', '{$link_konf}', '{$link_cad}',
										'{$link_jobseeker}', '{$link_konfirmasi_pembayaran}', '{$nominal_pembayaran}'); */
					
					// prepare the datas to be wrote on the mail..
					$replace	= array(
						$model->name, 
						$model->email, 
						$model->username, 
						$password, 
						$activationLink, 
						$activationLink, 
					);
					/* $replace	= array($baseUrl, $model->name, $model->email, $model->name, $password, $htmlLink, $justLink,
										$jobseekerLink, $paymentConfirmationLink, $payAmount); */
										
					// here we go, replace the mathced words in $search with all words in $replace.
					$msg		= str_ireplace($search, $replace, $activationMail->message);
					
					// Just for testing whether the email template is succesfully changed or not..
					//$filePath	= Yii::app()->basePath.'/../media/tes.html';
					//file_put_contents ($filePath, $msg);
					
					// Yo, you have to modified the statement below to send the mail...
					$subject = "User #{$model->id}: ".$activationMail->subject;
					Utility::sentEmail('noreply@career-center.pcr.ac.id', 'PCR Career Center', $model->email, $model->name, $subject, $msg);
					
					$this->redirect(array('employerdata','id'=>$model->id));
				}
			}
		}

		if(isset($_GET['gid'])) {
			$render = $gid == 5 ? 'front_signup_jobseeker':'front_signup_employer';
		}else {
			$render = 'front_index';
		}

		$this->render($render,array(
			'model'=>$model,
		));
	}

	/**
	 * next page, redirect from employer register (index)
	 */
	public function actionEmployerData($id) {
		if(!isset($_GET['step'])) {
			$model = new CcnEmployerData;
		} else {
			$model = CcnEmployerData::model()->findByPk($id);
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CcnEmployerData']))
		{
			$model->attributes = $_POST['CcnEmployerData'];

			if(!isset($_GET['step'])) {
				$model->swt_users_id = $id;
				$model->scenario = 'step1';
				if($model->save()) {
					//Yii::app()->user->setFlash('success', Yii::t('', 'CcnUsers success created.'));
					$this->redirect(array('employerdata','id'=>$model->id,'step'=>2,'uid'=>$id));
				}

			} else {
				$model->scenario = 'step2';
				$model->swt_users_id = $_GET['uid'];
				$model->id = $id;
				if($model->save()) {
					//Yii::app()->user->setFlash('success', Yii::t('', 'CcnUsers success created.'));
					$this->redirect(array('success','id'=>$_GET['uid'],'gid'=>6));
					//$this->redirect(array('adminmanage'));
				}

			}
		}

		$this->render('front_employer_data',array(
			'model'=>$model,
		));
	}

	/**
	 * success page, redirect from jobseeker register (index)
	 */
	public function actionSuccess() {
		$this->layout = 'front_default';
		$this->render('front_success',array(
			'model'=>$this->loadModel($_GET['id']),
		));
	}

	/**
	 * success page, redirect from jobseeker register (index)
	 */
	public function actionNotifier() {
		$this->layout = 'front_default';
		$this->render('front_notifier');
	}

	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionWizard() 	{
		$this->layout = 'front_wizard';
		$this->render('front_wizard');
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionFinish() {
		$this->layout = 'front_wizard';
		$this->render('front_finish');
	}
	
	/**
	 * activation email, after register call from email link activation
	 */
	public function actionActivation($key)	{
		$this->layout = 'front_default';

		// First, we search in the database whether the activation key is exist or not...
		$model = CcnUsers::model()->find(array(
			'condition' => 'activation = :key',
			'params' => array(
				':key' => $key,
			)
		));
		$status = '';
		//if data exist, enter below statements..
		if (isset($model->activation)) {
			
			// Check, is account has been activated yet? If 0 (unactived), then set to be 1 (active)
			if ($model->actived == 0) {
                                //update activation, because jobseeker no payment, set status to 3 (aprroved)
                                $statusUser = $model->users_group_id == 6 ? 2 : 3;
				if ($model->updateAll(array('actived' => 1, 'status_user' => $statusUser), 'activation = :key',array(':key' => $key)) > 0) {
					$status = 'actived';
					if($model->users_group_id == 6)
						$data = Yii::t('', 'Akun Anda telah berhasil di aktivasi,<br/> Untuk masuk halaman employer silahkan, klik  <a href="'.Yii::app()->createUrl('site/login').'" >disini</a>');
					else {
						//$data = Yii::t('', 'Akun Anda telah berhasil di aktivasi,<br/>namun Anda masih belum bisa login sebelum melakukan pembayaran.<br/>Silahkan klik tombol konfirmasi pembayaran dibawah ini apabila Anda sudah melakukan pembayaran.');
                                                $data = Yii::t('', 'Akun Anda telah berhasil di aktivasi,<br/> Untuk masuk halaman jobseeker silahkan, klik  <a href="'.Yii::app()->createUrl('site/login').'" >disini</a>');
                                        }
					//Yii::app()->user->setFlash('success', Yii::t('', 'Akun Anda telah berhasil di aktivasi, namun Anda masih belum bisa login sebelum melakukan pembayaran. Silahkan klik tombol konfirmasi pembayaran dibawah ini apabila Anda sudah melakukan pembayaran.'));
					// echo 'Aktivasi berhasil';
				} else {
					$data = Yii::t('', 'Aktivasi gagal!.');
					//Yii::app()->user->setFlash('error', Yii::t('', 'Aktivasi gagal!.'));
					//echo 'Aktivasi gagal';
				}
			}else {
				$status = 'actived_before';
				if($model->users_group_id == 6)
					$data = Yii::t('', 'Maaf, akun Anda sudah teraktivasi sebelumnya.');
				else
					$data = Yii::t('', 'Maaf, akun Anda sudah teraktivasi sebelumnya.<br/> Untuk masuk halaman jobseeker silahkan, klik  <a href="'.Yii::app()->createUrl('site/login').'" >disini</a>');
				
				// If account has been activated yet, show the message below..
				//Yii::app()->user->setFlash('error', Yii::t('', 'Maaf, akun Anda sudah teraktivasi sebelumnya. Jika Anda sudah membayar, silahkan klik tombol konfirmasi pembayaran dibawah ini.'));
				//echo 'Akun sudah diaktivasi sebelumnya.';
			}
		}else {
			$status = 'error_code';
			$data = Yii::t('', 'Maaf, kode aktivasi Anda tidak cocok.');
			//Yii::app()->user->setFlash('error', Yii::t('', 'Maaf, kode aktivasi Anda tidak cocok.'));
			//echo 'Aktivasi gagal, kode aktivasi tidak cocok';
		}

		$this->render('front_activation', array(
			'status'=>$status,
			'data'=>$data,
			'model'=>$model,
		));
	}
	
	public function actionSelectCity() {
		$provinceId = $_POST['id'];
		// Just for testing getting member datas
		 $listData = CHtml::listData(CcnCity::model()->findAll(array(
			'select' => 'id, name', 
			'condition' => 'province_id = :id',
			'params' => array(':id' => ''.$provinceId.'')
		)),'id', 'name');
		
		$cityList = '<select name="CcnEmployerData[city_id]" id="CcnEmployerData_city_id">';
		$cityList .= '	<option value="0" selected="selected" disabled="disabled">Pilih Kota</option>';
		$no = 1;
		foreach ($listData as $id => $city) {
			$cityList .= '<option value="'.$id.'">'.$city.'</option>';
		}
		$cityList .= '</select>';
		echo $cityList;
	}
	
	public function actionLupaPassword() {
		$model = new ForgetPassForm;
		$criteria = new CDbCriteria;
		if(isset($_POST['ForgetPassForm'])) {
			$model->attributes = $_POST['ForgetPassForm'];
			if($model->validate()) {
				$criteria->condition = 'email = :email';
				$criteria->params = array(':email' => trim($model->email));

				$rows = $model->find($criteria);
				if(!$rows) {
					Yii::app()->user->setFlash('lupapassword', 'Email anda tidak ada didatabase kami.');

				}else {
					// Kirim email lupa password
					$email = Email::model()->find(array(
						'condition' => 'nama = :nama',
						'params' => array(
							':nama' => 'email_resetpass',
						),
					));

					$user = User::model()->find(array(
						'condition' => 'email = :email',
						'params' => array(
							':email' => trim($rows->email),
						),
					));

					$userOption = UserOption::model()->find(array(
						'condition' => 'id_user = :id_user',
						'params' => array(
							':id_user' => $rows->id_user,
						),
					));
					$webOption = WebOption::model()->findByPk(1);

					Yii::import('ext.phpmailer.JPhpMailer');
					$mail=new JPhpMailer;
					$mail->IsMail();
					$serverName = 'http://' . $_SERVER['SERVER_NAME'];
					$securityCode = md5(uniqid(mt_rand(), true));
					$date = date('Y-m-d');

					$userOption->confirm_code = $securityCode.'/'.$date;

					if($userOption->save()) {
					}else {
						$securityCode = $userOption->confirm_code;
					}

					$namaUser = $user->nama_user;
					$alamatReset = Yii::app()->createUrl('user/resetpass', array(
						'key' => $securityCode,
						'email' => $rows->email
					));

					$linkResetPassword = "<a href=\"$serverName$alamatReset\">$serverName$alamatReset</a>";
					$mail->SetFrom('noreply@ecc.ft.ugm.ac.id', 'ECC UGM');
					$mail->Subject = $email->subjek;
					$search = array('$nama_user', '$link_reset_password');
					$replacer = array($user->nama_user, $linkResetPassword);
					$body = str_ireplace($search, $replacer, $email->isi);

					$mail->MsgHTML($body);
					$mail->AddAddress($rows->email, $user->nama_tayang);

					if($mail->Send()) {
						Yii::app()->user->setFlash('sukses', 'Email telah terkirim.');

					}else {
						Yii::app()->user->setFlash('lupapassword', 'Email gagal terkirim.');
					}

					Yii::app()->user->setFlash('sukses', 'Email telah terkirim.');
				}
			}
		}
		$this->render('/lupa_password', array('model' => $model));
	}
	
	public function actionResetPass() {
		$model = new ResetPassForm;

		if(isset($_GET['key']) && isset($_GET['email'])) {

			$user = User::model()->find(array(
				'condition' => 'email = :email',
				'params' => array(
					':email' => trim($_GET['email']),
				),
			));

			$userOption = UserOption::model()->find(array(
				'condition' => 'id_user = :id ',
				'params' => array(
					':id' => $user->id_user,
				),
			));
			$error = 0;
			if($userOption){
				$confirmCode = explode('/', $userOption->confirm_code);
				if(count($confirmCode) > 1){
					$kodeKey = $confirmCode[0];
					$tglKode = $confirmCode[1];
								//cek selisih hari < 3 hari
					$selisihhariKode = DaftarLwgn::selisihHari($tglKode, date('Y-m-d'));
					if($selisihhariKode > 3 ){
						$userOption->confirm_code = '';
						$userOption->update();
						$error = 1;
						Yii::app()->user->setFlash('error', 'Maaf, link konfirmasi anda sudah "expired", silakan ulangi permintaan "Lupa password" dari awal');

					}

			//cek kode konfirmasi
					if($kodeKey != trim($_GET['key'])){
						$error = 1;
						Yii::app()->user->setFlash('error', 'Maaf, link konfirmasi anda tidak benar, silakan ulangi permintaan "Lupa password" dari awal');

					}
				}else{
					$error = 1;
					Yii::app()->user->setFlash('error', 'Maaf, link konfirmasi anda sudah "expired", silakan ulangi permintaan "Lupa password" dari awal');
				}
			}else{
				Yii::app()->user->setFlash('error', 'Maaf, link konfirmasi anda tidak benar');

			}

			//jika uesr ditemukan dan error tidak ada maka sukses
			if($user != null && $error == 0) {
				if(isset($_POST['ResetPassForm'])) {
					$model->attributes = $_POST['ResetPassForm'];
					if($model->validate()) {
						$newPass = $model->newPassword;
						$verifyPass = $model->verifyPassword;

						if($newPass == $verifyPass) {
							$model->newPassword = User::hashPassword($newPass);
							$model->verifyPassword = User::hashPassword($verifyPass);

							$user->pass = $model->newPassword;

							if($user->update()) {
								Yii::app()->user->setFlash('suksesReset', 'Password telah diubah.');
							}
						}else{
							Yii::app()->user->setFlash('error', 'Maaf, kedua password baru yang Anda isikan belum sama.');
						}

					}
				}

			}else {
				Yii::app()->user->setFlash('error', 'Maaf, email anda tidak ditemukan dalam database kami.');
			}



		}else{
			Yii::app()->user->setFlash('error', 'Maaf, link konfirmasi anda tidak benar, silakan cek kembali kode konfirmasi di email Anda.');
		}


		$this->render('/lupa_password/reset_password', array('model' => $model));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='swt-users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
