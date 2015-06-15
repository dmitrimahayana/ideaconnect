<h2>Menu</h2>
<ul>
	<li<?php echo in_array($controller, array('modules')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('modules/adminmanage')?>"><span class="icons">C</span>Modules</a></li>
	<li<?php echo in_array($controller, array('hooks')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('hooks/adminmanage')?>"><span class="icons">C</span>Hooks</a></li>		
	<li<?php echo in_array($controller, array('widgets')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('widgets/adminmanage')?>"><span class="icons">C</span>Widgets</a></li>
	<li<?php echo in_array($controller, array('extensions')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('extensions/adminmanage')?>"><span class="icons">C</span>Exstensions</a></li>
</ul>
