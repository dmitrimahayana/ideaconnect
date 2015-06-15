<?php
Yii::import('application.controllers.ContentController');

class AdminController extends /*SBaseController*/ Controller
{
	public $defaultAction = 'adminmanage';
	public function actionIndex() {
		//$this->render('index');
        echo 'HelloWord';
	}

	public function actionAdminManage() {
		$model = new Content('search');

		$model->unsetAttributes();
		if(isset($_GET['Content'])) {
			$model->attributes = $_GET['Content'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}else
			$columnTemp = null;

		$columns = $model->getGridColumn($columnTemp);
        $this->render('/admin/admin_manage', array(
			'model'   => $model,
			'columns' => $columns)
        );
	}

	public function actionAdminAdd() {
		$model = new Content;
		if(isset($_POST['Content'])) {
			$model->attributes = $_POST['Content'];
			$model->images = CUploadedFile::getInstance($model, 'images');
			if($model->save()) {
				Yii::app()->user->setFlash('success', 'Content success saved.');
				$this->redirect(array('adminmanage'));

			}else {
				Yii::app()->user->setFlash('error', 'Content failed saved.');
				$this->redirect(array('adminmanage'));
			}
		}

		$this->render('admin_add', array('model' => $model));
	}

	public function actionAdminView($id) {
		$this->render('admin_view', array('model' => $this->loadModel($id)));
	}

	public function actionAdminEdit($id) {
		$model = $this->loadModel($id);
		if(isset($_POST['Content'])) {
			$model->attributes = $_POST['Content'];
			$model->images = CUploadedFile::getInstance($model, 'images');
			if($model->save()) {
				Yii::app()->user->setFlash('success', 'Content success saved.');
				$this->redirect(array('adminmanage'));
			}else {
				print_r($model->errors);
			}
		}

		$this->render('admin_add', array('model' => $model));		
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
                $model = $this->loadModel($id);
                $result = array(
					'type' => 1,
					'id'   => 'partial-messege',
					'msg'  => '<div class="errorSummary success"><strong>Content success deleted.</strong></div>',
                );

                if(!$model->delete()) {
					$result = array(
						'type' => 0,
						'id'   => 'partial-messege',
						'msg'  => '<div class="errorSummary error"><strong>Content failed deleted.</strong></div>',
	                );
                }
                echo CJSON::encode($result);
			}

		}else {
			$data = '<form action="'.Yii::app()->controller->createUrl('admindelete',array('id'=>$id)).'" method="post">';
			$data .= '<div class="dialog-header">'.Yii::t('', 'Hapus Konten').'</div>';
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

	private function loadModel($id) {
		$model = Content::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}	
}