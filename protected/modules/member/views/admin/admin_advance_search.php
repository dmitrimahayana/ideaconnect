<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	

	$this->pageTitle = 'Jobseeker Advance Search';
	$this->breadcrumbs=array(
		'Member '.$title=>array('adminmanage',"gid"=>$_GET['gid']),
		'Kelola',
	);
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('pcr-users-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
	$cs->registerScript('search', $js, CClientScript::POS_END);

	$this->menu=array(
		array(
			'label' => 'Advance Search', 'url' => array('javascript:void(0);'),
			'itemOptions' => array('class' => 'search-button'),
			'linkOptions' => array('title' => 'Cari'),
		), 
		array(
			'label' => 'Grid Options', 
			'url' => array('javascript:void(0);'),
			'itemOptions' => array('class' => 'grid-button'),
			'linkOptions' => array('title' => 'Grid Options'),
		),
	);
?>

<?php //begin.Grid Option ?>
<div class="grid-option"><div class="shadow"></div>
<?php $this->renderPartial('_option_form',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Grid Option ?>

<div id="partial-ccn-users">
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

	<?php //begin.Search ?>
	<div class="search-form" id="advance">
	<?php $this->renderPartial('_advanced_search',array(
		'modelAdvanceSearch'=>$modelAdvanceSearch,
	)); ?>
	</div>
	<?php //end.Search ?>

	<?php //begin.Grid Item ?>
	<?php $this->widget('application.components.system.BGridView', array(
		'id'=>'pcr-users-grid',
		'dataProvider'=>$dataProvider,
		'filter'=>$model,
		'columns'=>array(
			array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			),
			array(
				'header'		=> 'Nama Lengkap',
				'value'		=> '$data->jobseeker_bio1->complete_name'
			),
			array(
				'name'		=> 'email',
				'value'		=> '$data->email'
			),
			array(
				'name'	=> 'mobile_no',
				'value'		=> '$data->mobile_no',
				'htmlOptions' => array('class' => 'center')
			),
			array(
				'header'	=> 'Tgl&nbsp;Gabung',
				'name'	=> 'register_date',
				'value'		=> 'date("d-m-Y", strtotime(substr($data->register_date, 0, 10)))',
				'htmlOptions' => array('class' => 'center')
			),
			array(
				'name'	=> 'actived',
				'value'		=> '$data->actived == 1 ? Utility::getPublishedToImg($data->actived) : CHtml::link(Utility::getPublishedToImg($data->actived), AdminController::activateUrl($_GET[gid], $data->primaryKey))',
				'type'		=> 'raw',
				'htmlOptions' => array('class' => 'center')
			),
			array(
				'name'	=> 'block',
				'value'	=> 'CHtml::link(
					Utility::getPublishedToImg($data->block), $data->block == 1 ? AdminController::cancelApprovalUrl($_GET[gid], $data->primaryKey) : 
					AdminController::ApproveUrl($_GET[gid], $data->primaryKey),
					array(
						\'class\' => \'approve\',
						\'onclick\' =>
							$data->block == 1 ? \'if(!confirm("Yakin ingin mengeblok member ini?")){return false;}\' :
							\'if(!confirm("Yakin ingin meng-approve member ini?")){return false;}\'
					)
				)',
				'type'		=> 'raw',
				'htmlOptions' => array('class' => 'center')
			),
			array(
				'header' => 'Opsi',
				'class'=>'CButtonColumn',
				'buttons' => array(
					'view' => array(
						'label' => 'lihat',
						'options' => array(
							//'rel' => 600, 
							'class' => 'view'
						),
						//'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))'),
					'update' => array(
						'label' => 'ubah',
						'options' => array(
							//'rel' => 600, 
							'class' => 'update'
						),
						//'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))'),
					'delete' => array(
						'label' => 'hapus',
						'options' => array(
							'rel' => 350, 
							'class' => 'delete'
						),
						'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey,"group"=>$data->users_group_id))')
				),
				'template' => '{view}',
			),
		),
		'pager' => array('header' => ''),
	)); ?>

	<?php //end.Grid Item ?>
</div>