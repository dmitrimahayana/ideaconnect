<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul class="clearfix">
		<li class="title">Informasi Umum</li>
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('typeMember'); ?></label>
			<div><?php 
			$arrayData = array(''=>'Pilih Salah Satu', '4'=>'Jobseeker Alumni', '5'=>'Jobseeker');
			echo $form->dropDownlist($modelAdvanceSearch,'typeMember',$arrayData); ?></div>
		</li>

		<li>
			<label>Rentang Tanggal Gabung</label>
			<div><?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'attribute'=>'fromJoinDate',
				'model' => $modelAdvanceSearch,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeYear' => true,
					'changeMonth' => true,
					'dateFormat' => 'dd-mm-yy',
					'yearRange' => '2007:'  . (date('Y')+1),
				),
				'htmlOptions'=>array(
					'class' => 'span-5',
				),
				));
			?>
			s/d
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'attribute'=>'untilJoinDate',
				'model' => $modelAdvanceSearch,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeYear' => true,
					'changeMonth' => true,
					'dateFormat' => 'dd-mm-yy',
					'yearRange' => '2007:'  . (date('Y')+1),
				),
				'htmlOptions'=>array(
					'class' => 'span-5',
				),
				));
			?></div>
		</li>
		<div class="clear border"></div>
		<li>
			<label>Waktu Approval</label>
			<div><?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'attribute'=>'startApproval',
				'model' => $modelAdvanceSearch,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeYear' => true,
					'changeMonth' => true,
					'dateFormat' => 'dd-mm-yy',
					'yearRange' => '2007:'  . (date('Y')+1),
				),
				'htmlOptions'=>array(
					'class' => 'span-5',
				),
				));
			?>
			s/d
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'attribute'=>'endApproval',
				'model' => $modelAdvanceSearch,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'changeYear' => true,
					'changeMonth' => true,
					'dateFormat' => 'dd-mm-yy',
					'yearRange' => '2007:'  . (date('Y')+1),
				),
				'htmlOptions'=>array(
					'class' => 'span-5',
				),
				));
			?></div>
		</li>
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('statusUser'); ?></label>
			<div><?php 
			$arrayStatusUser = array(
				''=>'Pilih Salah Satu', 
				'0'=>'After register', 
				'1'=>'Active email',
				'2'=> 'Payment', 
				'3'=> 'Approval admin', 
				'4' => 'Fill biodata cv', 
				'5'=> 'Fill education cv',
			);
			echo $form->dropDownlist($modelAdvanceSearch,'statusUser',$arrayStatusUser); ?></div>
		</li>

		<div class="clear"></div>
		<li class="title">Informasi Personal</li>

		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('birthPlace'); ?></label>
			<div><?php echo $form->textField($modelAdvanceSearch,'birthPlace',array('maxlength'=>15,'class'=>'span-7')); ?></div>
		</li>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('sex'); ?></label>
			<div><?php 
			$arraySex = array('Pria'=>'Pria','Wanita'=>'Wanita');
			echo $form->checkBoxList($modelAdvanceSearch,'sex',$arraySex); ?></div>
		</li>
		<div class="clear border"></div>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('originAddress'); ?></label>
			<div><?php echo $form->textArea($modelAdvanceSearch,'originAddress',array('maxlength'=>15,'class'=>'span-9 smaller')); ?></div>
		</li>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('status'); ?></label>
			<div><?php 
			$arrayData = array('menikah'=>'Menikah', 'lajang'=>'Lajang', 'janda'=>'Janda/Duda');
			echo $form->checkBoxList($modelAdvanceSearch,'status',$arrayData); ?></div>
		</li>
		<div class="clear border"></div>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('address'); ?></label>
			<div><?php echo $form->textArea($modelAdvanceSearch,'address',array('maxlength'=>15,'class'=>'span-9 smaller')); ?></div>
		</li>

		<div class="clear"></div>
		<li class="title">Informasi Pendidikan</li>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('degree'); ?></label>
			<div><?php 
			$arrayEdu = array('D3'=>'D3', 'S1'=>'S1', 'S2'=>'S2');
			echo $form->checkBoxList($modelAdvanceSearch,'degree',$arrayEdu); ?></div>
		</li>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('university'); ?></label>
			<div><?php //php echo $form->textField($modelAdvanceSearch,'university',array('maxlength'=>15,'class'=>'span-7')); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $modelAdvanceSearch,
				'attribute' => 'university',
				'source'=>$this->createUrl('/member/admin/suggestuniversity'),
				'options'=>array(
					'delay'=>50,
					'minLength'=>1,
					'showAnim'=>'fold',
					'select'=>"js:function(event, ui) {
						$('#CcnJobseekerEdu_ccn_major_id').val(ui.item.id);
					}"
				),
				'htmlOptions'=>array(
					'class'	=> 'span-6',
				),
			)); 	?>
			</div>
		</li>
		<div class="clear border"></div>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('enterYear'); ?></label>
			<div><?php echo $form->textField($modelAdvanceSearch,'enterYear',array('maxlength'=>15 ,'class'=>'span-4')); ?>
			s/d
			<?php echo $form->textField($modelAdvanceSearch,'exitYear',array('maxlength'=>15 ,'class'=>'span-4')); ?></div>
		</li>		
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('fromOutDate'); ?></label>
			<div><?php echo $form->textField($modelAdvanceSearch,'fromOutDate',array('maxlength'=>15 ,'class'=>'span-4')); ?>
			s/d
			<?php echo $form->textField($modelAdvanceSearch,'untilOutDate',array('maxlength'=>15 ,'class'=>'span-4')); ?></div>
		</li>
		
		<div class="clear border"></div>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('ipkStart'); ?></label>
			<div><?php echo $form->textField($modelAdvanceSearch,'ipkStart',array('maxlength'=>15,'class'=>'span-3')); ?> s/d
			<?php echo $form->textField($modelAdvanceSearch,'ipkEnd',array('maxlength'=>15,'class'=>'span-3')); ?>
			</div>
		</li>
		
		<li>
			<label><?php echo $modelAdvanceSearch->getAttributeLabel('major'); ?></label>
			<div><?php //php echo $form->textField($modelAdvanceSearch,'university',array('maxlength'=>15,'class'=>'span-7')); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $modelAdvanceSearch,
				'attribute' => 'major',
				'source'=>$this->createUrl('/college/major/suggestmajor'),
				'options'=>array(
					'delay'=>50,
					'minLength'=>1,
					'showAnim'=>'fold',
					'select'=>"js:function(event, ui) {
						
					}"
				),
				'htmlOptions'=>array(
					'class'	=> 'span-6',
				),
			)); 	?>
			</div>
		</li>
		<div class="clear border"></div>


		<div class="clear"></div>
		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>
