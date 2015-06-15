<?php

class AdminController extends Controller {

    public function init() {
        if (!Yii::app()->user->isGuest) {
            $groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
            $arrThemes = Utility::getCurrentTemplate($groupPage);
            Yii::app()->theme = $arrThemes['template'];
            $this->layout = $arrThemes['layout'];
        }
    }

    /*start manage badge*/
    public function actionBadge() {
		//$this->render('index');
        $this->actionManageBadge();
	}

    public function actionManageBadge(){
        $model = new Badge('search');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Badge'])) {
            $model->attributes = $_GET['Badge'];
        }

        $columnTemp = array();
        if (isset($_GET['GridColumn'])) {
            foreach ($_GET['GridColumn'] as $key => $val) {
                if ($_GET['GridColumn'][$key] == 1) {
                    $columnTemp[] = $key;
                }
            }
        }

        $columns = $model->getGridColumn($columnTemp);
        $this->render('index', array(
            'model' => $model,
            'columns' => $columns,
        ));
    }

    public function actionBadgeAdd() {
        $model = new Badge();

        if (isset($_POST['Badge'])) {
            $model->attributes = $_POST['Badge'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('', "Badge $model->badge berhasil disimpan."));
                $this->redirect(array('badgeview', 'id' => $model->id));
                //$this->redirect(array('adminmanage'));
            }
        }

        $this->render('Badge_add', array(
            'model' => $model,
        ));
    }

    public function actionBadgeEdit($id) {
        $model = $this->loadModelBadge($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Badge'])) {
            $model->attributes = $_POST['Badge'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('', "Badge $model->badge berhasil diperbaharui."));
                $this->redirect(array('badgeview', 'id' => $model->id));
                //$this->redirect(array('adminmanage'));
            }
        }

        $this->render('Badge_edit', array(
            'model' => $model,
        ));
    }

    public function actionBadgeDelete($id) {
        $this->loadModelBadge($id)->delete();
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('managebadge'));
    }

    public function actionBadgeView($id) {
        $this->render('Badge_view', array(
            'model' => $this->loadModelBadge($id),
        ));
    }

    public function loadModelBadge($id) {
        $model = Badge::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    /*end manage badge*/
}