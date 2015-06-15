<?php
	/* @var $this JobseekerbioController */
	/* @var $model CcnJobseekerBio */

	$this->pageTitle = 'Pengalaman Kerja Wizard';
	$this->breadcrumbs=array();
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
	$cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/module/member/experience_wizard.js', CClientScript::POS_END);
$js = <<<EOP
	$('input#CcnJobseekerExp_still_work').change(function(){
		var checked = $(this).attr('checked');
		if(checked == 'checked') {
			$('fieldset div#current').slideUp();
		} else {
			$('fieldset div#current').slideDown();
		}
	}).change();
EOP;
	$cs->registerScript('wizard', $js, CClientScript::POS_END);
?>

<div class="boxed">
	<h5><?php echo Yii::t('','Informasikan kepada perusahaan, pengalaman pekerjaan yang pernah atau masih Anda miliki.');?></h5>
	<div class="box">
		<div class="menu">
			<ul>
				<?php
				if($exptab != null) {
					foreach($exptab as $val) {
						echo '<li name="exp-'.$val->id.'"><a href="'.Yii::app()->controller->createUrl('ajaxwizard',array('id'=>$val->id)).'" title="'.$val->company_name.'">'.$val->company_name.'</a></li>';
					}
				}
				?>
				<li class="active" name="new"><a href="javascript:void(0);" title="<?php echo Yii::t('','Tambah');?>"><?php echo Yii::t('','Tambah');?></a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="new" name="post-on">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
	<a class="more <?php echo $experience == 1 ? 'hide' : ''?>" href="<?php echo Yii::app()->controller->createUrl('register/finish');?>" title="Selesai">Selesai</a>
</div>
