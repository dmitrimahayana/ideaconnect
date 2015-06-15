<?php
	$this->pageTitle = 'Pengalaman Kerja';
	$this->breadcrumbs=array();
?>

<?php //begin.Error Message ?>
<div id="ajax-message"></div>
<?php //end.Error Message ?>

<?php
if($dataProvider->getTotalItemCount() == 0) {
	echo '<div class="empty border-on bell-gothic">Data Tidak ditemukan</div>';
} else {
	$this->widget('application.components.system.FGridView', array(
		'dataProvider'=>$dataProvider,
		'summaryText' =>'', 
		'htmlOptions' => array('class' => 'grid-view mycv'),
		'columns'=>array(
			array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			),
			array(
				'header' => 'Nama&nbsp;Perusahaan',
				'name' => 'company_name',
				'value'=> '$data->company_name',
				'htmlOptions' => array('class' => 'bold'),
				'type'		=> 'raw'
			),
			'position',
			//'role_date',
			array(
				'header' => 'Tgl&nbsp;Masuk',
				'name' => 'role_date',
				'value'=> '$data->role_date',
				'htmlOptions' => array('class' => 'center'),
				'type'		=> 'raw'
			),
			array(
				'header' => 'Tgl&nbsp;Keluar',
				'name' => 'exit_date',
				'value'=> '$data->exit_date',
				'htmlOptions' => array('class' => 'center'),
				'type'		=> 'raw'
			),
			//'exit_date',
			array(
				'header' => 'Options',
				'class'=>'CButtonColumn',
				'buttons' => array(
					'update' => array(
						'label' => 'Ubah',
						'options' => array(
							'class' => 'update',
							'rel' => '350',
						),
						'click' => 'formUpdate',
						'url' => 'Yii::app()->controller->createUrl("edit",array("id"=>$data->primaryKey))'),
					'delete' => array(
						'label' => 'Hapus',
						'options' => array(
							'class' => 'delete',
							'rel' => '350',
						),
						'click' => 'dialogUpdate',
						'url' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))')
				),
				'template' => '{update}&nbsp;{delete}',
			),
		),
		'pager' => array('header' => '')
	));
}
?>