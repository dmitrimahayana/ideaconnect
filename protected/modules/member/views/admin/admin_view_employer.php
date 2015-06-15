<?php
	/* @var $this AdminController */
	/* @var $model CcnUsers */

	$this->pageTitle = 'Employer Detail';
	$this->breadcrumbs=array(
		'Kelola Member Employer'=>array('adminmanage','gid'=>$_GET['gid']),
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

<div class="boxed">
	<h3>Lihat Profil Perusahaan</h3>
	<?php
	$logoUrl =  Yii::app()->request->baseUrl.'/images/member_upload/employer/small/';
	$this->widget('application.components.system.BDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'label' => 'Nama Perusahaan',
				'value' => $model->name
			),
			array(
				'label'	=> 'Logo Perusahaan',
				'type'	=> 'image',
				'value'	=> $model->company_logo ? $logoUrl.'small_'.$model->company_logo : $logoUrl.'employer_default.png'
			),
			array(
				'label'	=> 'Deskripsi Perusahaan',
				'value'	=> $model->company_desc
			),
			array(
				'label'	=> 'Bidang Industri',
				'value'	=> $model->employer_industry->name
			),
			array(
				'label'	=> 'Alamat',
				'value'	=> $model->address.', '.$model->city->name.', '.$model->province->name.', '.$model->country->name.' '.$model->postal_code
			),
			array(
				'label'	=> 'Email',
				'value'	=> $model->users->email
			),
			array(
				'label'	=> 'No. Telepon',
				'value'	=> $model->phone_no1.', '.$model->phone_no2
			),
			array(
				'label'	=> 'Faksimili',
				'value'	=> $model->fax ? $model->fax : '-'
			),
			array(
				'label'	=> 'Website',
				'value'	=> $model->website ? $model->website : '-'
			),
			array(
				'label' => 'Contact Person',
				'value'	=> $model->contact_person
			),
			array(
				'label' => 'Alamat CP',
				'value'	=> $model->cp_address.', '.$model->cpCity->name.', '.$model->cpProvince->name.', '.$model->cpCountryCode->name.' '.$model->cp_postal_code
			),
			array(
				'label' => 'No. Telepon',
				'value'	=> $model->cp_phone ? $model->cp_phone : '-'
			),
			array(
				'label' => 'No. Handphone',
				'value'	=> $model->cp_mobile ? $model->cp_mobile : '-'
			),
		),
	));  ?>
</div>
