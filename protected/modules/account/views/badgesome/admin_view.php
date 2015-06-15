<?php
	/* @var $this BadgeSomeController */
	/* @var $model BadgeSome */

$this->breadcrumbs=array(
	'Badge Somes'=>array('adminmanage'),
	Yii::t('site', 'Detail Badge Somes'),
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
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
//		'badge_id',
//		'user_id',
        array(
            'name' => 'badge_id',
            'value' => $model->badge->badge,
        ),
        array(
            'name' => 'user_id',
            'value' => $model->user->username,
        ),
        array(
            'name' => 'Name',
            'value' => $model->user->name,
        ),
	),
)); ?>
