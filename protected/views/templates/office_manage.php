<?php
	$this->pageTitle='Templates';
	$this->breadcrumbs=array(
		'Manage',
	);
?>

<div id="partial-templates" class="partial-add clearfix">
	<?php //begin.Messages ?>
	<div id="ajax-message">
	<?php
		if(Yii::app()->user->hasFlash('error'))
			echo Utility::flashError(Yii::app()->user->getFlash('error'));
		if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
	?>
	</div>
	<div class="clear"></div>
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
						'rel' => 500, 
						'class' => 'update'
					),
					'click' => 'dialogUpdate',
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
			'id'=>'templates-form',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns' => $columnData,
			'pager' => array('header' => ''),
		));
	?>
	<?php //end.Grid Item ?>

	<div class="form">
		<h3><?php echo Yii::t('','Upload Tema');?></h3>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'content-categories-form',
			'enableAjaxValidation'=>true,
			'htmlOptions'=> array(
				'name'=>'form-theme-upload',
				'enctype'=>'multipart/form-data',
			)
		)); ?>
			<fieldset>
				<div class="clearfix">
					<label>File Tema<span class="required">*</span></label>
					<div class="desc">
						<input type="file" name="file_name" size="40">
					</div>
				</div>

				<div class="submit clearfix">
					<label>&nbsp;</label>
					<div class="desc">
						<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Uplaod') : Yii::t('','Uplaod'), array('onclick' => 'setEnableSave()')); ?>
					</div>
				</div>
			</fieldset>
		<?php $this->endWidget(); ?>
	</div>

</div>
