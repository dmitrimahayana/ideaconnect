<?php
/* MenuController* Handle MenuController* Copyright (c) 2012, SWEVEL. All rights reserved.
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

class MenuController extends /*SBaseController*/ Controller
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
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			/* array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index',),
				'users'=>array('*'),
			), */
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('adminview','adminadd','adminedit','adminmanage','admindelete', 
				'AjaxGetListContent', 'AjaxGetListItemRoles', 'AjaxGetListItemRolesMenu'),
				'users'=>array('@'),
				'expression'=>'$user->id==1'
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
		$this->redirect(array('adminmanage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdminManage()	{
		$menuType = MenuTypes::model()->findByPk($_GET['tid']);
		$model=new Menu('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Menu'])) {
			$model->attributes=$_GET['Menu'];
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
			$message['data'] = $this->renderPartial('admin_manage',array(
				'menuType'=>$menuType,
				'model'=>$model,
				'columns' => $columns,
			), true, false);
			echo CJSON::encode($message);

		} else {
			$this->render('admin_manage',array(
				'menuType'=>$menuType,
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
		$model=new Menu;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$menuType = MenuTypes::model()->findByPk($_GET['tid']);
		
		if(isset($_POST['Menu'])) {
			$model->attributes=$_POST['Menu'];
			$arrAttr = array();
			if(count($_POST['Menu']['attr']) > 0) {
				foreach($_POST['Menu']['attr'] as $key=>$val) {
					if($_POST['Menu']['attr'][$key] != null) {
						$arrAttr[] = $val .'='. $_POST['Menu']['value'][$key];
					}			
				}
				$model->attr_url = implode('&', $arrAttr);
			}
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Menu success created.'));
				$this->redirect(array('adminview','id'=>$model->id, 'Menu[menu_type]'=>$model->menu_type, 'tid'=>$model->menu_types_id));
				//$this->redirect(array('adminmanage'));				
			}
		}

		$this->render('admin_add',array(
			'menuType'=>$menuType,
			'model'=>$model,
		));
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
		// $this->performAjaxValidation($model);
		$menuType = MenuTypes::model()->findByPk($_GET['tid']);

		if(isset($_POST['Menu'])) {
			$model->attributes=$_POST['Menu'];
			$arrAttr = array();
			foreach($_POST['Menu']['attr'] as $key=>$val) {
				if($_POST['Menu']['attr'][$key] != null) {
					$arrAttr[] = $val .'='. $_POST['Menu']['value'][$key];
				}			
			}
			$model->attr_url = implode('&', $arrAttr);
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('', 'Menu success created.'));
				$this->redirect(array('adminview','id'=>$model->id, 'Menu[menu_type]'=>$model->menu_type, 'tid'=>$model->menu_types_id));			
				//$this->redirect(array('adminmanage'));
			}
		}

		$this->render('admin_edit',array(
			'menuType'=>$menuType,
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAdminView($id) {
		$this->render('/menu/admin_view',array(
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
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('', 'Menu success deleted.').'</strong></div>',
					'get' => Yii::app()->controller->createUrl('adminmanage',array('type'=>'ajax')),
				));
			}

		} else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">Hapus Menu</div>';
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
	 * Get list content call from menu/adminadd
	 * @return str list data
	 */
	public function actionAjaxGetListContent() {
		if($_POST['dest_type'] == 'module') {	
			$model = ComModules::model()->findAll(array(
				'select' => 'id, name, public_menu_link, admin_menu_link',
				'condition' => 'enabled = 1',
				//'params' => array(':id' => $),
				'order' => 'ordering'
			));
		}elseif($_POST['dest_type'] == 'content_section') {		
			$model = ContentSection::model()->findAll(array(
				'select' => 'id, title, alias_url',
				'condition' => 'published = 1',
				//'params' => array(':id' => $),
				'order' => 'ordering'
			));
		}elseif($_POST['dest_type'] == 'content_category') {
			$model = ContentCategories::model()->findAll(array(
				'select' => 'id, title, alias_url',
				'condition' => 'published = 1',
				//'params' => array(':id' => $),
				'order' => 'ordering'
			));
		}elseif($_POST['dest_type'] == 'content_detil') {
			$model = Content::model()->findAll(array(
				'select' => 'id, title, alias_url',
				'condition' => 'section_id=1 AND published = 1',
				//'params' => array(':id' => $),
				'order' => 'ordering'
			));
		}elseif($_POST['dest_type'] == 'contact_detail') {
			$model = ContactDetails::model()->findAll(array(
				'select' => 'id, name, alias_url',
				'condition' => 'published = 1',
				//'params' => array(':id' => $),
				'order' => 'ordering'
			));		
		}
		$this->renderPartial('ajax_list_content',array(
			'model'=>$model,
			'destType'=>$_POST['dest_type'],
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model=Menu::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Get list content call from menu/adminadd
	 * @return str list data
	 */
	public function actionAjaxGetListItemRoles() {
		$roles = UsersGroup::model()->findAll(array('condition'=>'id NOT IN (4,5,6)'));
		$listRole = '';
		if($roles != null) {
			foreach($roles as $val) {
				$arrRole[$val->id] = "'{$val->group_name}'";			
			}
			echo $listRole = implode(', ', $arrRole);
		}
		
		$model = SrbacItemchild::model()->findAll(array(
			'condition' => "parent IN ($listRole) AND child = :c",
			'params' => array(':c' => $_GET['task']),
			//'order' => 'ordering'
		));
		$option = '';
		if($model != null) {
			foreach($model as $val) {
				$arrCurRole[] = "'{$val->parent}'";
			}
			$listCurRole = implode(', ', $arrCurRole);
			$groups = UsersGroup::model()->findAll(array(
				'condition' => "group_name IN ($listCurRole)",
			));
			
			$arrGroup = array();
			if($groups != null) {
				foreach($groups as $row) {
					$arrGroup[] = $row->id;
				}
			}
			foreach($arrRole as $key=>$item) {
				$option .= '<option value="'.$key.'" ';
				if(in_array($key, $arrGroup))
					$option .= ' selected="selected"';
				$option .= '>'.$item.'</option>';
				
			}
		}else {
			foreach($arrRole as $key=>$item) {
				$option .= '<option value="'.$key.'" ';
				$option .= ' selected="selected"';
				$option .= '>'.$item.'</option>';
				
			}
		
		}
		echo $option;
	}
	
	public function actionAjaxGetListItemRolesMenu() {
		$roles = UsersGroup::model()->findAll(array('condition'=>'id NOT IN (4,5,6)'));
		$listRole = '';
		if($roles != null) {
			foreach($roles as $val) {
				$arrRole[$val->id] = "'{$val->group_name}'";			
			}
		}
		
		$model = MenuAuth::model()->findAll(array(
			'condition' => "swt_menu_id = :c",
			'params' => array(':c' => $_GET['id']),
			//'order' => 'ordering'
		));
		$option = '';
		
			foreach($model as $val) {
				$arrCurRole[] = $val->swt_users_group_id;
			}
		
			foreach($arrRole as $key=>$item) {
				$option .= '<option value="'.$key.'" ';
				if(in_array($key, $arrCurRole))
					$option .= ' selected="selected"';
				$option .= '>'.$item.'</option>';
				
			}
		
		echo $option;
	}
	
}
