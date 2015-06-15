<?php	
	$urlGetContent = Yii::app()->createUrl('menu/ajaxgetlistcontent');
	$urlGetRoles = Yii::app()->createUrl('menu/ajaxgetlistitemroles');
	$urlGetRoles = Yii::app()->createUrl('menu/ajaxgetlistitemrolesmenu');
	$listType = $menuType->group_type == 'back_office' ? 'adminmanage' : 'index';
	$viewType = $menuType->group_type == 'back_office' ? 'adminview' : 'view';
	$menuTypeId = $_GET['tid'];
	$desType = $model->dest_type != null ? $model->dest_type : 0;
	$menuId = $model->id != null ? $model->id : 0;

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	var listType = '$listType';
	var viewType = '$viewType';
	var desType = '$desType';
	var menuTypeId = $menuTypeId;
	var menuId = $menuId;
	if(menuId != 0) {
		$.ajax({
			type: 'get',
			url: '$urlGetRoles',
			data: {'id' : menuId },
			success: function(v) {				
				$('#Menu_roleUser').html(v);
			}		
		});
	}
	
	if(desType != '0')
		showHideDest(desType);

	$('#Menu_name').blur(function(){
		var newVal = $(this).val();
		if(newVal != '') {
			newVal = newVal.toLowerCase().replace(/[^a-z0-9]+/g,'-');
			$('#Menu_alias_url').val(newVal);		
		}	
	});

	$('#Menu_dest_type').change(function(){
		var val = $(this).val();
		if(val != '') {
			showHideDest(val);
		}	
	});
	
	function showHideDest(val) {
		if(val == 'no_link') {
				$('#field_module').hide();
				$('#field_controller').hide();
				$('#field_action').hide();
				$('#field_attr_url').hide();								
				$('#field_item_task').hide();
				
				$('input#Menu_url').val('javascript:void(0);');
				newUrl = 'javascript:void(0);';	
				
			}else if(val == 'module' || val == 'controller_action' ) {
				$('#field_module').show();
				$('#field_controller').show();
				$('#field_action').show();
				$('#field_attr_url').show();
				$('#field_item_task').show();
			}else if(val == 'content_section') {
				$('#field_module').hide();
				$('#field_controller').show();
				$('#field_action').show();
				$('#field_attr_url').show();				
				$('#field_item_task').show();
				
				newUrl = 'content/'+listType+'/sid/' + val;		
			}else if(val == 'content_category') {
				$('#field_module').hide();
				$('#field_controller').show();
				$('#field_action').show();
				$('#field_attr_url').show();				
				$('#field_item_task').show();
			
				newUrl = 'content/'+listType+'/cid/' + val;
			}else if(val == 'content_detil') {
				$('#field_module').hide();
				$('#field_controller').show();
				$('#field_action').show();
				$('#field_attr_url').show();				
				$('#field_item_task').show();
				
				newUrl = 'content/'+viewType+'/' + val;	
			}else if(val == 'contact_detail') {
				$('#field_module').hide();
				$('#field_controller').show();
				$('#field_action').show();
				$('#field_attr_url').show();				
				$('#field_item_task').show();
			
				if(menuTypeId != 1)
					newUrl = 'site/contact';
				else
					newUrl = 'contactdetail/adminedit/1';
			}else if(val == 'external_link') {
				$('#field_module').hide();
				$('#field_controller').hide();
				$('#field_action').hide();
				$('#field_attr_url').hide();								
				$('#field_item_task').hide();
				
			}else {
				$('#field_module').hide();
				$('#field_controller').hide();
				$('#field_action').hide();
				$('#field_attr_url').hide();				
				$('#field_item_task').hide();
				
				$('#field_url').hide();
			}		
		
			$.ajax({
				type: 'post',
				url: '$urlGetContent',
				data: {'dest_type' : val},
				success: function(v) {
					$('#list-content-ajax').show();
					$('#list-content-ajax .desc').html(v);
				}		
			});
	}
	
	$('#Menu_srbac_items_task_name').change(function(){
		var val = $(this).val();
		if(val != '') {
			showRoleUser(val);
		}	
	});
	
	function showRoleUser(val) {
		$.ajax({
			type: 'get',
			url: '$urlGetRoles',
			data: {'task' : val},
			success: function(v) {				
				$('#Menu_roleUser').html(v);
			}		
		});
	}

	$('#list-content-ajax #id_dest input').live('click', function(){
		var val = $(this).val();
		var destType = $('#Menu_dest_type').val();
		var newUrl = baseUrl + '/';
		var attrUrl = [];
		
		if(destType == 'module') {
			var attrUrl = [];
			newUrl = val;			
			$('#Menu_module').val(val);
		}else if(destType == 'content_section') {
			newUrl = 'content/'+listType+'/sid/' + val;	
			var attrUrl = [];
			$('#Menu_controller').val('content');
			$('#Menu_action').val(listType);
			attrUrl.push('sid=' +val);
			$('#Menu_module').val('-');
		}else if(destType == 'content_category') {
			newUrl = 'content/'+listType+'/cid/' + val;
			var attrUrl = [];
			$('#Menu_controller').val('content');
			$('#Menu_action').val(listType);
			attrUrl.push('cid=' +val);
			$('#Menu_module').val('-');
		}else if(destType == 'content_detil') {
			newUrl = 'content/'+viewType+'/' + val;
			var attrUrl = [];
			$('#Menu_controller').val('content');
			$('#Menu_action').val(viewType);
			attrUrl.push('id=' +val);
			$('#Menu_module').val('-');
		}else if(destType == 'contact_detail') {
			var attrUrl = [];
			if(menuTypeId != 1) { //public
				newUrl = 'site/contact';
				$('#Menu_controller').val('site');
				$('#Menu_action').val('contact');
			}else { //admin
				newUrl = 'contactdetail/adminedit/1';
				$('#Menu_controller').val('contactdetail');
				$('#Menu_action').val('adminedit');
				attrUrl.push('id=1');
			}
			$('#Menu_module').val('-');
			
		}
		
		$('#field_attr_url .desc').html('');		
		for(i in attrUrl) {
			var part = attrUrl[i].split('=');
			var attrValue = '<br/><br/>Attribute: <input size="5" value="'+part[0]+'" name="Menu[attr][]" id="Menu_attr" type="text">';
				 attrValue += ' &nbsp; Value: <input value="'+part[1]+'" name="Menu[value][]" id="Menu_value" type="text">';
			$('#field_attr_url .desc').append(attrValue);
		}
		
		$('#Menu_url').val(newUrl);		
		
	});
	
	$('#field_attr_url_button input').live('click', function(){
		var attrvValue = '<br/><br/>Attribute: <input size="5" value="" name="Menu[attr][]" id="Menu_attr" type="text">';
		attrvValue += '  &nbsp; Value: <input value="" name="Menu[value][]" id="Menu_value" type="text">';
		$('#field_attr_url .desc').append(attrvValue);
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js, CClientScript::POS_READY);
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

<fieldset>
	<?php
	if($model->isNewRecord) {
		$model->menu_types_id = $_GET['tid'];
		$model->menu_type = $_GET['Menu']['menu_type'];
		$model->group_pages = $menuType->group_type;
	}
	echo $form->hiddenField($model,'menu_types_id');
	echo $form->hiddenField($model,'menu_type');
	echo $form->hiddenField($model,'group_pages');
	?>
	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'parent'); ?>
		<div class="desc">
			<?php 
			$list = CHtml::listData(Menu::model()->findAll(array(
				'select'=>'id, name', 
				'condition'=>'menu_type=:t AND published=1',
				'params' => array('t'=>$_GET['Menu']['menu_type']),
			)), 'id', 'name');
			?>
			<?php echo $form->dropDownList($model,'parent', $list, array('prompt'=>'No Parent')); ?>
			<?php echo $form->error($model,'parent'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'alias_url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'alias_url',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'alias_url'); ?>
		</div>
		<div class="clear"></div>
	</div>	
	
	<div>
		<?php echo $form->labelEx($model,'dest_type'); ?>
		<div class="desc">
			<?php $list = array(
					'no_link' => 'No link (javascript:void(0);)',
					'controller_action' => 'Controller Action',
					'module' => 'Module',
					'content_section' => 'Content Section',
						'content_category' => '-- Content Category',
							'content_detil' => '--- Content Detail',					
					'external_link' => 'Eksternal Link',
					'wrapper' => 'Wrapper',
					'contact_detail' => 'Contact Detail',
					);
			?>
			<?php echo $form->dropDownList($model,'dest_type', $list, array('prompt'=>'Pillih salah satu')); ?>
			<?php echo $form->error($model,'dest_type'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div class="hide" id="list-content-ajax" style="display:none;">
		<label for="Menu_com_modules_id">&nbsp;</label>
		<div class="desc">
			
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="hide">
		<?php echo $form->labelEx($model,'com_modules_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'com_modules_id'); ?>
			<?php echo $form->error($model,'com_modules_id'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="field_module" class="hide">
		<?php echo $form->labelEx($model,'module'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'module'); ?>
			<?php echo $form->error($model,'module'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div id="field_controller" class="hide">
		<?php echo $form->labelEx($model,'controller'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'controller'); ?>
			<?php echo $form->error($model,'controller'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="field_action" class="hide" >
		<?php echo $form->labelEx($model,'action'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'action'); ?>
			<?php echo $form->error($model,'action'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div id="field_attr_url" class="hide">
		<?php echo $form->labelEx($model,'attr_url'); ?>		
		<div class="desc">
			<?php
			if($model->attr_url != '-') {
				$attrUrl = explode('&', $model->attr_url);
				if(count($attrUrl) > 0) {
					foreach($attrUrl as $val) {
						$part = explode('=', $val);
						echo 'Attribute: '.CHtml::textField('Menu[attr][]', $part[0], array('size'=>5)); 
						echo ' &nbsp; ';
						echo 'Value: '.CHtml::textField('Menu[value][]', $part[1]); 
						echo '<br/><br/>';
					}
				}
			}else {			
				echo 'Attribute: '.CHtml::textField('Menu[attr][]', '', array('size'=>5)); 
				echo ' &nbsp; ';
				echo 'Value: '.CHtml::textField('Menu[value][]', ''); 
			}
			?>
		</div>		
		<div class="clear"></div>
	</div>
	
	<div id="field_attr_url_button" class="hide">
		<label></label>
		<div class="desc">
			<?php echo CHtml::button('Add Attribute'); ?>
		</div>		
		<div class="clear"></div>
	</div>
	
	
	
	<div id="field_url" class="hide">
		<?php echo $form->labelEx($model,'url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'url',array('size'=>60)); ?>
			<?php echo $form->error($model,'url'); ?>
			<div class="small-px silent">Fill with 	{controller}/{action} or {controller}/{action}/{id}/{value}
			<br/> example: site/contact or news/view/id/34</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="hide">
		<?php echo $form->labelEx($model,'template'); ?>
		<div class="desc">
			<?php
			$menuType = MenuTypes::model()->findByPk($_GET['tid']);
			$list = CHtml::listData(Templates::model()->findAll(array(
				'select'=>'template', 
				'condition'=>'group_page=:t',
				'params' => array('t'=>$menuType->group_type),
			)), 'template', 'template');
			/* 	if($model->isNewRecord && $menuType->group_type == 'back_office')
					$model->template = 'sweeto_classic'; */
			?>
			<?php echo $form->dropDownList($model,'template', $list, array('prompt'=>'Template Default')); ?>
			<?php echo $form->error($model,'template'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div  class="hide">
		<?php echo $form->labelEx($model,'layout'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'layout', array('span'=>1,)); ?>
			<?php echo $form->error($model,'layout'); ?>
			<div class="small-px silent">example: default, main</div>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div id="field_item_task" class="hide">
		<?php echo $form->labelEx($model,'srbac_items_task_name'); ?>
		<div class="desc">
			<?php 			
			$arrData =  CHtml::listData(AuthItem::model()->findAllByAttributes(array('type'=>1)), 'name', 'name'); 
			array_unshift($arrData, 'Tidak ada Item');
			?>
			<?php echo $form->dropDownList($model,'srbac_items_task_name', $arrData, array('prompt'=>'Pilih salah satu')); ?>
			<?php echo $form->error($model,'srbac_items_task_name'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'roleUser'); ?>
		<div class="desc">
			<?php 			
			$arrData =  CHtml::listData(UsersGroup::model()->findAll(array('condition'=>'id NOT IN (4,5,6)')), 'id', 'group_name');
			?>
			<?php echo $form->dropDownList($model,'roleUser', $arrData, array('multiple'=>'multiple', 'size'=>'10')); ?>
			<?php echo $form->error($model,'roleUser'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'icon'); ?>
		<div class="desc">
			<?php $model->icon = $model->isNewRecord ? 'dashboard' : $model->icon;	?>
			<?php echo $form->textField($model,'icon'); ?>
			<?php echo $form->error($model,'icon'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div>
		<?php echo $form->labelEx($model,'params'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'params'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'ordering'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ordering',array('size'=>2,'maxlength'=>3)); ?>
			<?php echo $form->error($model,'ordering'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'in_use'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'in_use'); ?>
			<?php echo $form->error($model,'in_use'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'published'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'published'); ?>
			<?php echo $form->error($model,'published'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>
