<?php
	$this->pageTitle='Users';
	$this->breadcrumbs=array(
		'Manage',
	);

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('users-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
?>



<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //begin.Messages ?>

<?php $this->widget('application.components.system.SGridView', array(
	'id'=>'users-grid',
	//'cssFile' => Yii::app()->baseUrl . '/css/back_office/table.css',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array(
			'header' => 'No',
			'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
		),
		'name',
		'users_group.name',
		'username',		
		'actived',
	//	'password',
		/*
		'email',
		'block',
		'register_date',
		'last_visit_date',
		'activation',
		'is_online',
		'photo',
		'mobile_no',
		'params',
		*/
		array(
			'header' => 'Options',
			'class'=>'CButtonColumn',
			'buttons' => array(
				'view' => array(
					'label' => 'view',
					'options' => array(
						'class' => 'view'
					),
					'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey))'),
				'update' => array(
					'label' => 'update',
					'options' => array(
						'class' => 'update'
					),
					'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
				'delete' => array(
					'label' => 'delete',
					'options' => array(
						'class' => 'delete'
					),
					'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
			),
			'template' => '{view}&nbsp;{update}&nbsp;{delete}',
		),
	),
	'pager' => array('header' => ''),
)); ?>
