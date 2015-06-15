<div class="usermenu">
	<ul>
		<li class="photo"><a href="" title="<?php echo $admin->name?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/users/default.jpg" alt="<?php echo $admin->name?>" /></a></li>
		<li class="user">
			Welcome, <a class="bold" href="" title="<?php echo $admin->name?>"><?php echo $admin->name?></a><br/>
			<span class="date">Last sign in : 16:11 Feb 27th 2012</span>
			<a class="logout" href="<?php echo Yii::app()->createUrl('site/logout')?>" title="Sign out">Sign out</a>
		</li>
	</ul>
</div>
