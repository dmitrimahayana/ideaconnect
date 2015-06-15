Welcome,
<a class="bold" href="javascript:void(0);" title="<?php echo $admin->name?>"><?php echo $admin->name?></a>
<div class="date">Last sign in : 16:11 Feb 27th 2012</div>

<div class="useradmin-box">
	<a class="logoff" href="<?php echo Yii::app()->createUrl('site/logout')?>" title="Sign out">Sign out</a>
	<a class="message" href="<?php echo Yii::app()->createUrl('site/logout')?>" title="10 Message"><span>10</span></a>
</div>
