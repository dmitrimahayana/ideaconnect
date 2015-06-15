<?php $this->beginContent('//layouts/front_default');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	if($module == 'project' && $controller == 'site') {
		if($action == 'view') {
			$class = 'proposal'; 
		} else {
			$class = $action; 
		}		
	}
?>

<?php //begin.Content ?>
<div id="content" class="<?php echo $class;?>">
	<?php //begin.Menu ?>
	<div class="menu">
		<ul class="clearfix">
			<li <?php echo ($module == 'project' && $controller == 'site' && $action == 'view') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('view');?>" title="Proposal">Proposal</a></li>
			<li <?php echo ($module == 'project' && $controller == 'site' && $action == 'progress') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('progress');?>" title="Progress Info">Progress Info<span>3</span></a></li>
			<li <?php echo ($module == 'project' && $controller == 'site' && $action == 'sponsor') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('sponsor');?>" title="Sponsor">Sponsor<span>100</span></a></li>
			<li <?php echo ($module == 'project' && $controller == 'site' && $action == 'comment') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('comment');?>" title="Comment">Comment<span>50</span></a></li>
		</ul>
	</div>
	<?php //end.Menu ?>
	
	<?php //begin.Content ?>
	<div class="boxed">
		<?php echo $content; ?>
	</div>
	<?php //end.Content ?>
</div>
<?php //end.Content ?>

<?php //begin.Sidebar ?>
<div id="sidebar">
	<?php //begin.Profile ?>
	<div class="profile">
		<div class="rate">
			<span></span>
			<span></span>
		</div>
		<div class="info">
			<div class="clearfix">
				<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/users/default_user.jpg', 65, 65, 1);?>" alt="">
				<span>Project by</span>
				<a href="" title="">Heri Setiana</a><br/>
				Mahasiswa, UMS
			</div>
			<div>
				4 proposal dikerjakan<br/>
				Website: <a href="" title="">www.virtuix.com</a>
				<a class="bio" href="" title="More Biografi">More Biografi</a>
			</div>
		</div>
	</div>
	<?php //end.Profile ?>

	<?php //begin.Progress ?>
	<div class="progress">
		<div class="percent"><div style="width: 45%;"></div></div>
		<div class="info clearfix">
			<div><span>3/5</span><br/>dari 11 pengajuan</div>
			<div><strong>20%</strong><span>Rp 70.000.000</span><br/>pledged of Rp 1.000.000.000 goal</div>
			<div class="clear"></div>
			<div class="sponsor"><span>45</span><br/>sponsor</div>
			<div class="date"><span>33</span><br/>hari lagi</div>
		</div>
		<div class="contribute">
			<a href="" title="Contribute">Contribute</a>
			Funding period  Jul 11, 2013 - Jul 27, 2013
		</div>
	</div>
	<?php //end.Progress ?>
	
	<?php //begin.Follow ?>
	<div class="follow">
		<h5>Ingin tahu lebih dalam?</h5>
		<ul>
			<li class="facebook"><a href="" title="">PutraSudaryanto</a></li>
			<li class="twitter"><a href="" title="">PutraSudaryanto</a></li>
			<li class="linked-in"><a href="" title=""o>PutraSudaryanto</a></li>
			<li class="website"><a href="" title="">www.nirwasitastudio.com</a></li>
			<li class="email"><a href="" title="">putra.sudaryanto@gmail.com</a></li>
		</ul>
		<div class="button">
			<a href="" title="Follow Project">Follow Project</a>
		</div>
	</div>
	<?php //end.Follow ?>
	
	<?php //begin.Reward ?>
	<div class="reward">
		<h5>Reward</h5>
		<div class="list-view">
			<div class="sep">
				<div><strong>Mentor</strong>24 Applay</div>
				OMNI T-SHIRT PLUS SIGNED POSTER SET: Receive all rewards above plus our set of three Omni posters (12"x18"). We'll even sign them if you want us to.
			</div>
			<div class="sep">
				<div><strong>Mentor</strong>24 Applay</div>
				OMNI T-SHIRT PLUS SIGNED POSTER SET: Receive all rewards above plus our set of three Omni posters (12"x18"). We'll even sign them if you want us to.
			</div>
			<div class="sep">
				<div><strong>Mentor</strong>24 Applay</div>
				OMNI T-SHIRT PLUS SIGNED POSTER SET: Receive all rewards above plus our set of three Omni posters (12"x18"). We'll even sign them if you want us to.
			</div>
			<div class="sep">
				<div><strong>Mentor</strong>24 Applay</div>
				OMNI T-SHIRT PLUS SIGNED POSTER SET: Receive all rewards above plus our set of three Omni posters (12"x18"). We'll even sign them if you want us to.
			</div>			
		</div>
	</div>
	<?php //end.Reward ?>

</div>
<?php //end.Sidebar ?>

<?php $this->endContent(); ?>