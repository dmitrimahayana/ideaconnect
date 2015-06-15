<?php
	/* @var $this GroupadminController */
	/* @var $model CcnGroupAdmin */

	$this->pageTitle = Yii::t('site', 'Kelola Grup Admin');
	$this->breadcrumbs=array(
		'Grup Admin'=>array('adminmanage'),
		Yii::t('site', 'Kelola'),
	);
?>


<div id="partial-ccn-group-admin">
	<?php //begin.Messages ?>
	<div id="ajax-message">
	<?php
		if(Yii::app()->user->hasFlash('error'))
			echo Utility::flashError(Yii::app()->user->getFlash('error'));
		if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
	?>
	</div>
	<?php //begin.Messages ?>

	<?php //begin.Grid Item ?>
	<?php 
	$columnData = $columns;
	array_push($columnData, array(
		'header' => 'Opsi',
		'class'=>'CButtonColumn',
		'buttons' => array(
			'view' => array(
				'label' => 'lihat',
				'options' => array(
					'rel' => 500, 
					'class' => 'view'
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey))'),
			'update' => array(
				'label' => 'ubah',
				'options' => array(
					'rel' => 500, 
					'class' => 'update'
				),
				//'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
			'delete' => array(
				'label' => 'hapus',
				'options' => array(
					'class' => 'delete',
					'rel' => 350, 
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
		),
		'template' => '{update}&nbsp;{delete}',
	));

	$this->widget('application.components.system.BGridView', array(
		'id'=>'ccn-group-admin-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));

	?>
	<?php //end.Grid Item ?>
</div>

