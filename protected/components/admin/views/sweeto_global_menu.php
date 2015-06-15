<ul>
	<li class="dashboard <?php if (in_array($controller, array('adminsw370'))) {?>active<?php }?>"><a href="<?php echo Yii::app()->createUrl('adminsw370/index')?>" title="Dashboard">Dashboard</a></li>
	<li class="user <?php if (in_array($controller, array('users','usersgroup','srbac'))) {?>active<?php }?>"><a href="<?php echo Yii::app()->createUrl('users/adminmanage')?>" title="User">User</a></li>
	<li class="menu <?php if (in_array($controller, array('menutypes','menu','submenuadmin'))) {?>active<?php }?>"><a href="<?php echo Yii::app()->createUrl('menutypes/adminmanage')?>" title="Menu">Menu</a></li>
	<li class="content <?php if (in_array($controller, array('content','contentcategories','contentsection', 'contentfrontpage', 'contactdetail'))) {?>active<?php }?>"><a href="<?php echo Yii::app()->createUrl('content/adminmanage')?>" title="Content">Content</a></li>
	<li class="module <?php if (in_array($controller, array('modules','hooks','widgets','extensions'))) {?>active<?php }?>"><a href="<?php echo Yii::app()->createUrl('modules/adminmanage')?>" title="Module">Module</a></li>
	<li class="setting <?php if (in_array($controller, array('languages','msgtranslation','templates','globaloptions','weboption'))) {?>active<?php }?>"><a href="<?php echo Yii::app()->createUrl('globaloptions/adminmanage')?>" title="Setting">Setting</a></li>
</ul>
