<?php
	$this->pageTitle='Content Sections';
	$this->breadcrumbs=array(
		'Manage',
	);
?>

<div id="partial-content-section">
	<?php //begin.Messages ?>
	<div id="ajax-message">
	<?php
		if(Yii::app()->user->hasFlash('error'))
			echo Utility::flashError(Yii::app()->user->getFlash('error'));
		if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
	?>
	</div>
	<?php //end.Messages ?>

	<?php //begin.Grid Item ?>
	<?php 
		$columnData = $columns;
		array_push($columnData, array(
			'header' => 'Option',
			'class'=>'CButtonColumn',
			'buttons' => array(
				'update' => array(
					'label' => 'update',
					'options' => array(
						//'rel' => 500, 
						'class' => 'update'
					),
					//'click' => 'dialogUpdate',
					'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
				'delete' => array(
					'label' => 'delete',
					'options' => array(
						'rel' => 350, 
						'class' => 'delete'
					),
					'click' => 'dialogUpdate',
					'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
			),
			'template' => '{update}&nbsp;{delete}',
		));

		$this->widget('application.components.system.BGridView', array(
			'id'=>'content-section-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns' => $columnData,
			'pager' => array('header' => ''),
		));

	?>
	<?php //end.Grid Item ?>
</div>