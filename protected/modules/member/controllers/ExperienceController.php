<?php

class ExperienceController extends Controller
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
				'actions'=>array('index','edit','delete','add','wizard','ajaxwizard'),
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
		$dataProvider = new CActiveDataProvider('CcnJobseekerExp', array(
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

	public function actionAdd()
	{
		$model=new CcnJobseekerExp;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerExp']))
		{
			$model->attributes=$_POST['CcnJobseekerExp'];
			
			//begin checking alumni and update statistic
			if(Yii::app()->user->id == '4' ){
				$model->statistic_exp_ind_signal = true;
				$model->statistic_exp_function_signal = true;
				$model->statistic_exp_major_finish_year_signal = true;
				$model->statistic_exp_major_role_year_signal = true;
			}
			// end checking alumni and update statistic
			 
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 3,
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pengalaman Kerja '.$model->company_name.' berhasil ditambahkan.').'</strong></div>',
							'get' => Yii::app()->controller->createUrl('index',array('type'=>'ajax'))
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();

		} else {
			$message['id'] = 'ccn-jobseeker-exp-form';
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
                $model->exp_ind_old = $model->industry; //for statistic
                $model->exp_function_old = $model->function;  //for statistic

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerExp']))
		{
			$model->attributes=$_POST['CcnJobseekerExp'];

            //begin checking alumni and update statistic
			if(Yii::app()->user->id == '4' ){
				$model->statistic_exp_ind_signal = true;
				$model->statistic_exp_function_signal = true;
				$model->statistic_exp_major_finish_year_signal = true;
				$model->statistic_exp_major_role_year_signal = true;
                                
                                 //update old statistic
                                if($model->industry !== $model->exp_ind_old)
                                    $model->exp_ind_change = true;
                                if($model->function !== $model->exp_function_old)
                                    $model->exp_function_change = true;
			}
			// end checking alumni and update statistic
                        
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {                                               
                                                
						echo CJSON::encode(array(
							'type' => 3,
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pengalaman kerja '.$model->company_name.' berhasil diubah.').'</strong></div>',
							'get' => Yii::app()->controller->createUrl('index',array('type'=>'ajax'))
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();

		} else {
			$message['id'] = 'ccn-jobseeker-exp-form';
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
                $model = $this->loadModel($id);
                 //begin checking alumni and update statistic
                if(Yii::app()->user->id == '4' ){
                    $model->exp_ind_old = $model->industry; //for statistic
                    $model->exp_function_old = $model->function;  //for statistic
                    
                    $model->statistic_exp_ind_signal = true;
                    $model->statistic_exp_function_signal = true;
                    $model->statistic_exp_major_finish_year_signal = true;
                    $model->statistic_exp_major_role_year_signal = true;
              
                }
                // end checking alumni and update statistic
                 
				$model->delete();
				echo CJSON::encode(array(
					'type' => 3,
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pengalaman berhasil dihapus.').'</strong></div>',
					'get' => Yii::app()->controller->createUrl('index',array('type'=>'ajax'))
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('delete',array('id'=>$_GET['id'])).'" method="post" name="2">';
			$data .= '<div class="dialog-header">Hapus Pengalaman</div>';
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

		$exptab = CcnJobseekerExp::model()->findAll(array(
			//'select' => 'degree',
			'condition' => 'swt_users_id = :id',
			'params'=> array(':id'=>Yii::app()->user->id_user)
		));

		$model=new CcnJobseekerExp;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CcnJobseekerExp'])) {
			
			$model->attributes=$_POST['CcnJobseekerExp'];
			
			//begin checking alumni and update statistic
			if(Yii::app()->user->id == '4' ){
				$model->statistic_exp_ind_signal = true;
				$model->statistic_exp_function_signal = true;
				$model->statistic_exp_major_finish_year_signal = true;
				$model->statistic_exp_major_role_year_signal = true;
			}
			// end checking alumni and update statistic
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			}else {
				 if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						// update flex in biodata- cv_status
						//$exp = $model->countByAttributes(array('swt_users_id' => Yii::app()->user->id_user)); 
						//if($exp > 0){
							//$bio = CcnJobseekerBio::model()->findByAttributes(array('swt_users_id' => Yii::app()->user->id_user), array('select'=>'id'));
							//CcnJobseekerBio::model()->save(
							//$bio->cv_status =3;
							//$bio->save(false, array('cv_status'));
						//}

						echo CJSON::encode(array(
							'type' => 5,
							'status' => 1,
							'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Pengalaman Kerja berhasil ditambahkan.').'</strong></div>',
							'get' => Yii::app()->controller->createUrl('ajaxwizard',array('id'=>$model->id)),
							'tabs' => '<li name="exp-'.$model->id.'" class="active"><a href="javascript:void(0);" title="'.$model->company_name.'">'.$model->company_name.'</a></li>',
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
				'exptab'=>$exptab,
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

		if(isset($_POST['CcnJobseekerExp']))
		{
			$model->attributes=$_POST['CcnJobseekerExp'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 0,
							'msg' => '<div class="errorSummary success"><p>create success</p></div>',
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
		$model=CcnJobseekerExp::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ccn-jobseeker-exp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
