<?php
/* ProjectController* Handle ProjectController* Copyright (c) 2012, SWEVEL. All rights reserved.
* version: 0.0.1
* Reference start
*
* TOC :
*	Index
*	View
*	AdminManage
*	AdminAdd
*	AdminEdit
*	AdminView
*	AdminDelete
*
*	LoadModel
*	performAjaxValidation
*
* ----------------------------------------------------------------------------------------------------------
*/

class ProjectController extends /*SBaseController*/ Controller
 {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	//public $layout='admin';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() {
		if(!Yii::app()->user->isGuest) {
			$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
			$arrThemes = Utility::getCurrentTemplate($groupPage);
			Yii::app()->theme = $arrThemes['template'];
			$this->layout = $arrThemes['layout'];
		}
		/* $arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout']; */
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('adminmanage','adminadd','adminedit','adminview','admindelete','publish','getcurrent','RequisiteView','AdminUpdateRequisite','DetailVolunteer','TempProject','EditTime' ),
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
	 * Lists all models.
	 */
	public function actionIndex() {
		// Set public themes
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout'];
		
		//$criteria = new CDbCriteria;
		//$criteria->compare('$name',\$this->$name,true);
		
		$dataProvider=new CActiveDataProvider('Project', array(
			//'criteria' => $criteria,
			//'pagination' => array(
			//	'size' => 10
			//)
		));
		$this->render('front_index',array(
			'dataProvider'=>$dataProvider,
		));
		//$this->redirect(array('adminmanage'));
	}

    public function actionTempProject(){
        echo 'tes123';
        $model=new Project;
        $model->project_name= 'TES123';
        $model->intro_text= 'TES123';
        $model->tagline= 'TES123';
        //$model->geometry_location= '';
        $model->project_category_id= 1;
        $model->project_category_inherit_id= 4;
        $model->video_url= 'TES123';
        $model->background_title= 'TES123';
        $model->background= 'TES123';
        $model->description_title='TES123' ;
        $model->description='TES123' ;
        $model->goal_title= 'TES123';
        $model->goal= 'TES123';
        $model->requisite_title='TES123' ;
        $model->invitation_title='TES123' ;
        $model->invitation='TES123' ;
        $model->edited_time= date("Y-m-d H:i:s");
        $model->created_time= date("Y-m-d H:i:s");
        $model->is_actived= 0;
        $model->is_proposed= 1;
        $model->inisiator_id= 7;
        $model->is_verified= 0;
        $model->is_funded= 0;
        $model->as_institution_id= 3;
        if($model->save()) {
            echo '<br/>sukes';
        }
        else {
            print_r($model->errors);
        }
    }


    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		// Set public themes
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout'];

		$this->pageTitle = ' List';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('front_view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage() {
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project'])) {
			$model->attributes=$_GET['Project'];
		}

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
			$message['data'] = $this->renderPartial('ajax_admin_manage',array(
				'model'=>$model,
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->pageTitle = ' Manage';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_manage',array(
				'model'=>$model,
				'columns' => $columns,
			));
		}

	}	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdminAdd() {
		$model=new Project;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Project'])) {
			$model->attributes=$_POST['Project'];
            $model->inisiator_id=Yii::app()->user->id_user;
            $model->edited_time=date("Y-m-d H:i:s");
            $model->requisite_title=3;
            ($model->requisite_title==null)?$model->requisite_title='kosong':'';

			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Project success created.'));
				$this->redirect(array('adminview','id'=>$model->id));
				//$this->redirect(array('adminmanage'));
			}
            else {
                print_r($model->errors);
            }
		}

		$this->pageTitle = ' Create';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_add',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdminEdit($id) {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Project'])) {
            $object = CUploadedFile::getInstance($model, 'cover_image1');
            $extension = explode(".", $object->name)[1];
            $newFileName = "project-".$id.".".$extension;

			$model->attributes=$_POST['Project'];
            ($model->requisite_title==null)?$model->requisite_title='kosong':'';

            if($object->name != "" || $object->name != NULL){
                $model->cover_image = $newFileName;
                $object->saveAs('images/project/' . $newFileName);
            }

            if($model->is_verified==1)
                $model->verificator_id=Yii::app()->user->id_user;
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Project success updated.'));
				$this->redirect(array('adminview','id'=>$model->id));
				//$this->redirect(array('adminmanage'));
			}
            else {
                print_r($model->errors);
            }
		}

		$this->pageTitle = ' Update';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_edit',array(
			'model'=>$model,
		));
	}

    public function actionGetCurrent(){
        $id = $_POST['input'];
        $model = ProjectCategory::model()->findAllByAttributes(array('parent_id'=>$id));
        if($model==null){
            $items=array(null=>'Pilih Sub Kategori');
        }
        else {
            foreach($model as $val) {
                $items[$val->id] = $val->category_name;
            }
            $items[null]='Tidak ada';
        }
        echo CHtml::dropDownList('Project[project_category_inherit_id]','', $items);
//        $items = array();
//        if($model != null) {
//            foreach($model as $key => $val) {
//                $items[$val->id] = $val->category_name;
//            }
//            return $items;
//        } else {
//            return false;
//        }
    }
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAdminView($id) {
		$this->pageTitle = ' view';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionAdminDelete($id) {
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				$this->loadModel($id)->delete();

				echo CJSON::encode(array(
					'type' => 3,
					'id' => 'partial-project',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Project success deleted.').'</strong></div>',
					'get' => Yii::app()->controller->createUrl('adminmanage',array('type'=>'ajax')),
				));
			}

		}else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Project').'</div>';
			$data .= '<div class="dialog-content">';
			$data .= 'Apakah anda yakin ingin menghapus item ini?';
			$data .= '</div>';
			$data .= '<div class="dialog-submit">';
			$data .= '<input type="submit" value="Delete" />';
			$data .= '<input id="closed" type="button" value="Keluar" />';
			$data .= '</div>';
			$data .= '</form>';

			$result['data'] = $data;
			echo CJSON::encode($result);
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		if($model->publish == 1) {
			$title = 'Unpublish';
			$replace = 0;
		} else {
			$title = 'Publish';
			$replace = 1;
		}

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				//change value active or publish
				$model->publish = $replace;

				if($model->update()) {
					echo CJSON::encode(array(
						'type' => 2,
						'id' => 'partial-project',
						'title' => $model->publish == 1 ? 'Unpublish' : 'Publish',
						'replace' => $model->publish == 1 ? '<img src="'.Yii::app()->theme->baseUrl.'/images/icons/publish.png" alt="Publish">' : '<img src="'.Yii::app()->theme->baseUrl.'/images/icons/unpublish.png" alt="Unpublish">',
					));
				}
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('publish',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.$title.'</div>';
			$data .= '<div class="dialog-content">';
			$data .= 'Apakah anda yakin ingin mempublish item ini?';
			$data .= '</div>';
			$data .= '<div class="dialog-submit">';
			$data .= '<input type="submit" value="'.$title.'" />';
			$data .= '<input id="closed" type="button" value="Keluar" />';
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
	public function loadModel($id) {
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionRequisiteView($id){
        $modelReq=$this->loadModelRequisiteByProject($id);
        $model=new ProjectRequisite();

        $this->pageTitle = 'Pendanaan Project';
        $this->pageDescription = '';
        $this->pageMeta = '';
        //$getDetailSomeRequisite($id);
        $this->render('requisite_view',array(
            'id'=>$id,
            'model'=>$model,
            'modelReq'=>$modelReq,
        ));
    }

    public function actionAdminUpdateRequisite($id, $type, $project_id){
        if($type=='approvePropose'){
            $model=$this->loadModelRequisiteById($id);
            $model->is_approved=1;
            $model->approved_time=date("Y-m-d H:i:s");
            $model->approver_id=Yii::app()->user->id_user;
            ($model->argument==null)?$model->argument='kosong':'';

            //echo $model->is_approved.' '.$model->approved_time.' '.$model->approver_id;
            if($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('', 'Pendanaan Project diapprove.'));
                $this->redirect(array('RequisiteView','id'=>$project_id));
            }
            else {
                print_r($model->getErrors());
            }
        }
        else if($type=='cancelPropose'){
            $model=$this->loadModelRequisiteById($id);
            $model->is_proposed=0;
            ($model->argument==null)?$model->argument='kosong':'';

            if($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('', 'Pendanaan Project dicancel.'));
                $this->redirect(array('RequisiteView','id'=>$project_id));
            }
            else {
                print_r($model->getErrors());
            }
        }
        else if($type=='appFund'){
            $criteria = new CDbCriteria();
            $criteria->compare('is_proposed',1);
            $criteria->limit = 0;
            $model=ProjectRequisite::model()->find($criteria);
            //echo $model->id;
            $model->is_approved=1;
            $model->approved_time=date("Y-m-d H:i:s");
            $model->approver_id=Yii::app()->user->id_user;
            ($model->argument==null)?$model->argument='kosong':'';
            //die();
            if($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('', 'Pendanaan Project Success.'));
                $this->redirect(array('RequisiteView','id'=>$project_id));
            }
            else {
                print_r($model->getErrors());
            }
        }
    }

    public function actionDetailVolunteer($id){
        $model=VolunteerUser::model()->getSomeVolunteerUser($id);
        $this->render('requisite_volunteer_user',array(
            'model'=>$model,
        ));
    }

    public function actionEditTime($id){
        $criteria=new CDbCriteria;
        $criteria->compare('id',$id);
        $model=ProjectRequisite::model()->find($criteria);
        $this->render('requisite_edit_time',array(
            'model'=>$model,
        ));
    }

    public function loadModelRequisiteById($id){
        $criteria=new CDbCriteria;
        $criteria->compare('id',$id);
        $model=ProjectRequisite::model()->find($criteria);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function loadModelRequisiteByProject($id){
        $criteria=new CDbCriteria;
        $criteria->compare('project_id',$id);
        $model=ProjectRequisite::model()->find($criteria);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}