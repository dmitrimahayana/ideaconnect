<h2>Menu</h2>
<ul>
	<li<?php echo in_array($controller, array('menutypes')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('menutypes/adminmanage')?>" title="Menu Type"><span class="icons">C</span>Menu Type</a></li>
	<li<?php echo isset($_GET['Menu']['menu_type']) && strpos($_GET['Menu']['menu_type'], 'b_') !== false ?  ' class="active"':''?>><a href="javascript:void(0);" title="Backoffice Menu"><span class="icons">C</span>Backoffice Menu</a>
		<ul>
			<?php foreach($menuTypeBackOffice as $val): ?>
			<li><a href="<?php echo Yii::app()->createUrl('menu/adminmanage', array('Menu[menu_type]' => $val->menu_type, 'tid'=>$val->id))?>"><?php echo $val->title?></a></li>
			<?php endforeach; ?>						
		</ul>
	</li>
	<li<?php echo isset($_GET['Menu']['menu_type']) && strpos($_GET['Menu']['menu_type'], 'b_') === false ?  ' class="active"':''?>><a href="javascript:void(0);" title="Public Menu"><span class="icons">C</span>Public Menu</a>
		<ul>
			<?php foreach($menuTypePublic as $val): ?>
			<li><a href="<?php echo Yii::app()->createUrl('menu/adminmanage', array('Menu[menu_type]' => $val->menu_type, 'tid'=>$val->id))?>"><?php echo $val->title?></a></li>
			<?php endforeach; ?>							
		</ul>
	</li>
	<li<?php echo in_array($controller, array('submenuadmin')) ? ' class="active"':''?>><a href="<?php echo Yii::app()->createUrl('submenuadmin/adminmanage')?>" title="Content Menu"><span class="icons">C</span>Content Menu</a></li>
</ul>
