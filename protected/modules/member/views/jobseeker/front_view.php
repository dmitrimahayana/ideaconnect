<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */

	$this->pageTitle = 'Jobseeker CV';
	$this->breadcrumbs=array();
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/member/member_jobseeker.css');
?>

<?php if(!isset($_GET['id'])) {?>
<a href="<?php echo Yii::app()->controller->createUrl('printcv'); ?>"><h1 class="jobseeker mycv">myCV</h1></a>
<div class="clear"></div>
<?php }else{?>
<h1 align="right"><a href="<?php echo Yii::app()->createUrl('member/employer/jobseekerpdf',array('id'=>$_GET['id'])); ?>">download pdf</a></h1>
<div class="clear"></div>
<?php } ?>

<div class="mycv">
   <?php /*
	<div class="boxed">
		<h3 class="rockwell">
			Akun
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array(
						'name'=> 'photo',
						'value'=> '<img src="'.Yii::app()->request->baseUrl.'/images/member_upload/jobseeker/medium/medium_'.$model->photo.'">',
						'type'=>'raw'					
					),
					'username',
					'email',
				),
			)); ?>
		</div>
	</div>
	*/?>

	<?php if($biodata != null) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('biodata/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Data Diri
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FDetailView', array(
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
					'status',
					'child',
				),
			)); ?>
		</div>
	</div>
	<?php }?>

	<?php if($education->getTotalItemCount() != 0 ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('education/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Pendidikan
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FGridView', array(
				'dataProvider'=>$education,
				'summaryText' =>'', 
				'columns'=>array(
					'degree',
					array(
						'header'	=> 'Sekolah/Universitas',
						'value'		=> '$data->univ_name_id == 1 ? ($data->degree == "SMA" ? $data->name_non_univ : $data->name_non_univ." <span class=\"red\"> *Universias belum standar</span>") : $data->university->name',
						'type'		=> 'html'
					),
					//'university.name',
					//'name_non_univ',
					'city.name',
					array(
						'name'	=> 'major',
						'value'	=> '$data->degree != "SMA" ? ($data->ccn_major_id == 1 ? $data->suggest_major." <span class=\"red\"> *Jurusan belum standar</span>" : $data->major->name) : ""',
						'type'	=> 'html'
					),
					//'major.name',
					'submajor',
					'thesis_title',
					'ipk',
					'role_year',
					'finish_year',
				),
			)); ?>
		</div>
	</div>
	<?php }?>

	<?php if($experience->getTotalItemCount() != 0 ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('experience/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Pengalaman Kerja
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FGridView', array(
				'dataProvider'=>$experience,
				'summaryText' =>'',
				'columns'=>array(
					array(
						'header'=>'Tahun',
						'value'=>'substr($data->role_date, -4)." - ".substr($data->exit_date,-4)',
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
	</div>
	<?php }?>

	<?php if ($organization->getTotalItemCount() != 0 ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('organization/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Organisasi
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FGridView', array(
				'dataProvider'=>$organization,
				'summaryText' =>'', 
				'columns'=>array(
					array(
						'name'=>'start_date',
						'value'=>'date("d-m-Y",strtotime($data->start_date))',
					),
					array(
						'name'=>'finish_date',
						'value'=>'$data->active == 1? \'Masih Aktif\' : date("d-m-Y",strtotime($data->finish_date))',
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
	</div>
	<?php }?>

	<?php if ($skill != null ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('skill/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Skill
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FDetailView', array(
				'data'=>$skill,
				'attributes'=>array(
					'technical_skill',
					'non_technical_skill',
					'computer_skill',
					'other',
				),
			)); ?>
		</div>
	</div>
	<?php }?>

	<?php if ($training->getTotalItemCount() != 0 ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('training/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Pelatihan
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FGridView', array(
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
	</div>
	<?php }?>

	<?php if ($toefl != null ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('toefl/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Toefl
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FDetailView', array(
				'data'=>$toefl,
				'attributes'=>array(
					'toefl_score',
					'ielts_score',
					'toefl_years',
					'ielts_years',
				),
			)); ?>
		</div>
	</div>
	<?php }?>

	<?php if ($positif != null ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('positive/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Kelebihan Dan Kekurangan
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FDetailView', array(
				'data'=>$positif,
				'attributes'=>array(
					'positive',
					'negative',
				),
			)); ?>
		</div>
	</div>
	<?php }?>

	<?php if ($reference != null ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('reference/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Referensi
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FDetailView', array(
				'data'=>$reference,
				'attributes'=>array(
					'name',
					'position',
					'phone',
					'address',
					//'contactable' ,
					array(
						'name'=>'contactable',
						'value'=> $data->contactable != '1' ? 'ya':'tidak',
						'type'=>'raw',
					),
				),
			)); ?>
		</div>
	</div>
	<?php }?>

	<?php if ($award->getTotalItemCount() != 0 ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('award/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Penghargaan
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FGridView', array(
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
	</div>
	<?php }?>

	<?php if ($language->getTotalItemCount() != 0 ) {?>
	<div class="boxed">
		<h3 class="rockwell">
			<?php if(!isset($_GET['id'])) {?><a href="<?php echo Yii::app()->controller->createUrl('language/index'); ?>" title="Ubah">Ubah</a><?php }?>
			Bahasa
		</h3>
		<div class="box">
			<?php $this->widget('application.components.system.FGridView', array(
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
	</div>
	<?php }?>
	
    <?php if($_GET['id'] != null){?>
    	<a class="Download CV" href="<?php echo Yii::app()->createUrl('member/employer/jobseekerpdf', array('id'=>$_GET['id']));?>" title="Rekap">Download CV</a>	
    <?php }else{ ?>   
    	<a class="Download CV" href="<?php echo Yii::app()->createUrl('member/jobseeker/printcv');?>" title="Rekap">Download CV</a>
    <?php } ?>
    

</div>
