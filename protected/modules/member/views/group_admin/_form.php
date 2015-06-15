<?php
/* @var $this GroupadminController */
/* @var $model CcnGroupAdmin */
/* @var $form CActiveForm */

	$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$cs = Yii::app()->getClientScript();
$js = <<<EOP
	$('#CcnConfirm_procedure').change(function(){
		var id = $(this).val();
		if(id == 1  ) {
			$('fieldset .hide').slideUp();
		} else {
			if(id == 2) {
				$('fieldset #hide1').slideDown();
				$('fieldset #hide'+ id).slideDown();
				$('fieldset #hide3').slideUp();
			} else {
				$('fieldset .hide').slideDown();
			}
		}
	});
	
	$('#ccn-group-admin-form input[type=checkbox]').click(function(){
		if ($(this).is(':checked')) {
			$(this).parent('li').find('input[type=checkbox]').attr('checked', 'checked');			
			$(this).parent('li').parent('ul').parent('li').find('input[type=checkbox]').first().attr('checked', 'checked').
			parent('li').parent('ul').parent('li').find('input[type=checkbox]').first().attr('checked', 'checked');			
		}else
			$(this).parent('li').find('input[type=checkbox]').removeAttr('checked');	
	});
	
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-group-admin-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
<?php /* <div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content"> */?>

	<fieldset>
		<div  class="clearfix">
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('maxlength'=>50,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'name'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
		
	<?php /* 	<div class="clearfix">
			<?php echo $form->labelEx($model,'group_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'group_name',array('maxlength'=>30,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'group_name'); ?>
			</div>
		</div> */?>

		<div class="clearfix">
			<label>Hak Akses Menu Backoffice<span class="required">*</span></label>
			<div class="desc">
				<?php		
					//set menu checked
					$arrMenuAuth = array();
					if(!$model->isNewRecord) {
						$menuAuth = MenuAuth::model()->findAll(array(
							'select' => 'swt_menu_id',
							'condition' => 'swt_users_group_id = :g',
							'params' => array(':g'=>$model->id)
						));
						if($menuAuth != null) {
							foreach($menuAuth as $val) {
								$arrMenuAuth[] = $val->swt_menu_id;
							}
						}
					}else
						$arrMenuAuth = $model->arrMenu;
				
					//print all menu 
					$menus = Menu::model()->findAll(array(
						'condition' => 'group_pages = :g and published = 1 and in_use = 1 and parent = 0',
						'params' => array(':g'=>'back_office')
					));
					if($menus != null) {
						echo '<ul class="clearfix">';
						foreach($menus as $val) { ?>
							<li>
								<?php 
									$checked = $val->id == 2 ? true: (in_array($val->id, $arrMenuAuth) ? true: false);								
									echo CHtml::checkBox('CcnGroupAdmin[arrMenu][]', $checked, array('maxlength'=>50, 'value'=>$val->id)); ?>
								<?php echo '<strong>'.$val->name.'</strong>'; ?>
								
								<?php
									$subMenu = Menu::model()->findAll(array(
										'condition' => 'group_pages = :g and published = 1 and in_use = 1 and parent = :p',
										'params' => array(':g'=>'back_office', ':p'=>$val->id)
									));
																		
									if($subMenu != null) {
										echo '<ul class="clearfix">';
										foreach($subMenu as $item) {
											$checkedSubMenu = in_array($item->id, $arrMenuAuth) ? true: false;			
											echo '<li>'. CHtml::checkBox('CcnGroupAdmin[arrMenu][]', $checkedSubMenu, array('maxlength'=>50, 'value'=>$item->id)).' ' ;
											echo $item->name;
											
												$sub2Menu = Menu::model()->findAll(array(
													'condition' => 'group_pages = :g and published = 1 and in_use = 1 and parent = :p',
													'params' => array(':g'=>'back_office', ':p'=>$item->id)
												));
																					
												if($sub2Menu != null) {
													echo '<ul>';
													foreach($sub2Menu as $item2) {
														$checkedSub2Menu = in_array($item2->id, $arrMenuAuth) ? true: false;			
														echo '<li>'. CHtml::checkBox('CcnGroupAdmin[arrMenu][]', $checkedSub2Menu, array('maxlength'=>50, 'value'=>$item2->id)).' ' ;
														echo $item2->name.'</li>';
													}
													echo '</ul>';
												}
											
											echo '</li>';
										}
										echo '</ul>';
									}
								?>									
							</li>
				<?php 
						}
						echo '</ul>';
					}
				?>
			</div>
		</div>
		<div class="submit clearfix">
			<label></label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan')); ?>
				<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed', 'onclick' => "document.location.href='".Yii::app()->createUrl('member/groupadmin/adminmanage')."'")); ?>
			</div>
		</div>
	</fieldset>
</div>

<?php $this->endWidget(); ?>

