<?php 
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/general.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/form.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/typography.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/layout.css');
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/externals/content.css');
	$cs->registerCoreScript('jquery', CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugin/jquery.address-1.5.min.js', CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugin/jcarousellite_1.0.1.min.js', CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom/custom.js', CClientScript::POS_END);
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8" />
  <title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo CHtml::encode(Yii::app()->name); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Nirwasita Studio" />
  <script type="text/javascript">
	var baseUrl = '<?php echo BASEURL;?>';
	<?php 
	//javascript attribute
	echo Yii::app()->user->isGuest ? "var lastUrl = '".$_SERVER['REQUEST_URI']."';" : '';
	echo $this->dialogDetail == true ? $this->dialogGroundUrl != '' ? "var dialogGroundUrl = '".$this->dialogGroundUrl."';" : "var dialogGroundUrl = '';" : "var dialogGroundUrl = '';";
	?>
  </script>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.ico" />
 </head>
 <body <?php echo $this->dialogDetail == true ? (empty($this->dialogWidth) ? 'class="dialog-on" style="overflow-y: hidden;"' : 'class="dialog-on"') : '';?>>

	<?php //begin.Loading ?>
	<div class="loading"></div>
	<?php //end.Loading ?>
	
	<?php //begin.Dialog ?>
	<div class="dialog" id="<?php echo ($this->dialogDetail == true && empty($this->dialogWidth)) ? 'apps' : 'module';?>">
		<div class="fixed" <?php echo Yii::app()->request->isAjaxRequest ? (($this->dialogDetail == true && empty($this->dialogWidth)) ? 'name="apps"' : 'name="module"') : '';?>>
			<div class="dialog-box">
				<div class="content" <?php echo ($this->dialogDetail == true && empty($this->dialogWidth)) ? 'id="950px"' : 'id="'.$this->dialogWidth.'"';?> name="dialog-wrapper"><?php echo $this->dialogDetail == true ? $content : '';?></div>
			</div>
		</div>
	</div>
	<?php //end.Dialog ?>

	<?php //begin.Header ?>
	<header>
		<div class="container clearfix">
			<?php //begin.Logo ?>
			<div class="logo">
				<a href="<?php echo Yii::app()->createUrl('site/index');?>" title="Back to home"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/resource/logo.png" alt="Idea Connect"></a>
			</div>
			<?php //end.Logo ?>
			<?php //begin.Mainmenu ?>
			<div class="mainmenu">
				<ul class="clearfix">
					<li class="sponsor"><a href="" title="Support Project">Support Project</a></li>
					<li class="inisiator"><a href="" title="Initiate Project">Initiate Project</a></li>
					<li <?php echo ($module != null && $module == 'project') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->createUrl('project');?>" title="Browse">Browse</a></li>
					<li <?php echo ($module != null && $module == 'news') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->createUrl('news');?>" title="News">News</a></li>
					<li class="search">
						<form>
							<input type="text">
						</form>
					</li>
				</ul>
			</div>
			<?php //end.Mainmenu ?>
			<?php //begin.Usermenu ?>
			<div class="usermenu <?php echo ($module == null && $currentAction == 'site/signup') ? 'class="active"' : '';?>">
				<a class="guest" href="<?php echo Yii::app()->createUrl('site/signup');?>" title="Signup & Login">Signup - Login</a>
			</div>
			<?php //end.Usermenu ?>
		</div>
	</header>
	<?php //end.Header ?>

	<?php //begin.BodyContent ?>
	<div class="body clearfix">
		<?php //begin.Content ?>
		<div class="wrapper"><?php echo $this->dialogDetail == false ? $content : '';?></div>
		<?php //end.Content ?>
	</div>
	<?php //end.BodyContent ?>

	<?php //begin.Footer ?>
	<footer>
		<?php //begin.Connect and Social Media ?>
		<div class="connect">
			<div class="container clearfix">
				<div class="grid-3">
					<h3>About</h3>
					<ul>
						<li><a href="" title="What is IdeaConnect?">What is IdeaConnect?</a></li>
						<li><a href="" title="Fitur">Fitur</a></li>
						<li><a href="" title="FAQ">FAQ</a></li>
						<li><a href="" title="Contact Us">Contact Us</a></li>
						<li><a href="" title="Site Map">Site Map</a></li>
					</ul>
				</div>
				<div class="grid-3">
					<h3>Project</h3>
					<ul>
						<li><a href="" title="Project Guideline">Project Guideline</a></li>
						<li><a href="" title="Fund Policy">Fund Policy</a></li>
						<li><a href="" title="Inisiator School">Inisiator School</a></li>
						<li><a href="" title="Best Project">Best Project</a></li>
					</ul>
				</div>
				<div class="grid-3">
					<h3>Policy</h3>
					<ul>
						<li><a href="" title="Term & Condition">Term & Condition</a></li>
						<li><a href="" title="Privacy Policy">Privacy Policy</a></li>
					</ul>
				</div>
				<div class="grid-3 social last">
					<ul>
						<li class="phone">(021) 741258</li>
						<li class="facebook"><a href="" title="Facebook">615,342 people like this</a>. Be the first of your friends.</li>
						<li class="twitter"><a href="" title="Twitter">702K follower</a></li>
						<li class="youtube"><a href="" title="You Tube">1.500 video</a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php //end.Connect and Media ?>
		<div class="container clearfix">
			<?php //begin.Copyright ?>
			<div class="copyright">
				<a class="logo" href="<?php echo Yii::app()->createUrl('site/index');?>" title="Back to home"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/resource/footer_logo.png" alt="Idea Connect"></a>
				Copyright &copy; 2013 Idea Connect. All Rights Reserved.
			</div>
			<?php //end.Copyright ?>
			<?php //begin.Powered ?>
			<div class="powered clearfix">
				<h5>supported by</h5>
				<a href="http://www.ecc.ft.ugm.ac.id" target="_blank" title="ECC UGM"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/resource/eccugm_logo.png" alt="ECC UGM"></a>
				<a href="http://www.swevel.com" target="_blank" title="Swevel Universal Media"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/resource/swevel_logo.png" alt="Swevel Universal Media"></a>
			</div>
			<?php //end.Powered ?>
		</div>
	</footer>
	<?php //end.Footer ?>

 </body>
</html>