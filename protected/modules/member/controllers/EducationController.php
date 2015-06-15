<?php

class EducationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	//public $layout='admin';
	public $defaultAction = 'index';

	/**
	 * Initialize
	 */
	public function init() {
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		//$this->layout = $arrThemes['layout'];
		$this->layout = 'front_jobseeker_cv';
	}	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','add','manage','edit','delete','wizard','ajaxwizard', 'selectcountry'),
				'users'=>array('@'),
				'expression'=>'$user->id==4 || $user->id==5'
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('swt_users_id', Yii::app()->user->id_user);
		$dataProvider = new CActiveDataProvider('CcnJobseekerEdu', array(
			'criteria'=>$criteria,
		));

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial('front_index',array(
				'dataProvider' => $dataProvider,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render('front_index',array(
				'dataProvider' => $dataProvider,
			));
		}
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd()
	{
		$model=new CcnJobseekerEdu;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerEdu']))
		{	
			$model->attributes=$_POST['CcnJobseekerEdu'];
			$model->statistic_edu_signal = true;
			if($_POST['CcnJobseekerEdu']['other_collage'] == 1){
				$university = new CcnUnivName;
				$university->name = $_POST['CcnJobseekerEdu']['suggestCollege'];
				$university->approved = 1;
				if($university->save())
					$model->univ_name_id = $university->id;
			}
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						/* update for last education*/
						$lastEdu = CcnJobseekerEdu::model()->find(array(
							'condition'=> 'swt_users_id = :id',
							'params'=>array(':id'=>$model->swt_users_id),
							'order'=>'role_year DESC',
						));
						$education = CcnJobseekerEdu::model()->findAll(array(
							'condition'=> 'swt_users_id = :id',
							'params'=>array(':id'=>$model->swt_users_id),
							'order'=>'role_year DESC',
						));
						
						foreach($education as $val) {
							$update = CcnJobseekerEdu::model()->findByPk($val->id);
							//file_put_contents('tes.txt', array($lastEdu->id.',',$val->id));
							if($val->id == $lastEdu->id) {
								$update->last_edu = '1';
							} else {
								$update->last_edu = '0';
							}
							$update->save(false,array('last_edu'));
						}
						/* end update*/
						echo CJSON::encode(array(
							'type' => 3,
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pendidikan '.$model->degree.' berhasil ditambahkan.').'</strong></div>',
							'get' => Yii::app()->controller->createUrl('index',array('type'=>'ajax'))
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();

		} else {
			$message['id'] = 'ccn-jobseeker-edu-form';
			$message['data'] = $this->renderPartial('front_add',array(
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
	public function actionEdit($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerEdu']))
		{
			$model->attributes=$_POST['CcnJobseekerEdu'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						/* update for last education*/
						$lastEdu = CcnJobseekerEdu::model()->find(array(
							'condition'=> 'swt_users_id = :id',
							'params'=>array(':id'=>$model->swt_users_id),
							'order'=>'role_year DESC',
						));
						$education = CcnJobseekerEdu::model()->findAll(array(
							'condition'=> 'swt_users_id = :id',
							'params'=>array(':id'=>$model->swt_users_id),
							'order'=>'role_year DESC',
						));
						
						foreach($education as $val) {
							$update = CcnJobseekerEdu::model()->findByPk($val->id);
							file_put_contents('tes.txt', array($lastEdu->id.',',$val->id));
							if($val->id == $lastEdu->id) {
								$update->last_edu = '1';
							} else {
								$update->last_edu = '0';
							}
							$update->save(false,array('last_edu'));
						}
						/* end update*/
						echo CJSON::encode(array(
							'type' => 3,
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pendidikan '.$model->degree.' berhasil diubah.').'</strong></div>',
							'get' => Yii::app()->controller->createUrl('index',array('type'=>'ajax'))
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();

		} else {
			$message['id'] = 'ccn-jobseeker-edu-form';
			$message['data'] = $this->renderPartial('front_edit',array(
				'model'=>$model,
			), true, false);

			echo CJSON::encode($message);
		}
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($_GET['id'])) {
				$this->loadModel($id)->delete();
				echo CJSON::encode(array(
					'type' => 3,
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pendidikan berhasil dihapus.').'</strong></div>',
					'get' => Yii::app()->controller->createUrl('index',array('type'=>'ajax'))
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('delete',array('id'=>$_GET['id'])).'" method="post" name="2">';
			$data .= '<div class="dialog-header">Hapus Pendidikan</div>';
			$data .= '<div class="dialog-content">';
			$data .= 'Yakin ingin menghapus data ini?';
			$data .= '</div>';
			$data .= '<div class="dialog-submit">';
			$data .= '<input type="submit" value="Hapus" /><input id="closed" type="button" value="Keluar" />';
			$data .= '</div>';
			$data .= '</form>';

			$result['data'] = $data;
			echo CJSON::encode($result);
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionWizard()
	{
		$this->layout = 'front_wizard';
		
		$model=new CcnJobseekerEdu;

		$edutab = CcnJobseekerEdu::model()->findAll(array(
			//'select' => 'degree',
			'condition' => 'swt_users_id = :id',
			'params'=> array(':id'=>Yii::app()->user->id_user)
		));

		$isEduComplete = 0;
		if(Yii::app()->user->id == 4 ){ /*checking for alumni education*/ 
			
			/*checking for jobseeker SMA education */
			$cekSma = $model->findAll(array(
				'select' => 'degree,swt_users_id',
				'condition' => "degree = 'SMA' and swt_users_id = :id ",
				'params' => array(':id'=>Yii::app()->user->id_user), 
			));
			if($cekSma != null ){
				$cekPerguruanTinggi = $model->findAll(array(
					'select' => 'degree,swt_users_id',
					'condition' => '(degree = "D3" OR degree = "S1" OR degree = "D4") and swt_users_id = :id ',
					'params' => array(':id'=>Yii::app()->user->id_user), 
				));
				if($cekPerguruanTinggi != null)
					$isEduComplete = 1;
			}
                        
		} else if(Yii::app()->user->id == 5 ){ /*checking for jobseeker education*/ 
			
			$jobseekeredu = $model->countByAttributes(array('swt_users_id' => Yii::app()->user->id_user));
			if($jobseekeredu != 0 ){
				$isEduComplete = 1;
			}
		}


		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerEdu']))
		{
			$model->attributes=$_POST['CcnJobseekerEdu'];
			$model->statistic_member_signal = true;
			$model->statistic_edu_signal = true;
			$jsonError = CActiveForm::validate($model);
                        $cekSma = null;
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						/* checking for Get user group id*/
						$isEduComplete = 0;
						if(Yii::app()->user->id == 4){ //jobseeker alumni
							/*checking for jobseeker SMA education */
							$cekSma = $model->findAll(array(
								'select' => 'degree,swt_users_id',
								'condition' => ' degree = "SMA" and swt_users_id = :id ',
								'params' => array(':id'=>Yii::app()->user->id_user), 
							));
							if($cekSma != null ){
								$cekPerguruanTinggi = $model->findAll(array(
									'select' => 'degree,swt_users_id',
									'condition' => '(degree = "D3" OR degree = "S1" OR degree = "D4") and swt_users_id = :id ',
									'params' => array(':id'=>Yii::app()->user->id_user), 
								));
								if($cekPerguruanTinggi != null)
									$isEduComplete = 1;
							}
						} else if(Yii::app()->user->id == 5 ){ //common jobseeker
							
							$jobseekeredu = $model->countByAttributes(array('swt_users_id' => Yii::app()->user->id_user));
							if($jobseekeredu != 0 ){
								$isEduComplete = 1;
							}
						}

						if($model->univ_name_id == 1) {
							$title = $model->name_non_univ;
						} else {
							$title = $model->university->name;
						}
						
						/* update for last education*/
						$lastEdu = CcnJobseekerEdu::model()->find(array(
							'condition'=> 'swt_users_id = :id',
							'params'=>array(':id'=>$model->swt_users_id),
							'order'=>'role_year DESC',
						));
						$education = CcnJobseekerEdu::model()->findAll(array(
							'condition'=> 'swt_users_id = :id',
							'params'=>array(':id'=>$model->swt_users_id),
							'order'=>'role_year DESC',
						));
						
						foreach($education as $val) {
							$update = CcnJobseekerEdu::model()->findByPk($val->id);
							//file_put_contents('tes1.txt', array($lastEdu->id.',',$val->id));
							if($val->id == $lastEdu->id) {
								$update->last_edu = '1';
							} else {
								$update->last_edu = '0';
							}
							$update->save(false,array('last_edu'));
						}
						/* end update*/
						
                                                $addMsg = $cekSma == null && $isEduComplete == 0 && Yii::app()->user->id == 4 ? Yii::t('cv', 'Silahkan untuk mengisi jenjang SMA atau Sederajat terlebih dahulu.'):'';
						$msg = Yii::t('', 'Pendidikan berhasil ditambahkan.').$addMsg;
                                                echo CJSON::encode(array(
							'type' => 5,
							'status' => $isEduComplete,
							'msg' => '<div class="errorSummary success"><strong>'.$msg.'</strong></div>',
							'get' => Yii::app()->controller->createUrl('ajaxwizard',array('id'=>$model->id, 'msg'=>$msg)),
							'tabs' => '<li name="edu-'.$model->id.'" class="active"><a href="javascript:void(0);" title="'.$title.'">'.$title.'</a></li>',
						));


					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();

		} else {
			$this->render('front_wizard',array(
				'model'=>$model,
				'edutab'=>$edutab,
				'status'=>$isEduComplete,
			));
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAjaxWizard($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerEdu']))
		{
			$model->attributes=$_POST['CcnJobseekerEdu'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
                                                $eduName = $model->name_non_univ != '' ? $model->name_non_univ : $model->university->name;
						echo CJSON::encode(array(
							'type' => 0,
							'msg' => '<div class="errorSummary success"><p>'.Yii::t('', 'Pendidikan ').$eduName .Yii::t('', ' berhasil diperbarui.').'</p></div>',
						));

					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();

		} else {
			$message['data'] = $this->renderPartial('ajax_wizard',array(
				'model'=>$model,
			), true, false);

			echo CJSON::encode($message);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CcnJobseekerEdu::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ccn-jobseeker-edu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * @show country
	 */
	public function actionSelectCountry()
	{
		$country = $_GET['country'];
		$data = array();
		if($country != 'id'){
			$data['province'] = '<option value="34">Lainnya</option>';
			$data['city'] = '<option value="499">Lainnya</option>';
		}else{
			$province = CcnProvince::model()->findAll(array(
				'select'=>'id,name',
			));
			if($province != null){
				foreach($province as $val){
					$data['province'] .= '<option value="'.$val->id.'">'.$val->name.'</option>';
				}
				
			}
			$city = CcnCity::model()->findAll(array(
				'select'=>'id,name',
			));
			if($city != null){
				foreach($city as $row){
					$data['city'] .= '<option value="'.$row->id.'">'.$row->name.'</option>';
				}
			}
		}
		
		echo CJSON::encode($data);
	}
	
	/**
	 * @show city
	 */
	public function actionSelectCity()
	{
		$province = $_GET['province'];
		$data = array();
		$listCity = CcnCity::model()->findAll(array(
			'select'=>'id,name',
			'condition'=>'province_id = :pid',
			'params'=>array(':pid'=>$province)
		));
		if($listCity != null){
			foreach($listCity as $val){
				$data['city'] .= '<option value="'.$val->id.'">'.$val->name.'</option>';
			}
		}
		
		echo CJSON::encode($data);
	}
	
}
