<?php
/* @var $this EmployerindustryController */
/* @var $model CcnEmployerIndustry */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Tipe Industri'=>array('index'),
	'Kelola',
);
?>

<div id="partial-ccn-major" class="partial-add clearfix">
<?php //begin.Messages ?>
	<div id="ajax-message">
	<?php
		if(Yii::app()->user->hasFlash('error'))
			echo Utility::flashError(Yii::app()->user->getFlash('error'));
		if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
	?>
	</div>
	<div class="clear"></div>
	<?php //end.Messages ?>
    
	<?php 
    $columnData   = $columns;
    array_push($columnData, array(
        'header' => 'Option',
        'class'=>'CButtonColumn',
        'buttons' => array(
            'update' => array(
                'label' => 'ubah',
                'options' => array(
                    'rel' => 600, 
                    'class' => 'update'
                ),
                'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
            'delete' => array(
                'label' => 'hapus',
                'options' => array(
                    'class' => 'delete'
                ),
                'url' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))')
        ),
        'template' => '{update}&nbsp;{delete}',
    ));
    
    $this->widget('application.components.system.BGridView', array(
        'id'=>'ccn-employer-industry-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns' => $columnData,
        'pager' => array('header' => ''),
    ));
    
    ?>
    
    <div class="form" name="post-on">
		<h3><?php echo Yii::t('','Tambah Tipe Industri');?></h3>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'ccn-employer-industry-form',
			'action'=>Yii::app()->controller->createUrl('adminadd'),
			'enableAjaxValidation'=>true,
		)); ?>
			<fieldset>
				<div class="clearfix">
					<?php echo $form->labelEx($model,'name'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'name',array('maxlength'=>150,'class'=>'span-10')); ?>
						<?php echo $form->error($model,'name'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>

				<div class="submit clearfix">
					<label>&nbsp;</label>
					<div class="desc">
						<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
					</div>
				</div>
			</fieldset>

		<?php $this->endWidget(); ?>
	</div>
    
</div>
