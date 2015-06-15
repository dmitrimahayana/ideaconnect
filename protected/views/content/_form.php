<?php
	$listType = $menuType->group_type == 'back_office' ? 'adminmanage' : 'index';
	$viewType = $menuType->group_type == 'back_office' ? 'adminview' : 'view';

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	var listType = '$listType';
	var viewType = '$viewType';

	$('#Content_title').blur(function(){
		var newVal = $(this).val();
            newVal = $.trim(newVal);
		if(newVal != '') {
			newVal = newVal.toLowerCase().replace(/[^a-z0-9]+/g,'-');
			$('#Content_alias_url').val(newVal);
		}
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js, CClientScript::POS_READY);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
)); ?>
	<fieldset>
		<?php 
		//echo $_GET['sid'];echo '<br>';
		if(isset($_GET['sid']))
			$arrPar = ContentSection::model()->getParams($_GET['sid'], '#INPUT-FIELD#', '#END-INPUT-FORM#');
		else if(isset($_GET['cid']))
			$arrPar = ContentCategories::model()->getParams($_GET['cid'], '#INPUT-FIELD#', '#END-INPUT-FORM#');
		$admSwt = Yii::app()->user->id; // admin sweeto
		//print_r($arrPar);
		?>

		<?php if(isset($_GET['sid'])) {?>
			<?php if($admSwt == 1 || ($arrPar['content_categories_id'] == 1 && $model->section_id != 1) ) { ?>
			<div>
				<?php echo $form->labelEx($model,'content_categories_id'); ?>
				<div class="desc">
					<?php
					$section = Yii::app()->user->id != 1 ? 'AND content_section_id <> 1':'';
					$listData = CHtml::listData(ContentCategories::model()->findAll(array(
						'condition'=>'published =1 ' . $section,
						'order' => 'content_section_id'
						)), 'id','title'); ?>
					<?php			
					echo $form->dropDownList($model,'content_categories_id', $listData, array('prompt'=>Yii::t('', 'Choose One'))); 
					$model->getCategory = 'sid='.$_GET['sid'];
					?>
					<?php echo $form->error($model,'content_categories_id'); ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php }?>
		<?php } elseif(isset($_GET['cid'])) {
			if($model->isNewRecord) {
				$model->content_categories_id = $_GET['cid'];
			}
			echo $form->hiddenField($model,'content_categories_id'); 
			$model->getCategory = 'cid='.$_GET['cid'];				
		}
		echo $form->hiddenField($model,'getCategory'); 
		?>

		<?php if($admSwt == 1 ||  ($arrPar['parent_id'] == 1  && $model->section_id != 1) ) {?>
		<div>
			<?php echo $form->labelEx($model,'parent_id'); ?>
			<div class="desc">
				<?php $listData = CHtml::listData(Content::model()->findAll(array(
					'condition'=>'section_id <> 1 AND published = 1')), 'id','title'); ?>
				<?php echo $form->dropDownList($model,'parent_id', $listData, array('prompt'=>Yii::t('', 'No Parent'))); ?>
				<?php echo $form->error($model,'parent_id'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>

		<?php if($admSwt == 1 ||  $arrPar['title'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'title'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'title',array('maxlength'=>80,'class'=>'span-10')); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 ||  $arrPar['alias_url'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'alias_url'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'alias_url',array('maxlength'=>200,'class'=>'span-10')); ?>
				<?php echo $form->error($model,'alias_url'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 ||  $arrPar['intro_text'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'intro_text'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'intro_text',array('rows'=>6, 'cols'=>165,'class'=>'span-8')); ?>
				<?php echo $form->error($model,'intro_text'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 || $arrPar['full_text'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'full_text'); ?>
			<div class="desc">
				<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget', array(
					'model' => $model,
					"attribute" => 'full_text',
					"height"=>'420px',
					"width"=>'100%',
					"toolbarSet" => 'Custom',
					"fckeditor" => Yii::app()->basePath."/../fckeditor/fckeditor.php",
					//"fckeditor" => $basPa . "/fckeditor/fckeditor.php",
					"fckBasePath" => Yii::app()->baseUrl."/fckeditor/",
					'config' => array(
						'EnterMode' => 'br',
						'SkinPath' => Yii::app()->baseUrl. '/fckeditor/editor/skins/office2003/',
						'CustomConfigurationsPath' => Yii::app()->baseUrl."/fckeditor/custom.js",
						//'UserFilesPath' => $defaultNewsDir,
					),
				)); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 || $arrPar['meta_key'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'meta_key'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'meta_key',array('class'=>'span-8')); ?>
				<?php echo $form->error($model,'meta_key'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 || $arrPar['meta_desc'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'meta_desc'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'meta_desc',array('class'=>'span-8')); ?>
				<?php echo $form->error($model,'meta_desc'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 || $arrPar['images'] == 1) {?>
			<?php if(!$model->isNewRecord) {
				$model->oldImage = $model->images;
				echo $form->hiddenField($model,'oldImage');  
			?>
			<div>
				<label for="Content_images"></label>
				<div class="desc">
					<?php 
					$baseUrl = Yii::app()->baseUrl.'/images/content/';
					$image = $model->images != null ? $baseUrl.(Content::model()->replaceSpaceWithUnderscore($model->content_categories->title)).'/article_thumb_'.$model->images : '';
					echo CHtml::image($image); ?>
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>
			<div>
				<?php echo $form->labelEx($model,'images'); ?>
				<div class="desc">
					<?php echo $form->fileField($model,'images',array('maxlength'=>255)); ?>
					<?php echo $form->error($model,'images'); ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php }?>

		<?php if($admSwt == 1 || $arrPar['source'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'source'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'source',array('maxlength'=>80)); ?>
				<?php echo $form->error($model,'source'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>
		
		<?php if($admSwt == 1 || $arrPar['source_url'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'source_url'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'source_url',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'source_url'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>
		<?php if($_GET['cid'] != 1) { ?>
			<?php if($admSwt == 1 || $arrPar['ordering'] == 1) {?>
			<div>
				<?php echo $form->labelEx($model,'ordering'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'ordering',array('class'=>'span-1')); ?>
					<?php echo $form->error($model,'ordering'); ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php }
		}?>

		<?php if(Yii::app()->user->id == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'access'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'access'); ?>
				<?php echo $form->error($model,'access'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if(Yii::app()->user->id == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'params',array('rows'=>10, 'cols'=>50)); ?>
				<?php echo $form->error($model,'params'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<?php if($admSwt == 1 || $arrPar['published'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'published'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'published'); ?>
				<?php echo $form->error($model,'published'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>

		<div class="">
			<label></label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</div>
			<div class="clear"></div>
		</div>


	</fieldset>

<?php $this->endWidget(); ?>
