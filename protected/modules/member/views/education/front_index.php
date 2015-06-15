<?php
	/* @var $this JobseekereduController */
	/* @var $model CcnJobseekerEdu */
	/* @var $form CActiveForm */

	$this->pageTitle = 'Pendidikan';
	$this->breadcrumbs=array();
	$major = Yii::app()->createUrl('college/major/suggestmajor');
	$url = Yii::app()->createUrl('member/education/selectcountry');
	$url2 = Yii::app()->createUrl('member/education/selectcity');
	$cs = Yii::app()->getClientScript();
$js = <<<EOP
	$("#CcnJobseekerEdu_major").live("keyup", function(){
		var type = $(this).parents('div[name="post-on"]').attr('id');
		var id = $(this).attr('id');
		$('div[name="post-on"]#'+type).find('input#'+id).autocomplete({'delay':50,'minLength':1,'showAnim':'fold','select':function(event, ui) {
			$('div[name="post-on"]#'+type+' #CcnJobseekerEdu_ccn_major_id').val(ui.item.id);
			},'source':'$major'});
	});
	$('#CcnJobseekerEdu_country_code').live('change',function(){
		var val = $(this).val();
		$.ajax({
			type: 'get',
			url: '$url',
			data: {'country':val},
			dataType: 'json',
			success: function(v) {
				$('#CcnJobseekerEdu_province_id').html(v.province);
				$('#CcnJobseekerEdu_city_id').html(v.city);
			}
		});
	});
	$('#CcnJobseekerEdu_province_id').live('change',function(){
		var idProv = $(this).val();
		$.ajax({
			type: 'get',
			url: '$url2',
			data: {'province':idProv},
			dataType: 'json',
			success: function(v) {
				$('#CcnJobseekerEdu_city_id').html(v.city);
			}
		});
	});
EOP;
	$cs->registerScript('mycv', $js, CClientScript::POS_END);
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
			'degree',
			array(
				'header' => 'Nama PT/Sekolah',
				'value' => '$data->univ_name_id == 1 ? $data->name_non_univ : $data->university->name',
			),
			'role_year',
			'finish_year',
			
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