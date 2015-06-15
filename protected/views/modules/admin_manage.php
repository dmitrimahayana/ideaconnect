<?php
	$this->pageTitle='Com Modules';
	$this->breadcrumbs=array(
		'Manage',
	);

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('com-modules-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
	$cs->registerScript('search', $js, CClientScript::POS_END);
?>


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

<?php //begin.Grid Option ?>
<div class="grid-option">
<?php $this->renderPartial('_option_form',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Grid Option ?>


<?php //begin.Grid Item ?>
<?php
	$columnData   = $columns;
	array_push($columnData, array(
		'header' => 'Options',
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
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))'),
			'install' => array(
				'label' => 'install',
				'options' => array(
					'class' => 'install'
				),
				'url' => 'Yii::app()->controller->createUrl("admininstall",array("id"=>$data->primaryKey))'),
			'uninstall' => array(
				'label' => 'uninstall',
				'options' => array(
					'class' => 'uninstall'
				),
				'url' => 'Yii::app()->controller->createUrl("adminuninstall",array("id"=>$data->primaryKey))')
		),
		'template' => '{update}&nbsp;{install}&nbsp;{uninstall}&nbsp;{delete}',
	));

	$this->widget('application.components.system.SGridView', array(
		'id'=>'com-modules-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));

?>
<?php //end.Grid Item ?>

	<div style="background-color: white" class="pl-10 pt-5 pb-5">
		<form action="<?php echo $this->createUrl('adminmanage'); ?>" name="form-module-upload"
			method="post" enctype="multipart/form-data">
			<label>Nama file: </label>&nbsp;
			<input type="file" name="file_name" size="40">&nbsp;
			<input type="submit" value="Submit">
		</form>
	</div>
