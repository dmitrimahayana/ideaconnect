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

		<li>
			<?php echo $model->getAttributeLabel('name'); ?><br />
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('email'); ?><br />
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('mobile_no'); ?><br />
			<?php echo $form->textField($model,'mobile_no',array('size'=>15,'maxlength'=>15)); ?>
		</li>
        
        <li>
			<?php echo $model->getAttributeLabel('users_group_id'); ?><br />
            <?php $listData = CHtml::listData(UsersGroup::model()->findAll(array('select'=>'id,name','condition'=>'group_login = "back_office"')),'id','name'); ?>
			<?php echo $form->dropDownList($model,'users_group_id', $listData); ?>
		</li>
        
		
		<?php if($_GET['id'] == 5) {?>
		<li>
			<?php echo $model->getAttributeLabel('actived'); ?><br />
			<?php echo $form->textField($model,'actived'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('block'); ?><br />
			<?php echo $form->textField($model,'block'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('register_date'); ?><br />
			<?php echo $form->textField($model,'register_date'); ?>
		</li>
		<?php }?>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>
