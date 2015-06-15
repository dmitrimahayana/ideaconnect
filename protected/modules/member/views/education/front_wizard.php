<?php
	/* @var $this JobseekerbioController */
	/* @var $model CcnJobseekerBio */

	$this->pageTitle = 'Pendidikan Wizard';
	$this->breadcrumbs=array();
	$major = Yii::app()->createUrl('college/major/suggestmajor');
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
	$cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/module/member/education_wizard.js', CClientScript::POS_END);
	$selectCityTarget = Yii::app()->createUrl('member/admin/selectcity');
$js = <<<EOP
	$("#CcnJobseekerEdu_major").live("keyup", function(){
		var type = $(this).parents('div[name="post-on"]').attr('id');
		var id = $(this).attr('id');
		$('div[name="post-on"]#'+type).find('input#'+id).autocomplete({'delay':50,'minLength':1,'showAnim':'fold','select':function(event, ui) {
			$('div[name="post-on"]#'+type+' #CcnJobseekerEdu_ccn_major_id').val(ui.item.id);
			},'source':'$major'});
	});
	$('div#hide1').hide();
	$('#CcnJobseekerEdu_province_id').live('change', function(){
                var type = $(this).parents('div[name="post-on"]').attr('id');            
		var id = $(this).val();
		$.ajax({
			url: "$selectCityTarget",
			cache: false,
			data: {'id':id,'model_name':'CcnJobseekerEdu'},
			dataType: 'html',
			type: 'POST',
			success: function(msg){
                                $('div[name="post-on"]#'+type).find('#CcnJobseekerEdu_city_id').html(msg);
                                $('div[name="post-on"]#'+type).find('#hide1').slideDown();
			}
		});
	});
EOP;
	$cs->registerScript('wizard', $js, CClientScript::POS_END);
?>

<div class="boxed">
	<h5><?php echo Yii::t('','Informasikan kepada perusahaan, pendidikan formal apa dan dimana yang pernah Anda tempuh.');?></h5>
	<div class="box">
		<div class="menu">
			<ul>
				<?php
				if($edutab != null) {
					foreach($edutab as $val) {
						if($val->univ_name_id == 1) {
							$title = $val->name_non_univ;
						} else {
							$title = $val->university->name;
						}
						echo '<li name="edu-'.$val->id.'"><a href="'.Yii::app()->controller->createUrl('ajaxwizard',array('id'=>$val->id)).'" title="'.$title.'">'.$title.'</a></li>';
					}
				}
				?>
				<li class="active" name="new"><a href="javascript:void(0);" title="<?php echo Yii::t('','Tambah');?>"><?php echo Yii::t('','Tambah');?></a></li>
			</ul>
			<div class="clear"></div>
		</div>
        
		
		<div id="new" name="post-on">
			<?if(Yii::app()->user->id == 4 && $status == 0){?>
				<h3>Untuk member alumni mohon riwayat pendidikan SMA/Sederajat sudah di isi</h3>
			<?php }?>
			<?php echo $this->renderPartial('_form', array('model'=>$model, 'isEduComplete'=>$isEduComplete)); ?>
		</div>
	</div>
	<a class="more <?php echo $status == 0 ? 'hide' : ''?>" href="<?php echo Yii::app()->controller->createUrl('experience/wizard');?>" title="<?php echo Yii::t('','Langkah Selanjutnya');?>"><?php echo Yii::t('','Langkah Selanjutnya');?></a>
</div>
