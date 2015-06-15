<?php
	/* @var $this ProjectController */
	/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('adminmanage'),
    $modelReq->project->project_name=>array('adminview','id'=>$modelReq->project_id),
    Yii::t('site', 'Detail Pendanaan'),
);

	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
?>

<? //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages ?>
<div id="ajax-message">
    <?php
    if(Yii::app()->user->hasFlash('error'))
        echo Utility::flashError(Yii::app()->user->getFlash('error'));
    if(Yii::app()->user->hasFlash('success'))
        echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
    ?>
</div>

<?php
$this->widget('CTabView', array(
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'Pendanaan',
            'view'=>'/projectrequisite/_view_requisite',
            'data'=>array('model'=>$model,'id'=>$id),
        ),
        'tab2'=>array(
            'title'=>'Informasi Progress',
            'view'=>'progress_info',
            'data'=>array('model'=>$modelProjectInf,'id'=>$id,'project_name'=>$modelReq->project->project_name),
        ),
        'tab3'=>array(
            'title'=>'Komentar',
            'view'=>'/projectcomment/admin_manage',
            'data'=>array('model'=>$modelComm,'id'=>$id),
        ),
    ),
));


?>

