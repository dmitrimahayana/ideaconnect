<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->breadcrumbs=array(
		'Member '.$title=>array('adminmanage',"gid"=>$_GET['gid']),
		'Kelola',
	);
	$this->menu=array(
		array(
			'label' => 'Cari', 
			'url' => array('javascript:void(0);'),
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

<?php //begin.Search ?>
<div class="search-form"><div class="shadow"></div>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Search ?>

<?php //begin.Grid Option ?>
<div class="grid-option"><div class="shadow"></div>
<?php $this->renderPartial('_option_form',array(
	'model'=>$model,
	'columns'=>$columns,
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

	<?php //begin.Grid Item ?>
	<?php /*
		$columnData = $columns;
		array_push($columnData, array(
			'header' => 'Option',
			'class'=>'CButtonColumn',
			'buttons' => array(
				'view' => array(
					'label' => 'view',
					'options' => array(
						//'rel' => 600, 
						'class' => 'view'
					),
					//'click' => 'dialogUpdate',
					'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey))'),
				'update' => array(
					'label' => 'update',
					'options' => array(
						//'rel' => 600, 
						'class' => 'update'
					),
					//'click' => 'dialogUpdate',
					'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey, "gid"=>5))'),
				'delete' => array(
					'label' => 'delete',
					'options' => array(
						'class' => 'delete'
					),
					'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
			),
			'template' => '{view}&nbsp;{update}&nbsp;{delete}',
		));

		$this->widget('application.components.system.BGridView', array(
			'id'=>'ccn-users-grid',
			'dataProvider'=>$dataProvider,
			'filter'=>$model,
			'columns' => $columnData,
			'pager' => array('header' => ''),
		)); */
		$id = $_GET['gid'];
		if($id == 6) {
			$dataStatus = array(0=>'Registrasi', 1=>'Aktifasi', 3=>'Approved', 4=>'Data Perusahaan', 6=>'Rejected', 7=>'Blocked');
		}elseif($id == 4 || $id == 5) {
			$dataStatus = array(0=>'Registrasi', 1=>'Aktifasi', 2=>'Konfirmasi Pembayaran', 3=>'Approved', 4=>'Domisili', 5=>'Aktif (Data komplete)', 6=>'Rejected', 7=>'Blocked');
		}
		
		Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_register_date').datepicker();
}
");
	?>

	<?php $this->widget('application.components.system.BGridView', array(
		'id'=>'pcr-users-grid',
		'dataProvider'=>$dataProvider,
		//'dataProvider'=>$model->search(),
		'afterAjaxUpdate' => 'reinstallDatePicker',
		'filter'=>$model,
		'columns'=>array(
			array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			),
			array(
				'name'		=> 'name',
				'value'		=> '($_GET[gid] == 4 || $_GET[gid] == 5) ? ($data->jobseeker_bio1->complete_name == \'\' ? \'-\' : $data->jobseeker_bio1->complete_name) 
				: ($data->employer_data1->name == \'\' ? \'-\' : $data->employer_data1->name)'
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
				'name'			=> 'register_date',
				'value'			=> 'date("d-m-Y", strtotime(substr($data->register_date, 0, 10)))',
				'htmlOptions'	=> array('class' => 'center'),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'register_date', 
                'language' => 'ja',
                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
                'htmlOptions' => array(
                    'id' => 'datepicker_for_register_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true),
			),
			array(
				'name'	=> 'status_user',
				'value'		=> 'CcnUsers::model()->getStatusUser($data->status_user, $_GET[gid])',
				'type'		=> 'raw',
				'htmlOptions' => array('class' => 'center'),
				'filter'=>$dataStatus,
			),
			array(
				'name'	=> 'actived',
				'value'		=> '$data->actived == 1 ? Utility::getPublishedToImg($data->actived) : CHtml::link(Utility::getPublishedToImg($data->actived), AdminController::activateUrl($_GET[gid], $data->primaryKey))',
				'type'		=> 'raw',
				'htmlOptions' => array('class' => 'center'),
				'filter'=>array(0=>'Tidak Aktif', 1=>'Aktif'),
			),
			array(
				'name'	=> 'block',
				'value'		=> 'CHtml::link(
							$data->block == 1 ? "Ya" : "Tidak",
							$data->block == 1 ? AdminController::unBlockUrl($_GET[gid], $data->primaryKey) : AdminController::blockUrl($_GET[gid], $data->primaryKey),
							array(
								\'class\' => \'approve\',
								\'onclick\' =>
									$data->block == 1 ? \'if(!confirm("Yakin ingin meng-unblock member ini?")){return false;}\' :
									\'if(!confirm("Yakin ingin mengeblok member ini?")){return false;}\'
							))',
				'type'		=> 'raw',
				'htmlOptions' => array('class' => 'center'),
				'filter'=>array(0=>'Tidak', 1=>'Ya'),
			),
			/* array(
				'name'	=> 'block',
				'value'	=> 'CHtml::link(
					Utility::getPublishedToImg($data->block), $data->block == 1 ? AdminController::cancelApprovalUrl($_GET[gid], $data->primaryKey) : 
					AdminController::ApproveUrl($_GET[gid], $data->primaryKey),
					array(
						\'class\' => \'approve\',
						\'onclick\' =>
							$data->block == 1 ? \'if(!confirm("Yakin ingin meng-unblock member ini?")){return false;}\' :
							\'if(!confirm("Yakin ingin mengeblok member ini?")){return false;}\'
					)
				)',
				'type'		=> 'raw',
				'htmlOptions' => array('class' => 'center')
			), */
			array(
				'header' => 'data',
				'value' => '($_GET[gid] == 4 || $_GET[gid] == 5) ? ($data->jobseeker_bio1->swt_users_id == null ? Chtml::link("Tambah Biodata",Yii::app()->controller->createUrl("jobseekerbiodata",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))) : Chtml::link("Edit Biodata",Yii::app()->controller->createUrl("jobseekerbiodataedit",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))))
				: ($data->employer_data1->swt_users_id == null ? Chtml::link("Add Data",Yii::app()->controller->createUrl("employerdata",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))) : Chtml::link("Edit Data",Yii::app()->controller->createUrl("employerdataedit",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))))',
				'type'=>'raw',
				'filter'=>array(0=>'no data', 1=>'data'),
			),		
			array(
				'header' => 'Option',
				'class'=>'CButtonColumn',
				'buttons' => array(
					'view' => array(
						'label' => 'lihat',
						'options' => array(
							//'rel' => 600, 
							'class' => 'view',
							'title' => 'Lihat Anggota',
						),
						//'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))'),
					'update' => array(
						'label' => 'perbarui',
						'options' => array(
							'rel' => 500, 
							'class' => 'update',
							'title' => 'Perbarui Anggota',
						),
						'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey, "gid"=>$_GET[gid]))'),
					'delete' => array(
						'label' => 'hapus',
						'options' => array(
							'rel' => 350, 
							'class' => 'delete',
							'title' => 'Hapus Anggota',
						),
						'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey,"group"=>$data->users_group_id))')
				),
				'template' => '{view}|{update}|{delete}',
			),
		),
		'pager' => array('header' => ''),
	)); ?>

	<?php //end.Grid Item ?>
</div>