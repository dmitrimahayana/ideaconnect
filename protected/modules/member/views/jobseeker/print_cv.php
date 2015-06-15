<?php
$this->layout = 'jobseeker';
$this->pageTitle = "Print CV | " . Yii::app()->name;

$this->breadcrumbs = array(
	'Headquarter' => Yii::app()->createUrl('jobseeker/index'),
	'Print CV - '.$model->users->jobseeker_bio->complete_name,
);

$js=<<<EOP
	// Print mv-CV Link
	$('.m-download').click(function(){
		$('#printcv').dialog('open');
		$('#templateCV').val($(this).attr('href'));
		return false;
	});

	// Print mv-CV Dialog
	$('#printcv').dialog({
		autoOpen: false,
		width: 400,
		bgiframe: true,
		modal: true,
		buttons: {
			"Batal": function() { 
				$(this).dialog("close"); 
			}, 
			"Lanjutkan": function() {				 
				$('#form-printcv').submit();
				$(this).dialog("close");
			}
		}
	});
EOP;
//				window.location = "?r=jobseeker/printcv";
$cs = Yii::app()->getClientScript();
$ukey = md5(uniqid(mt_rand(), true));
$cs->registerScript($ukey, $js, CClientScript::POS_READY);
?>

<span class="logo-jobs-cv"></span>

   <?php
		//$this->widget('JobseekerSidebar');
	?>

<!-- Content (Template my-CV) -->
<div class="span-18 last">
	<table class="m-jobseeker">
		<thead>
			<tr>
				<th colspan="3">Pilih template CV Anda</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<a class="block" href="javascript:void(0)"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/my_cv/temp_001.jpg" title=""/></a>
					<a class="m-download ui-corner-all" href="1">Download (PDF)</a>
				</td>
				<td>
					<a class="block" href="javascript:void(0)"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/my_cv/temp_002.jpg" title=""/></a>
					<a class="m-download ui-corner-all" href="2" target="_blank">Download (PDF)</a>
				</td>
				<td class="m-right">
					<a class="block" href="javascript:void(0)"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/my_cv/temp_003.jpg" title=""/></a>
					<a class="m-download ui-corner-all" href="3" target="_blank">Download (PDF)</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
	<div id="printcv" title="Print my-CV: <?php echo $model->jobsbio->nama_lengkap?>">
	<?php
    $form = $this->beginWidget('CActiveForm', array(
      'action' => Yii::app()->createUrl('member/jobseeker/temp001'),
      'id' => 'form-printcv',
      'htmlOptions' => array(
          'class' => 'pad-clear',
          'name' => 'form',
		  'target' => '_blank'
      )
      ));
    ?>
    <div class="printcv">
        <div class="mb-10">Pilih informasi tentang diri anda yang ingin dicetak:</div>
        	<?php echo CHtml::hiddenField('template', '1', array('id' => 'templateCV'))?>
			<?php echo $form->checkBox($dialog, 'dataDiri', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('dataDiri')?><br />
            <?php echo $form->checkBox($dialog, 'pendidikanFormal', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('pendidikanFormal')?><br />
            <?php echo $form->checkBox($dialog, 'pendidikanNonFormal', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('pendidikanNonFormal')?><br />
            <?php echo $form->checkBox($dialog, 'organisasi', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('organisasi')?><br />
            <?php echo $form->checkBox($dialog, 'bahasaAsing', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('bahasaAsing')?><br />
            <?php /* 
			<?php if(Yii::app()->user->member_type == 'reguler') { ?>
				<?php echo $form->checkBox($dialog, 'pengalamanKerja', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('pengalamanKerja')?><br />
            <?php }else { ?>
				<?php echo $form->checkBox($dialog, 'pengalamanKerja', array('unchecked' => 'unchecked', 'hidden'=>'hidden'))?>
			<?php }?>
			*/ ?>
			<?php echo $form->checkBox($dialog, 'kelebihanDiri', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('kelebihanDiri')?><br />
            <?php echo $form->checkBox($dialog, 'rekomendasi', array('checked' => 'checked'))?><?php echo $dialog->getAttributeLabel('rekomendasi')?>
            <br />
            <label>Pilih bahasa:&nbsp;</label>
            <?php
			$bahasa = array('id' => 'Indonesia', 'en' => 'Inggris');
			echo CHtml::dropDownList('bahasa', 'id', $bahasa);
			?>
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('tabindex'=>15)); ?>
    	</div>
    <?php $this->endWidget(); ?>
	</div>