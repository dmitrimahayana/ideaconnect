<?php
/* @var $this JobseekerupdateController */
/* @var $model CcnJobseekerUpdate */
/* @var $form CActiveForm */

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('form[name="gridoption"] :checkbox').live('click', function(){
		var url = $('form[name="gridoption"]').attr('action');
		$.ajax({
			url: url,
			data: $('form[name="gridoption"] :checked').serialize(),
			success: function(response) {
				$.fn.yiiGridView.update('ccn-jobseeker-update-grid', {
					data: $('form[name="gridoption"]').serialize()
				});
				return false;
			}
		});
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
?>

<?php echo CHtml::beginForm(Yii::app()->createUrl($this->route), 'GET', array(
	'name' => 'gridoption',
));
$columns   = array();
$exception = array('id');
foreach($model->metaData->columns as $key => $val) {
	if(!in_array($key, $exception)) {
		$columns[$key] = $key;
	}
}
?>
<ul class="clearfix">
	<?php foreach($columns as $val): ?>	<li>
		<?php echo $val; ?>
		<?php echo CHtml::checkBox('GridColumn['.$val.']'); ?>
	</li>
	<?php endforeach; ?></ul>
<div class="clear"></div>
<?php echo CHtml::endForm(); ?>
