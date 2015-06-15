<?php
$this->breadcrumbs=array(
	$this->module->id,
);

// Current applied theme
$appliedTheme  = Yii::app()->theme->name;

$js = <<<EOP
$(".fancybox").fancybox();
$(".various").fancybox({
	maxWidth	: 800,
	maxHeight	: 600,
	fitToView	: false,
	width		: '70%',
	height		: '90%',
	autoSize	: false,
	closeClick	: false,
	openEffect	: 'none',
	closeEffect	: 'none',
	afterClose  : function() {
	}
});

$('a.iframe').click(function(event) {
	openWin($(this).attr('href'));
	event.preventDefault();
});
EOP;

$jsWin = <<<EOP
function openWin(url) {
	var h = 250;
	var w = 300;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	var options = 'toolbar=no, location=no, directories=no,';
	options += 'status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w;
	options += 'height='+h+', top='+top+', left='+left;
	var targetWin = window.open (url, '', options);

}
EOP;

$cs = Yii::app()->getClientScript();
$cs->registerScript('fancy-script', $js);
$cs->registerScript(Utility::getUniqId(), $jsWin, CClientScript::POS_END);
$themeBaseUrl = Yii::app()->baseUrl.'/themes/';
?>

<div style="background-color: white" class="pl-10 pt-5 pb-5">
	<form action="<?php echo $this->createUrl('adminmanage'); ?>" name="form-theme-upload"
		method="post" enctype="multipart/form-data">
		<label>Nama file: </label>&nbsp;
		<input type="file" name="file_name" size="40">&nbsp;
		<input type="submit" value="Submit">
	</form>
</div>
<br />

<div id="users-grid" class="grid-view">
	<div class="summary">Displaying 1-1 of 1 result(s).</div>
	<table class="items">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Theme</th>
				<th class="button-column">Option</th>
			</tr>
		</thead>
	<tbody>
		<?php $i = 1;
		foreach($theme as $val): ?>
			<?php if($i % 2 == 0): ?>
				<tr style="background-color: #dedede;">
			<?php else: ?>
				<tr>
			<?php endif; ?>
					<td><?php echo $i?></td>
					<td>
						<?php if(Yii::app()->theme->name == $val): ?>
							<strong><?php echo $val?>&nbsp;&radic;</strong>
						<?php else: ?>
							<?php echo $val?>
						<?php endif; ?>
					</td>
					<td class="button-column">
						<?php
						echo CHtml::link('Apply', $this->createUrl('default/adminapply', array(
							'id' => $val,
						)));
						?>
						&nbsp;
						<a class="iframe" href="<?php echo Yii::app()->createAbsoluteUrl('site/index', array(
							'theme' => $val
						))?>">
							Preview</a>
					</td>
				</tr>
		<?php
			$i++;
		endforeach; ?>
	</tbody>
	</table>
</div>
