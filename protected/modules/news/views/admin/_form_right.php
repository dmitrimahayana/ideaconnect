<div class="shadow"></div>

<div class="clearfix">
	<?php echo $form->labelEx($model,'content_categories_id'); ?>
    <div class="desc">
        <?php 
		$data = CHtml::listData(Content::model()->listDataContentCategories(),'id','text','group');
		echo $form->dropDownList($model,'content_categories_id', $data, array('size' => '16', 'class' => 'span-6', 'title' => 'categories')); ?>
        <?php echo $form->error($model,'content_categories_id'); ?>
        <?php /*<div class="small-px silent"></div>*/?>
    </div>
</div>        


<?php /*echo $form->hiddenField($model,'member_news', array('value'=>0)); ?>
<div class="clearfix public-news hide">
	<?php echo $form->labelEx($model,'is_public'); ?>
    <div class="desc">
		<div style="padding-bottom:7px">
        <?php //echo $form->checkBox($model,'is_public',array('value' => '1', 'uncheckValue'=>'0')) .'public'; ?></div>
        <?php 
		$arrList = array();
		if(!$model->isNewRecord) {
			$list = CcnMemberNews::model()->findAllByAttributes(array('content_id'=>$model->id));
			if($list != null) {
				foreach($list as $val) {
					$arrList[$val->user_group->id] = $val->user_group_id; 
				}
			}
			//print_r($arrList);
			$model->arrTarget = array_keys($arrList);
		}
		?>
        <?php echo $form->checkBoxList($model,'arrTarget', CcnMemberNews::getMemberList()); ?>
        <?php echo $form->error($model,'is_public'); ?>
    </div>
</div>
*/ ?>
<div class="clearfix">
	<?php echo $form->labelEx($model,'publish_up'); ?>
    <div class="desc">
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker',array(
                'model'=>$model,
                'language'=>'id',
                'attribute'=>'publish_up', //attribute name
                'mode'=>'datetime', //use 'time','date' or 'datetime' (default)
                'options'=>array('dateFormat'=>'dd-mm-yy'), // jquery plugin options
            ));
        ?>
        <?php echo $form->error($model,'publish_up'); ?>
    </div>
</div>

<div class="clearfix">
    <?php echo $form->labelEx($model,'published'); ?>
    <div class="desc">
        <?php echo $form->checkBox($model,'published',array('value' => '1', 'uncheckValue'=>'0')); ?>
    </div>	
</div>

<div class="clearfix">
    <?php echo $form->labelEx($model, 'display_quotes'); ?>
    <div class="desc">
        <?php echo $form->dropDownList($model, 'display_quotes', array(1 => 'Image', 0 => 'Quote')); ?>
        <?php //echo $form->checkBox($model, 'display_quotes',array('value' => '1', 'uncheckValue'=>'0')); ?>
    </div>  
</div>