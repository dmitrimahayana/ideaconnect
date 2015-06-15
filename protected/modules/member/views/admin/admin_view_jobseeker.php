<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */

	$this->pageTitle = 'Jobseeker Detail';
	$this->breadcrumbs=array(
		'Pcr Users'=>array('index'),
		$model->name,
	);
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

<img src="<?php echo Yii::app()->baseUrl; ?>/images/member_upload/jobseeker/medium/medium_<?php echo $model->photo;?>" width="120" />

<div class="boxed">
	<h3>Akun</h3>
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			//'name',
			//'username',
			//'photo',
			//'jobseeker_bio1.complete_name',
			'email',
			'mobile_no',
		),
	));  ?>
</div>

<?php if($biodata != null) {?>
<div class="boxed">
	<h3>Data Diri</h3>
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$biodata,
		'attributes'=>array(
			'complete_name',
			'address',
			'city.name',
			'province.name',
			'post_code',
			'house_phone',
			'mobile_phone',
			'mobile_phone2',
			'birth_place',
			'birth_date',
			'sex',
			'religion',
			'homepage',
			'origin_address',
			'origin_city.name',
			'origin_province.name',
			'hobby',
			'photo',
			'status',
			'child',
		),
	)); ?>
</div>
<?php }?>

<?php if($education->getTotalItemCount() != 0 ) {?>
<div class="boxed">
	<h3>Pendidikan</h3>
	<?php $this->widget('application.components.system.BGridView', array(
		'dataProvider'=>$education,
		'summaryText' =>'', 
		'columns'=>array(
			'degree',
			'university.name',
			'name_non_univ',
			'city.name',
			'major.name',
			'submajor',
			'thesis_title',
			'ipk',
			'role_year',
			'finish_year',
			/*'name_non_univ',
			'university.name',
			'role_date',
			'finish_date',
			'major.name',
			'submajor',
			'degree',
			'thesis_title',
			'ipk',
			'acreditation',
			'city.name',
			'country.name',
			'last_edu',
			array(
				'name' => 'last_edu',
				'value' => CcnJobseekerEdu::model()->getEducationStep($dataProvider1->last_edu)
			),
			'role_month',
			'role_year',
			'finish_month',
			'finish_year',*/
		),
	)); ?>
</div>
<?php }?>

<?php if($experience->getTotalItemCount() != 0 ) {?>
<div class="boxed">
	<h3>Pengalaman Kerja</h3>
	<?php $this->widget('application.components.system.BGridView', array(
		'dataProvider'=>$experience,
		'summaryText' =>'',
		'columns'=>array(
			/*'role_date',
			'exit_date',
			'company_name',
			'position',
			'job_desc',
			'last_salary',
			'title',
			'function',
			'industry',
			'still_work',
			'last_exp',
			'job_type',*/
			array(
				'header'=>'Tahun',
				'value'=>'substr($data->role_date,-4)." - ".substr($data->exit_date,-4)',
			),
			'company_name',
			array(
				'name'=>'company_scale',
				'value'=>'CcnJobseekerExp::getCompanyScale($data->company_scale)'
			),
			'position',
			//'job_desc',
			//'title',
			array(
				'name'=>'title',
				'value'=>'CcnJobseekerExp::getTitle($data->title)'
			),
			array(
				'name'=>'function',
				'value'=>'CcnFunctionVacancy::model()->findByPk($data->function)->name'
			),
			array(
				'name'=>'industry',
				'value'=>'CcnEmployerIndustry::model()->findByPk($data->industry)->name'
			),
			array(
				'name'=>'still_work',
				'value'=>'($data->still_work == 1) ? ya : tidak'
			),
			//'job_type',
			array(
				'name'=>'job_type',
				'value'=>'($data->job_type == 1) ? "Full Time" : "Part Time"'
			),	
		),
	)); ?>
</div>
<?php }?>

<?php if ($organization->getTotalItemCount() != 0 ) {?>
<div class="boxed">
	<h3>Organisasi</h3>
	<?php $this->widget('application.components.system.BGridView', array(
		'dataProvider'=>$organization,
		'summaryText' =>'', 
		'columns'=>array(
			/*'org_name',
			'start_date',
			'finish_date',
			'position',
			'description',
			'active',
			'swt_users_id',*/
			array(
				'name'=>'start_date',
				'value'=>'date("d-m-Y",strtotime($data->start_date))',
			),
			array(
				'name'=>'finish_date',
				'value'=>'date("d-m-Y",strtotime($data->finish_date))',
			),
			'org_name',
			'position',
			'description',
			array(
				'name'=>'active',
				'value'=> '($data->active == 1)? ya : tidak'
			),
		),
	)); ?>
</div>
<?php }?>

<?php if ($skill != null ) {?>
<div class="boxed">
	<h3>Skill</h3>
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$skill,
		'attributes'=>array(
			'technical_skill',
			'non_technical_skill',
			'computer_skill',
			'other',
		),
	)); ?>
</div>
<?php }?>

<?php if ($training->getTotalItemCount() != 0 ) {?>
<div class="boxed">
	<h3>Pelatihan</h3>
	<?php $this->widget('application.components.system.BGridView', array(
		'dataProvider'=>$training,
		'summaryText' =>'',
		'columns'=>array(
			'name',
			'training_time',
			'organizer',
			array(
				'name'=>'certificate',
				'value'=> '($data->certificate == 1)? ya : tidak'
			),
		),
	)); ?>
</div>
<?php }?>

<?php if ($toefl != null ) {?>
<div class="boxed">
	<h3>Toefl</h3>
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$toefl,
		'attributes'=>array(
			'toefl_score',
			'ielts_score',
			'toefl_years',
			'ielts_years',
		),
	)); ?>
</div>
<?php }?>

<?php if ($positif != null ) {?>
<div class="boxed">
	<h3>Kelebihan Dan Kekurangan</h3>
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$positif,
		'attributes'=>array(
			'positive',
			'negative',
		),
	)); ?>
</div>
<?php }?>

<?php if ($reference != null ) {?>
<div class="boxed">
	<h3>Referensi</h3>
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$reference,
		'attributes'=>array(
			'name',
			'position',
			'phone',
			'address',
			array(
				'name'=>'contactable',
				'value'=> $data->contactable != '1' ? 'ya':'tidak',
				'type'=>'raw',
			),
		),
	)); ?>
</div>
<?php }?>

<?php if ($award->getTotalItemCount() != 0 ) {?>
<div class="boxed">
	<h3>Penghargaan</h3>
	<?php $this->widget('application.components.system.BGridView', array(
		'dataProvider'=>$award,
		'summaryText' =>'',
		'columns'=>array(
			'award_name',
			'sponsor',
			'year',
			'note',
		),
	)); ?>
</div>
<?php }?>

<?php if ($language->getTotalItemCount() != 0 ) {?>
<div class="boxed">
	<h3>Bahasa</h3>
	<?php $this->widget('application.components.system.BGridView', array(
		'dataProvider'=>$language,
		'summaryText' =>'',
		'columns'=>array(
			'lang_name',
			array(
				'name'=>'ability',
				'value'=>'CcnJobseekerLang::getAbility($data->ability)'
			),	
		),
	)); ?>
</div>
<?php }?>
