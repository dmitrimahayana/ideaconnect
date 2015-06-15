<h2>Users</h2>
<ul>
	<li<?php echo in_array($controller, array('users')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('users/adminmanage')?>" title="User"><span class="icons">C</span>User</a></li>
	<li<?php echo in_array($controller, array('usersgroup')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('usersgroup/adminmanage')?>" title="Grup User"><span class="icons">C</span>Grup User</a></li>
	<li<?php echo in_array($controller, array('srbac')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('srbac/index')?>" title="SRBAC"><span class="icons">C</span>SRBAC</a></li>
</ul>
