<h2>Menu</h2>
<ul>
	<li<?php echo in_array($controller, array('content')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('content/adminmanage')?>"><span class="icons">C</span>Content</a></li>
	<li<?php echo in_array($controller, array('contentcategories')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('contentcategories/adminmanage')?>"><span class="icons">C</span>Category</a></li>
	<li<?php echo in_array($controller, array('contentsection')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('contentsection/adminmanage')?>"><span class="icons">C</span>Section</a></li>	
	<li<?php echo in_array($controller, array('contentfrontpage')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('contentfrontpage/adminmanage')?>"><span class="icons">C</span>Frontpage</a></li>
	<li<?php echo in_array($controller, array('contactdetail')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('contactdetail/index')?>"><span class="icons">C</span>Contact Detail</a></li>
</ul>
