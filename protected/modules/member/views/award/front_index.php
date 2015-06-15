<?php
	/* @var $this JobseekerawardController */
	/* @var $model CcnJobseekerAward */

	$this->pageTitle = 'Prestasi';
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
			'award_name',
			'sponsor',
			'year',
			'note',
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
		'pager' => array('header' => ''),
	));
}
?>