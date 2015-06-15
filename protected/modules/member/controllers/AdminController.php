<?php

class AdminController extends SBaseController /* Controller */
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
	 * @return array action filters
	 */
/* 	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	} */

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/* 	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'adminmanage','adminadd','adminedit','adminview','admindelete',
					'employerdata','employerdataedit',
					'pdf','selectcity','activate','cancelapproval','approve','printpdf','advancesearch', 'suggestuniversity',
					'AdvanceDownload','blockurl','unblockurl','block','unblock'),
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
	} */

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage()
	{
		
		$model =CcnUsers::model();
		
		$criteria = new CDbCriteria;
		if(isset($_GET['CcnUsers'])){
			$with = array();
			if(isset($_GET['gid']) && in_array($_GET['gid'], array(4,5))) {
				$with = array(
					'jobseeker_bio1' => array(
						'condition' => 'jobseeker_bio1.complete_name LIKE "%'.$_GET['CcnUsers']['name'].'%"',
					),
				);
			}elseif(isset($_GET['gid']) && in_array($_GET['gid'], array(6))) {
				$with = array(
					'employer_data1' => array(
						'condition' => 'employer_data1.name LIKE "%'.$_GET['CcnUsers']['name'].'%"',
					),
				);

			} 
			if($_GET['CcnUsers']['name'] != '')
				$criteria->with = $with;
			if($_GET['CcnUsers']['email'] != '')
				$criteria->condition = 't.email LIKE "%'.$_GET['CcnUsers']['email'].'%"';
			if($_GET['CcnUsers']['mobile_no'] != '')
				$criteria->compare('mobile_no', $_GET['CcnUsers']['mobile_no']);
			if($_GET['CcnUsers']['status_user'] != '')
				$criteria->compare('status_user', $_GET['CcnUsers']['status_user']);
			if($_GET['CcnUsers']['register_date'] != '')
				$criteria->compare('register_date', date('Y-m-d', strtotime($_GET['CcnUsers']['register_date'])),true);
			if($_GET['CcnUsers']['actived'] != '')
				$criteria->compare('actived', $_GET['CcnUsers']['actived']);
			if($_GET['CcnUsers']['block'] != '')
				$criteria->compare('block', $_GET['CcnUsers']['block']);
		}
		
		$criteria->order = 'register_date DESC';
		if( $_GET['gid'] == '0' ){
			exit();
		} else {
			$criteria->compare('users_group_id', $_GET['gid']);
		}
		
		// $m = CcnUsers::model()->findAll($criteria);
		// echo count($m);
		$dataProvider = new CActiveDataProvider(get_class($model),array('criteria'=>$criteria));
	
		
		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn();

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial('admin_manage',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'columns' => $columns,
			), true, false);

			echo CJSON::encode($message);

		} else {

			if ($_GET['gid'] == 4) {
				$title = 'Jobseeker Alumni';
			} else if($_GET['gid'] == 5) {
				$title = 'Jobseeker';
			} else if($_GET['gid'] == 6) {
				$title = 'Employer';
			}

			$this->pageTitle = 'Kelola Member '.$title;
			$this->render('admin_manage',array(
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
		if ($_GET['gid'] == 4)
			$model = new CcnUsers('addJobseekerAlumni');
		else if ($_GET['gid'] == 5)
			$model = new CcnUsers('addJobseeker');
		else if ($_GET['gid'] == 6)
			$model = new CcnUsers('addEmployer');
		else
			exit();
		

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnUsers']))
		{
			if ($_GET['gid'] == 4) {
				$title = 'jobseeker alumni';
			} else if($_GET['gid'] == 5) {
				$title = 'jobseeker';
			} else if($_GET['gid'] == 6) {
				$title = 'employer';
			}
			
			$model->attributes = $_POST['CcnUsers'];
			
			if(isset($_GET['type']) && $_GET['type'] == 'action') {
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$title.' berhasil ditambahkan.'));
					if($model->users_group_id != 6) {
						$this->redirect(array('adminmanage','gid'=>$model->users_group_id));
					} else {
						$this->redirect(array('employerdata','id'=>$model->id,'gid'=>$model->users_group_id));
					}
				}
			} else {
				$jsonError = CActiveForm::validate($model);
				if(strlen($jsonError) > 2) {
					echo $jsonError;
				} else {
					if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
						if($model->save()) {
							if($model->users_group_id != 6) {
								echo CJSON::encode(array(
									'type' => 1,
									'id' => 'partial-ccn-users',
									'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Member '.$title.' berhasil ditambahkan.').'</strong></div>',
								));
							} else {
								echo CJSON::encode(array(
									'redirect' => Yii::app()->controller->createUrl('employerdata',array('id'=>$model->id,'gid'=>$model->users_group_id)),
								));
							}
						} else {
							print_r($model->getErrors());
						}
					}
				}
				Yii::app()->end();
			}

		}

		if(isset($_GET['type']) && $_GET['type'] == 'action') {
			$this->render('admin_add',array(
				'model'=>$model,
			));
		} else {
			$message['data'] = $this->renderPartial('admin_add',array(
				'model'=>$model,
			), true, false);

			echo CJSON::encode($message);
		}
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

		if(isset($_POST['CcnUsers']))
		{
			if ($_GET['gid'] == 4) {
				$title = 'jobseeker alumni';
			} else if($_GET['gid'] == 5) {
				$title = 'jobseeker';
			} else if($_GET['gid'] == 6) {
				$title = 'employer';
			} else {
				exit();
			}
			
			$model->attributes=$_POST['CcnUsers'];

			if(isset($_GET['type']) && $_GET['type'] == 'action') {
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$title.' berhasil diperbarui.'));
					$this->redirect(array('adminmanage','gid'=>$model->users_group_id));
				}

			} else {
				$jsonError = CActiveForm::validate($model);
				if(strlen($jsonError) > 2) {
					echo $jsonError;
				} else {
					if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
						if($model->save()) {
							if($model->users_group_id != 6) {
								echo CJSON::encode(array(
									'type' => 1,
									'id' => 'partial-ccn-users',
									'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Member '.$title.' berhasil diperbarui.').'</strong></div>',
								));
							} else {
								echo CJSON::encode(array(
									'redirect' => Yii::app()->controller->createUrl('employerdataedit',array('id'=>$model->id,'gid'=>$model->users_group_id)),
								));
							}
						} else {
							print_r($model->getErrors());
						}
					}
				}
				Yii::app()->end();
			}

		}

		if(isset($_GET['type']) && $_GET['type'] == 'action') {
			$this->render('admin_edit',array(
				'model'=>$model,
			));
		} else {
			$message['data'] = $this->renderPartial('admin_edit',array(
				'model'=>$model,
			), true, false);

			echo CJSON::encode($message);
		}


	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAdminView($id)
	{
		if ($_GET['gid'] == 4 || $_GET['gid'] == 5) {
			// get data list biodata
			$biodata=CcnJobseekerBio::model()->find(array(
					'condition'=> 'swt_users_id = :id',
					'params' => array(':id'=> $id), 
			));
			
			//get data education
			$criteria=new CDbCriteria;
			$criteria->compare('swt_users_id', $id);
			$education = new CActiveDataProvider('CcnJobseekerEdu', array(
				'criteria'=>$criteria,
			));
			
			//get data experience
			$criteria=new CDbCriteria;
			$criteria->compare('swt_users_id', $id);
			$experience = new CActiveDataProvider('CcnJobseekerExp', array(
				'criteria'=>$criteria,
			));

			//get data organization
			$criteria=new CDbCriteria;
			$criteria->compare('swt_users_id', $id);
			$organization = new CActiveDataProvider('CcnJobseekerOrg', array(
				'criteria'=>$criteria,
			));
			
			//get data skill
			$skill=CcnJobseekerSkill::model()->find(array(
					'condition'=> 'swt_users_id = :id',
					'params' => array(':id'=>$id),		 
			));
			
			//get data training
			$criteria=new CDbCriteria;
			$criteria->compare('swt_users_id', $id);
			$training = new CActiveDataProvider('CcnJobseekerTraining', array(
				'criteria'=>$criteria,
			));
			
			//get data toefl
			$toefl=CcnJobseekerToefl::model()->find(array(
					'condition'=> 'swt_users_id = :id',
					'params' => array(':id'=>$id), 
			));
			
			//get data positif
			$positif=CcnJobseekerPositive::model()->find(array(
					'condition'=> 'swt_users_id = :id',
					'params' => array(':id'=>$id), 
			));

			
			//get data reference
			$reference=CcnJobseekerReference::model()->find(array(
					'condition'=> 'swt_users_id = :id',
					'params' => array(':id'=>$id), 
			));

			//get data award
			$criteria=new CDbCriteria;
			$criteria->compare('swt_users_id', $id);
			$award = new CActiveDataProvider('CcnJobseekerAward', array(
				'criteria'=>$criteria,
			));
			
			//get data language
			$criteria=new CDbCriteria;
			$criteria->compare('swt_users_id', $id);
			$language = new CActiveDataProvider('CcnJobseekerLang', array(
				'criteria'=>$criteria,
			));
			
			$this->render('admin_view_jobseeker',array(
				'model'=>$this->loadModel($id),
				'biodata' => $biodata,
				'education' => $education,
				'organization' => $organization,
				'skill' => $skill,
				'training' => $training,
				'toefl' => $toefl,
				'positif' => $positif,
				'experience' => $experience,
				'reference' => $reference,
				'award' => $award,
				'language' => $language,
			));
		} else {
			$this->pageTitle = 'Lihat Data Employer';
			$check = CcnEmployerData::model()->find('swt_users_id = '.$id);
			
			$this->render('admin_view_employer', array('model' => $check));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAdminDelete($id)
	{
		if ($_GET['group'] == 4) {
			$title = 'Jobseeker Alumni';
		} else if($_GET['group'] == 5) {
			$title = 'Jobseeker';
		} else if($_GET['group'] == 6) {
			$title = 'Employer';
		} else {
			exit();
		}
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				$this->loadModel($id)->delete();

				echo CJSON::encode(array(
					'type' => 1,
					'id' => 'partial-ccn-users',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Member '.$title.' berhasil dihapus.').'</strong></div>',
				));
			}
		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id,'group'=>$_GET['group'])).'" method="post">';
			$data .= '<div class="dialog-header">Hapus Member '.$title.'</div>';
			$data .= '<div class="dialog-content">';
			$data .= Yii::t('', 'Apakah anda yakin ingin menghapus item ini?');
			$data .= '</div>';
			$data .= '<div class="dialog-submit">';
			$data .= '<input type="submit" value="'.Yii::t('', 'Hapus').'" />';
			$data .= '<input id="closed" type="button" value="'.Yii::t('', 'Keluar').'" />';
			$data .= '</div>';
			$data .= '</form>';

			$result['data'] = $data;
			echo CJSON::encode($result);
		}
	}
	
	public function actionEmployerData($id)
	{
		if(!isset($_GET['step'])) {
			$model = new CcnEmployerData('step1');
		} else {
			$model=CcnEmployerData::model()->findByPk($id);
			$model->scenario = 'step2';
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CcnEmployerData']))
		{
			$model->attributes = $_POST['CcnEmployerData'];

			if(!isset($_GET['step'])) {
				$model->swt_users_id = $id;
				$model->scenario = 'step1';
				if (!isset($model->country_code) || $model->country_code != 'id') {
					$model->province_id = 0;
					$model->city_id = 0;
				}
				
					if(CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]') != null){
						//$fileObj	= CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
						Yii::import('ext.phpThumb.PhpThumbFactory');
						
						//set image path
						$imagePath = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/large/';
						$imagePathMedium = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/medium/';
						$imagePathSmall = YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/small/';
						$namaFile  = CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
						
						//get type file and file name
						$type      = $namaFile->getExtensionName();
						$file = time().$namaFile->getName();
						
						if($dataEmployer != null){
							//delete old image
							@unlink($imagePath.'/large_'.$dataEmployer->company_logo);
							@unlink($imagePathMedium.'/medium_'.$dataEmployer->company_logo);
							@unlink($imagePathSmall.'/small_'.$dataEmployer->company_logo);
						}
					
						$options = array('jpegQuality' => 90);
						
						$saveBanner = $namaFile->saveAs($imagePath.'/'.$file);
						$saveBannerMedium = $namaFile->saveAs($imagePathMedium.'/'.$file);
						$saveBannerSmall = $namaFile->saveAs($imagePathSmall.'/'.$file);
						@chmod($imagePath.'/'.$file, 0777);
						@chmod($imagePathMedium.'/'.$file, 0777);
						@chmod($imagePathSmall.'/'.$file, 0777);
						
						//resize image
						$thumb = PhpThumbFactory::create($imagePath.'/'.$file, $options);
						$thumb->adaptiveResize(120, 120);
						$thumb->save($imagePath.'/large_'.$file);
						$thumb->adaptiveResize(100, 100);
						$thumb->save($imagePathMedium.'/medium_'.$file);
						$thumb->adaptiveResize(80, 80);
						$thumb->save($imagePathSmall.'/small_'.$file);
						
						//delete original image
						@unlink($imagePath.'/'.$file);
						
						$model->company_logo = $file;
					} else
						$model->company_logo = 'employer_default.png';
					
					$model->id = $id;
			
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('', 'Sukses memasukkan data employer'));
					$this->redirect(array('employerdata','id'=>$model->id,'step'=>2,'uid'=>$id));
				}

			} else {
				$model->scenario		= 'step2';
				$model->swt_users_id	= $_GET['uid'];
				/*
				Old code, upload logo on step2
				
				$fileObj	= CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
				if ($fileObj->extensionName == '') {
					$model->addError($attribute, Yii::t('', 'File logo perusahaan harus diisi.'));
				} else {
					$fileName	= md5(time().'_'.$id).'.'.$fileObj->extensionName;
					$filePath	= Yii::app()->basePath.'/../images/member_upload/employer/logo/'.$fileName;
					
					$fileObj->saveAs($filePath);
					
					if(file_exists($filePath))
						@chmod($filePath, 0777);

					$model->company_logo = $fileName;
					$model->id = $id; */
					if($model->save()) {
						Yii::app()->user->setFlash('success', Yii::t('', 'Data employer berhasil dilengkapi.'));
						$this->redirect(array('adminview','id'=>$_GET['uid'],'gid'=>$model->users->users_group_id));
						//$this->redirect(array('adminmanage'));
					}
				//}

			}
			
		}
		
		$this->render('admin_employer_data',array(
			'model'=>$model,
		));
	}

	public function actionEmployerDataEdit($id)
	{
		if(!isset($_GET['step'])) {
			$model = CcnEmployerData::model()->find('swt_users_id = '.$id);
			if ($model != null)
				$model->scenario = 'step1';
			else
				$model = new CcnEmployerData('step1');
		} else {
			$model = CcnEmployerData::model()->findByPk($id);
			$model->scenario = 'step2';
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CcnEmployerData']))
		{
			$model->attributes = $_POST['CcnEmployerData'];

			if(!isset($_GET['step'])) {
				$model->swt_users_id = $id;
				$model->scenario = 'step1';
				if (!isset($model->country_code) || $model->country_code != 'id') {
					$model->province_id = 0;
					$model->city_id = 0;
				}
				
				/* $fileObj	= CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
				if ($fileObj->extensionName == '') {
					$model->company_logo = 'employer_default.png';
				} else {
					$fileName	= md5(time().'_'.$id).'.'.$fileObj->extensionName;
					$filePath	= Yii::app()->basePath.'/../images/member_upload/employer/logo/'.$fileName;
					
					$fileObj->saveAs($filePath);
					
					if(file_exists($filePath))
						@chmod($filePath, 0777);

					$model->company_logo = $fileName;
					$model->id = $id;
				} */
				if(CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]') != null){
					//$fileObj	= CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
					Yii::import('ext.phpThumb.PhpThumbFactory');
						
					//set image path
					$imagePath			= YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/large/';
					$imagePathMedium	= YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/medium/';
					$imagePathSmall		= YiiBase::getPathOfAlias('webroot').'/images/member_upload/employer/small/';
					$namaFile			= CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
						
					//get type file and file name
					$type	= $namaFile->getExtensionName();
					$file	= time().$namaFile->getName();
						
					if($dataEmployer != null){
						//delete old image
						@unlink($imagePath.'/large_'.$dataEmployer->company_logo);
						@unlink($imagePathMedium.'/medium_'.$dataEmployer->company_logo);
						@unlink($imagePathSmall.'/small_'.$dataEmployer->company_logo);
					}
					
					$options = array('jpegQuality' => 90);
					
					$saveBanner			= $namaFile->saveAs($imagePath.'/'.$file);
					$saveBannerMedium	= $namaFile->saveAs($imagePathMedium.'/'.$file);
					$saveBannerSmall	= $namaFile->saveAs($imagePathSmall.'/'.$file);
					@chmod($imagePath.'/'.$file, 0777);
					@chmod($imagePathMedium.'/'.$file, 0777);
					@chmod($imagePathSmall.'/'.$file, 0777);
						
					//resize image
					$thumb = PhpThumbFactory::create($imagePath.'/'.$file, $options);
					$thumb->adaptiveResize(120, 120);
					$thumb->save($imagePath.'/large_'.$file);
					$thumb->adaptiveResize(100, 100);
					$thumb->save($imagePathMedium.'/medium_'.$file);
					$thumb->adaptiveResize(80, 80);
					$thumb->save($imagePathSmall.'/small_'.$file);
						
					//delete original image
					@unlink($imagePath.'/'.$file);
						
					$model->company_logo = $file;
				}
				
				$model->id = $id;
					
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('', 'Sukses memasukkan data employer'));
					if (isset($_POST['yt0']))
						$this->redirect(array('adminmanage', 'gid'=>$model->users->users_group_id));
					else
						$this->redirect(array('employerdataedit','id'=>$model->id,'step'=>2,'uid'=>$id));
				}

			} else {
				$model->scenario		= 'step2';
				$model->swt_users_id	= $_GET['uid'];
				/*
				Old code, upload logo on step2
				
				$fileObj	= CUploadedFile::getInstanceByName('CcnEmployerData[company_logo_file]');
				if ($fileObj->extensionName == '') {
					$model->addError($attribute, Yii::t('', 'File logo perusahaan harus diisi.'));
				} else {
					$fileName	= md5(time().'_'.$id).'.'.$fileObj->extensionName;
					$filePath	= Yii::app()->basePath.'/../images/member_upload/employer/logo/'.$fileName;
					
					$fileObj->saveAs($filePath);
					
					if(file_exists($filePath))
						@chmod($filePath, 0777);

					$model->company_logo = $fileName;
					$model->id = $id; */
					if($model->save()) {
						Yii::app()->user->setFlash('success', Yii::t('', 'Sukses memasukkan data employer'));
						$this->redirect(array('adminmanage', 'gid'=>$model->users->users_group_id));
						//$this->redirect(array('adminview','id'=>$_GET['uid']));
						//$this->redirect(array('adminmanage'));
					}
				//}

			}
		}
		
		$this->render('admin_employer_data',array(
			'model'=>$model,
		));
	}

	/**
	 * 
	 * action Jobseeker advancesearch
	 */
	public function actionAdvanceSearch(){
		Yii::import('application.modules.finance.models.CcnConfirm');
		$model = CcnUsers::model();
		$modelAdvanceSearch = new CcnAdvanceSearch;
		
		$criteria = new CDbCriteria;
		
		$criteria->order = 'register_date DESC';
		
		
		$criteria->addInCondition('users_group_id',array(4,5));
		$criteria->with = array('jobseeker_bio1', 'jobseeker_edu1', 'ccnConfirms1');
		
		//set condition default for download excel
		$condition = 'users_group_id IN (4,5)';
		if(isset($_GET['CcnAdvanceSearch'])){
			
			$typeMember = $_GET['CcnAdvanceSearch']['typeMember'];
			$fromJoinDate = $_GET['CcnAdvanceSearch']['fromJoinDate'];
			$untilJoinDate = $_GET['CcnAdvanceSearch']['untilJoinDate'];
			$birthPlace = $_GET['CcnAdvanceSearch']['birthPlace'];
			$originAddress = $_GET['CcnAdvanceSearch']['originAddress'];
			$address = $_GET['CcnAdvanceSearch']['address'];
			$sex = $_GET['CcnAdvanceSearch']['sex'];
			$status = $_GET['CcnAdvanceSearch']['status'];
			$degree = $_GET['CcnAdvanceSearch']['degree'];
			$university = $_GET['CcnAdvanceSearch']['university'];
			$outFromDate = $_GET['CcnAdvanceSearch']['fromOutDate'];
			$untilOutDate = $_GET['CcnAdvanceSearch']['untilOutDate'];
			$ipkStart = $_GET['CcnAdvanceSearch']['ipkStart'];
			$ipkEnd = $_GET['CcnAdvanceSearch']['ipkEnd'];
			$enterYear = $_GET['CcnAdvanceSearch']['enterYear'];
			$exitYear = $_GET['CcnAdvanceSearch']['exitYear'];
			$startApproval = $_GET['CcnAdvanceSearch']['startApproval'];
			$endApproval = $_GET['CcnAdvanceSearch']['endApproval'];
			$major = $_GET['CcnAdvanceSearch']['major'];
			$statusUser = $_GET['CcnAdvanceSearch']['statusUser'];
			$arrayCondition = $modelAdvanceSearch->searchAdvance($typeMember, $fromJoinDate, $untilJoinDate, $birthPlace, 
			$originAddress, $address, $sex, $status, $degree, $university, $outFromDate, $untilOutDate, $ipkStart, $ipkEnd
			, $enterYear, $exitYear, $startApproval, $endApproval, $major, $statusUser);
			$condition = implode(' AND ', $arrayCondition);
			
			$criteria->condition = $condition;
		}
		
		//save condition to session
		Yii::app()->session['advance-search'] = $condition;
		
		$dataProvider = new CActiveDataProvider(get_class($model),array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>10)));
		
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
			$message['data'] = $this->renderPartial('jobseeker_advance_search',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'columns' => $columns,
				'modelAdvanceSearch'=>$modelAdvanceSearch,
			), true, false);

			echo CJSON::encode($message);

		} else {
			$this->render('admin_advance_search',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'columns' => $columns,
				'modelAdvanceSearch'=>$modelAdvanceSearch,
			));
		}
	}


	// Print CV Online (Template 001).
	public function actionPrintpdf($id) {
		$id= $_GET['id'];
		Yii::import('ext.html2pdf.HTML2PDF');
		Yii::import('ext.html2pdf._mypdf.MyPDF');	// classe mypdf
		Yii::import('ext.html2pdf.parsingHTML');	// classe de parsing HTML
		Yii::import('ext.html2pdf.styleHTML');		// classe de gestion des styles

		$session = new CHttpSession;
		if(!$session->isStarted) {
			$session->open();
		}
		if(isset($_POST['PrintCV'])) {
			$data = $_POST['PrintCV'];
			$ses  = array();
			foreach($data as $key => $val) {
				$ses[$key] = $val;
			}
		}
		
		$session['PrintCV'] = $ses;

		$pilihan = $session['PrintCV'];
		$model = array();
		$pilihan['dataDiri'] = 1;
		$pilihan['pendidikanFormal'] = 1;
		$pilihan['pendidikanNonFormal'] = 1;
		$pilihan['organisasi'] = 1;
		$pilihan['bahasaAsing'] = 1;
		$pilihan['pengalamanKerja'] = 1;
		$pilihan['kelebihanDiri'] = 1;
		$pilihan['rekomendasi'] = 1;
		$pilihan['toefl'] = 1;

		if($pilihan['dataDiri']==1) {
			$model['dataDiri'] = CcnJobseekerBio::model()->findByAttributes(array('swt_users_id' => $id));
		}		
		
		if($pilihan['pendidikanFormal']==1) {
			$model['pendidikanFormal'] = CcnJobseekerEdu::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}
		
		if($pilihan['pendidikanNonFormal']==1) {
			$model['pendidikanNonFormal'] = CcnJobseekerTraining::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['organisasi']==1) {
			$model['organisasi'] = CcnJobseekerOrg::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['bahasaAsing']==1) {
			$model['bahasaAsing'] = CcnJobseekerLang::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['pengalamanKerja']==1) {
			$model['pengalamanKerja'] = CcnJobseekerExp::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['kelebihanDiri']==1) {
			$model['kelebihanDiri'] = CcnJobseekerPositive::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		if($pilihan['rekomendasi'] == 1) {
			$model['rekomendasi'] = CcnJobseekerReference::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}
		
		if($pilihan['toefl'] == 1) {
			$model['toefl'] = CcnJobseekerToefl::model()->findAll(array(
				'condition' => 'swt_users_id = :id',
				'params' => array(':id' => $id)));
		}

		// Seleksi pilihan template.
		$template = 'print_cv__001';
		$id = $_POST['template'];
		settype($id, 'integer');
		switch($id) {
			case 2:
				$template = 'print_cv__002';
				break;
			case 3:
				$template = 'print_cv__003';
				break;
		}

		$bahasaCV = null;
		if($_POST['bahasa']=='en') {
			$bahasaCV = 'en';
		}
		
		ob_start();
 		include(Yii::getPathOfAlias('webroot').'/media/cv_template/'.$template.'.php');
		$content = ob_get_clean();
		try
		{
			// initialisation de HTML2PDF
			$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(0, 0, 0, 0));

			// affichage de la page en entier
			$html2pdf->pdf->SetDisplayMode('fullpage');

			// conversion
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

			// envoie du PDF
			$html2pdf->Output($template.'.pdf');
		}
		catch(HTML2PDF_exception $e) { echo $e; }
	}


	public function actionSelectCity()
	{
		$provinceId = $_POST['id'];
		$model=$_POST['model_name'];
		// Just for testing getting member datas
		 $listData = CHtml::listData(CcnCity::model()->findAll(array(
			'select' => 'id, name', 
			'condition' => 'province_id = :id',
			'params' => array(':id' => ''.$provinceId.'')
		)),'id', 'name');
		
		
		$cityList .= '	<option value="0" selected="selected" disabled="disabled">Pilih Kota</option>';
		$no = 1;
		foreach ($listData as $id => $city) {
			$cityList .= '<option value="'.$id.'">'.$city.'</option>';
		}
		echo $cityList;
	} 
        

	
	public static function activateUrl($gid, $id) 
	{
		return Yii::app()->createUrl('member/admin/activate/', array('gid' => $gid, 'id' => $id));
	}
	
	public static function approveUrl($gid, $id) 
	{
		return Yii::app()->createUrl('member/admin/approve/', array('gid' => $gid, 'id' => $id));
	}
	
	public static function cancelApprovalUrl($gid, $id) 
	{
		return Yii::app()->createUrl('member/admin/cancelapproval/', array('gid' => $gid, 'id' => $id));
	}
	
	public static function blockUrl($gid, $id) 
	{
		return Yii::app()->createUrl('member/admin/block/', array('gid' => $gid, 'id' => $id));
	}
	
	public static function unBlockUrl($gid, $id) 
	{
		return Yii::app()->createUrl('member/admin/unblock/', array('gid' => $gid, 'id' => $id));
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
			file_put_contents ($filePath, $msg);
					
			// Yo, you have to modified the statement below to send the mail...
			//Utility::sentEmail($webOption->email_admin, 'ECC UGM', $user->email, $user->nama_tayang, $emailAktifasi->subjek, $msg);
			Yii::app()->user->setFlash('success', Yii::t('', 'Status keanggotaan '.$model->name.' ('.$model->email.') berhasil disetujui.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
			
			/* Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diaktifkan.'));
			$this->redirect(array('adminmanage','gid'=>$gid)); */
		}
	}
	
	public function actionCancelApproval($gid, $id)
	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('block' => 0)) > 0){
			Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diblok.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
		}
	}
	
	public function actionBlock($gid, $id)
	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('block' => 1)) > 0){
			Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diblok.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
		}
	}
	
	public function actionUnBlock($gid, $id)
	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('block' => 0)) > 0){
			Yii::app()->user->setFlash('success', Yii::t('', 'Member '.$model->name.' ('.$model->email.') berhasil diaktifkan kembali.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
		}
	}
	
	public function actionApprove($gid, $id) 
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
							
			$nama_user = $model->name;
			$link_login = Yii::app()->createUrl('');
			
			// prepare some words would changed with variables above
			$search		= array('$nama_user', '$link_login');
					
			// prepare the datas to be wrote on the mail..
			$replace	= array($nama_user, $link_login);
								
			// here we go, replace the mathced words in $search with all words in $replace.
			$msg		= str_ireplace($search, $replace, $activationMail->message);
					
			// Just for testing whether the email template is succesfully changed or not..
			$filePath	= Yii::app()->basePath.'/../media/employerapproval.html';
			file_put_contents ($filePath, $msg);
					
			// Yo, you have to modified the statement below to send the mail...
			//Utility::sentEmail($webOption->email_admin, 'ECC UGM', $user->email, $user->nama_tayang, $emailAktifasi->subjek, $msg);
			Yii::app()->user->setFlash('success', Yii::t('', 'Status keanggotaan '.$model->name.' ('.$model->email.') berhasil disetujui.'));
			$this->redirect(array('adminmanage','gid'=>$gid));
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
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ccn-users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSuggestUniversity($limit=20){
		Yii::import('modules.college.models.CcnUnivName');
		if(isset($_GET['term'])) {
			$criteria = new CDbCriteria;
			$criteria->condition = 'name LIKE :cari';
			$criteria->select	= "name , id";
			$criteria->limit = $limit;
			$criteria->order = "id ASC";
			$criteria->params = array(':cari' => '%' . strtolower($_GET['term']) . '%');
			$dataList = CcnUnivName::model()->findAll($criteria);

			if($dataList) {
				foreach($dataList as $items) {
					$res[] = array('id' => $items->id, 'value' => $items->name);
				}
			}
		}
		echo CJSON::encode($res);
		Yii::app()->end();
	}
	
	public function actionAdvanceDownload(){
		$advanceCondition = Yii::app()->session['advance-search'];

		$this->layout=false;
		$data = array();
		$i = 1;
		$criteria=new CDbCriteria;
		$criteria->with = array('jobseeker_bio1', 'jobseeker_edu1');
		$criteria->condition = $advanceCondition;
		$model =  CcnUsers::model()->findAll($criteria);	
		if($model !== null) {
			$data[] = array (
						'No', 
						'Nama Lengkap',
						'Jenis Kelamin', 
						'Tgl Lahir' ,
						'Alamat',
						'Kota',	
						'Propinsi',	
						'No. HP',
						'Email',	
						'TOEFL',	
						'IELTS',	
						'Nama Universitas',	
						'Jurusan',	
						'Sub major',	
						'Thn Masuk',
						'Thn Lulus',	
						'Jenjang',
						'IPK',	
						'Judul Skripsi',
						'Perusahaan tempat bekerja ',	
						'Jabatan',	
						'Waktu Masuk',	
						'Waktu Keluar',	
						'Masih Kerja',		

					);
			foreach($model as  $row) {
				$completeName = $row->jobseeker_bio1->complete_name!=''?$row->jobseeker_bio1->complete_name:'-';
				$sex = $row->jobseeker_bio1->sex!=''?$row->jobseeker_bio1->sex:'-';
				$birthDate = $row->jobseeker_bio1->birth_date!=''?$row->jobseeker_bio1->birth_date:'-';
				$address = $row->jobseeker_bio1->address!=''?$row->jobseeker_bio1->address:'-';
				$city = $row->jobseeker_bio1->city->name!=''?$row->jobseeker_bio1->city->name:'-';
				$province = $row->jobseeker_bio1->province->name!=''?$row->jobseeker_bio1->province->name:'-';
				$mobilePhone = $row->jobseeker_bio1->mobile_phone!=''?$row->jobseeker_bio1->mobile_phone:'-';
				$email = $row->email!=''?$row->email :'-';
				$toefl = $row->jobseeker_toefl->toefl_score!=''?$row->jobseeker_toefl->toefl_score:'-';
				$ielts = $row->jobseeker_toefl->ielts_score!=''?$row->jobseeker_toefl->ielts_score:'-';
				$university = $row->jobseeker_edu1->university->name!=''?$row->jobseeker_edu1->university->name:'-';
				$major = $row->jobseeker_edu1->major->name!=''?$row->jobseeker_edu1->major->name:'-';
				$subMajor = $row->jobseeker_edu1->submajor!=''?$row->jobseeker_edu1->submajor:'-';
				$roleYear = $row->jobseeker_edu1->role_year!=''?$row->jobseeker_edu1->role_year:'-';
				$finishYear = $row->jobseeker_edu1->finish_year!=''?$row->jobseeker_edu1->finish_year:'-';
				$degree = $row->jobseeker_edu1->degree!=''?$row->jobseeker_edu1->degree:'-';
				$ipk = $row->jobseeker_edu1->ipk!=''?$row->jobseeker_edu1->ipk:'-';
				$skripsiTitle = $row->jobseeker_edu1->thesis_title!=''?$row->jobseeker_edu1->thesis_title:'-';
				$company =$row->jobseeker_exp1->company_name!=''?$row->jobseeker_exp1->company_name:'-'; 
				$position=$row->jobseeker_exp1->position!=''?$row->jobseeker_exp1->position:'-'; 
				$date_in=$row->jobseeker_exp1->role_date!=''?$row->jobseeker_exp1->role_date:'-';
				$date_out=$row->jobseeker_exp1->exit_date!=''?$row->jobseeker_exp1->exit_date:'-';
				$stillwork=$row->jobseeker_exp1->still_work!=''?$row->jobseeker_exp1->still_work:'-'; 
				
				$data[] = array (
						$i++, 
						$completeName, 
						$sex, 
						$birthDate, 
						$address, 
						$city, 
						$province, 
						$mobilePhone, 
						$email, 
						$toefl, 
						$ielts, 
						$university, 
						$major, 
						$subMajor, 
						$roleYear, 
						$finishYear, 
						$degree, 
						$ipk, 
						$skripsiTitle,
						$company,
						$position,
						$date_in,
						$date_out,
						$stillwork,
						
						 
											
					);
			}
		}
		
		Yii::import('application.extensions.phpexcel.JPhpExcel');
		$xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
		$xls->addArray($data);
		$xls->generateXML('Download Advance Search');
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionJobseekerBiodata() {
		$model=new CcnJobseekerBio;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerBio'])) {
			$model->attributes=$_POST['CcnJobseekerBio'];
			
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Biodata Jobseeker berhasil dilengkapi.'));
				$this->redirect(array('adminmanage','gid'=>$_GET['gid']));
			}
			
		}

		$this->pageTitle = Yii::t('titleCcnJobseekerBio', 'Tambah Biodata Jobseeker');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_jobseeker_biodata',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionJobseekerBiodataEdit($id) {
		//$model=$this->loadModel($id);
		$model = CcnJobseekerBio::model()->find('swt_users_id = '.$id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerBio'])) {
			$model->attributes=$_POST['CcnJobseekerBio'];
								
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Biodata Jobseeker berhasil diperbarui.'));
				
				$this->redirect(array('adminmanage','gid'=>$_GET['gid']));
			}
		}

		$this->pageTitle = Yii::t('titleCcnJobseekerBio', 'Ubah Biodata Jobseeker ');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_jobseeker_biodata',array(
			'model'=>$model,
		));
	}
	
	
}
