<?php
/* ContentController* Handle ContentController* Copyright (c) 2012, SWEVEL. All rights reserved.
* version: 0.0.1
* Reference start
*
* TOC :
*	AdminManage
*	AdminAdd
*	AdminEdit
*	AdminView
*	AdminDelete
*   index
*   view
*	LoadModel
*	performAjaxValidation
*
*----------------------------------------------------------------------------------------------------------
*/

class ContentController extends SBaseController /* Controller */
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout = 'admin';
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
	/* public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	} */

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','ajaxheadline'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('adminview','adminadd','adminedit','adminmanage','admindelete', 'AjaxChoiseCategory'),
				'users'=>array('@'),
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
		// Set public themes
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		$this->layout = $arrThemes['layout'];
		
	   $headnews = Content::model()->findAll(array(
			'select' => 'id, modified, content_categories_id, title, intro_text, full_text, images ',
			'condition' => "published = 1  AND section_id = 2 AND content_categories_id != 4" , 			
			'limit'=>1,
			'order' => 'modified DESC'
		));
		foreach($headnews as $val) {
			$headId = $val->id;		
		}
		//echo $headId;

		$criteria=new CDbCriteria;
		$category = null;
		$criteria->select = 'id, content_categories_id, title, alias_url, intro_text, full_text, images ,modified';
		if(isset($_GET['y']) ||  isset($_GET['m'])) {
			if(isset($_GET['y']) &&  isset($_GET['m'])){
				$criteria->addCondition("YEAR(modified) = '{$_GET['y']}' AND MONTH(modified) = '{$_GET['m']}'");
			}elseif(isset($_GET['y']))				
				$criteria->addCondition("YEAR(modified) = '{$_GET['y']}'");					
		}

		if(isset($_GET['cid']) && $_GET['cid'] != 0) {
			$category = ContentCategories::model()->findByPk($_GET['cid']);
			$criteria->compare('content_categories_id', $_GET['cid']);
		}if(isset($_GET['sid'])) {
			$criteria->compare('section_id', $_GET['sid']);
			$section = ContentSection::model()->findByPk($_GET['sid']);
		}
	
		$criteria->order = 'modified DESC';
		$criteria->addCondition( 'id != '.$headId.'');
		$criteria->addNotInCondition('content_categories_id',array(1,4));
		$dataProvider=new CActiveDataProvider('Content', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 5
			)
		));
		$this->render('front_index',array(
			'headnews'=>$headnews,
			'dataProvider'=>$dataProvider,
			'category'=>$category,
			'section'=>$section,
			'headId'=>$headId
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		// Set public themes
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['template'];
		if($this->loadModel($id)->section_id != 1) {
			$this->layout = $arrThemes['layout'];
			$render = 'front_view';
		} else {
			$this->layout = 'front_pages';
			$render = 'front_view_statis';
		}

		$count		= $this->loadModel($id);
		$hits 		= $count->hits+1 ;
		$sql		= " UPDATE swt_content SET hits=".$hits." WHERE id=".$id." ";
		$command	= Yii::app()->db->createCommand($sql)->execute();
		
		$this->pageTitle		= 'Berita '.$count->title;
		$this->pageDescription	= $count->meta_desc;
		$this->pageMeta			= $count->meta_key;
			
		$this->render($render,array(
			'model'=>$count,
		));
	}

	public function actionAjaxHeadline() {		
		$model= Content::model()->findAll(array(
			'select' => 'id, content_categories_id, title, alias_url, images',
			'condition' => 'published = 1 AND section_id = 2 AND content_categories_id !=4 AND is_headline = 1',
			'limit'=>3,
			'order' => 'modified DESC'
		));
		if($model != null) {
			$data = '<ul>';
			foreach($model as $val){
				$baseUrl = Yii::app()->request->baseUrl.'/images/content/';
				$img = $val->images != '' ? $baseUrl . Content::model()->replaceSpaceWithUnderscore($val->content_categories->title).'/headline_'.$val->images: $baseUrl . 'headline_default_image.jpg'; 
				$data .= '<li><a href="'.Yii::app()->createUrl('content/view', array('id' => $val->id, 't' => $val->alias_url)).'" title="'.$val->title.'"><img src="'.$img.'" alt="'.$val->images.'" /></a></li>';
			}
			$data .= '</ul>';
		}
		

		$result['data'] = $data;
		echo CJSON::encode($result);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage() {

		$section = null;
		$category = null;
		if(isset($_GET['sid']))
			$section = ContentSection::model()->findByPk($_GET['sid'], array('select'=>'title'));
		if(isset($_GET['cid']))
			$category = ContentCategories::model()->findByPk($_GET['cid'], array('select'=>'title'));

		$model=new Content('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Content']))
			$model->attributes=$_GET['Content'];
				$columnTemp = array();
				
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		if(Yii::app()->user->id == 1) {
			$render = 'admin_manage';
		} else {
			$render = 'office_manage';
		}

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial($render,array(
				'section'=>$section,
				'category'=>$category,
				'model'=>$model,			
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render($render,array(
				'section'=>$section,
				'category'=>$category,
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
		$model=new Content;
		//echo $_GET['cid'];
		$categories = ContentCategories::model()->findByPk($_GET['cid'], array('select'=>'params'));

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Content'])) {
			$model->attributes = $_POST['Content'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Artikel berhasil dibuat.'));
				$part = explode('=', $model->getCategory);
				//$this->redirect(array('adminview','id'=>$model->id, $part[0]=> $part[1]));
				$this->redirect(array('adminmanage'));
			}
		}

		$this->render('admin_add',array(
			'model'=>$model,
			'params'=>$categories->params
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

		if(isset($_POST['Content'])) {
			$model->attributes=$_POST['Content'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Artikel berhasil diperbarui.'));
				$part = explode('=', $model->getCategory);
				//$this->redirect(array('adminview','id'=>$model->id, $part[0]=> $part[1]));
				$cid = $_GET['cid'];
				if($cid == 1){
					$part = explode('=', $model->getCategory);
					$this->redirect(array('adminedit','id'=>$model->id,$part[0]=> $part[1]));
				}else{
					$this->redirect(array('adminmanage'));
				}
			}
		}

		$this->render('admin_edit',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAdminView($id) {
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
					'type' => 1,
					'id' => 'partial-content',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Artikel berhasil dihapus.').'</strong></div>',
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Content').'</div>';
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxChoiseCategory() {
		$model = ContentCategories::model()->findAll(array(
			'select' => 'id, title',
			'condition' => 'content_section_id = :id',
			'params' => array(':id' => $_GET['sid']),
		));;
		$this->renderPartial('ajax_choise_category',array(
			'model'=>$model,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=Content::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Performs activate content.
	 * @param CModel the model to be validated
	 */
	public static function activateUrl($sid, $id) 
	{
		return Yii::app()->createUrl('content/activate/', array('sid' => $_GET['sid'], 'id' => $id));
	}
	
	public function actionActivate($sid, $id)
	{
		$model = $this->loadModel($id);
		if ($model->updateByPk($id, array('published' => 1)) > 0){
			Yii::app()->user->setFlash('success', Yii::t('', 'Artikel '.$model->title.'  berhasil diaktifkan.'));
			$this->redirect(array('adminmanage','sid'=>$sid));
		}
	}

	public function actionHeadline(){
		$section = null;
		$category = null;
		if(isset($_GET['sid']))
			$section = ContentSection::model()->findByPk($_GET['sid'], array('select'=>'title'));
		if(isset($_GET['cid']))
			$category = ContentCategories::model()->findByPk($_GET['cid'], array('select'=>'title'));

		$model=new Content('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Content']))
			$model->attributes=$_GET['Content'];
				$columnTemp = array();
				
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$render = 'admin_headline';
		

		if(isset($_GET['type'])) {
			$message['data'] = $this->renderPartial($render,array(
				'section'=>$section,
				'category'=>$category,
				'model'=>$model,			
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render($render,array(
				'section'=>$section,
				'category'=>$category,
				'model'=>$model,			
				'columns' => $columns,
			));
		}
	}

}
