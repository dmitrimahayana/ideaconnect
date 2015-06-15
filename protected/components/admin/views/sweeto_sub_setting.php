<h2>Menu</h2>
<ul>
	<li<?php echo in_array($controller, array('globaloptions')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('globaloptions/adminmanage')?>" title="Global Options"><span class="icons">C</span>Global Options</a></li>
	<li<?php echo in_array($controller, array('languages', 'msgtranslation')) ? ' class="active"':''?>><a href="javascript:void(0);" title="Languages"><span class="icons">C</span>Languages</a>
		<ul>
			<li><a href="<?php echo Yii::app()->createUrl('languages/adminmanage')?>">Languages Country</a></li>
			<li><a href="<?php echo Yii::app()->createUrl('msgtranslation/adminmanage')?>">Translate Word/Message</a></li>
		</ul>
	</li>
	<li<?php echo in_array($controller, array('templates')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('templates/adminmanage')?>" title="Templates"><span class="icons">C</span>Templates</a></li>
	<li<?php echo in_array($controller, array('weboption')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('weboption/index')?>" title="Web Setting"><span class="icons">C</span>Web Setting</a></li>
</ul>
