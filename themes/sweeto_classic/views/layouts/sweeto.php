<?php 
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$current = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery', CClientScript::POS_END);
	if ($currentAction != 'adminsw370/login') {
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugin/jquery.scrollTo-1.4.2-min.js', CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom/custom.js', CClientScript::POS_END);
	} else {
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom/login.js', CClientScript::POS_END);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo CHtml::encode(Yii::app()->name); ?></title>
  <meta name="Generator" content="EditPlus" />
  <meta name="Author" content="" />
  <meta name="Keywords" content="" />
  <meta name="Description" content="" />
  <script type="text/javascript">
	var baseUrl = '<?php echo BASEURL;?>';
  </script>
  <?php if ($currentAction == "adminsw370/login") {?>
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/login.css" rel="stylesheet" type="text/css" />
  <?php } else { ?>
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/general.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/layout.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/form.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/typography.css" rel="stylesheet" type="text/css" />
  <?php } ?>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.ico" />
 </head>

	<?php //bagin.Dialog ?>
	<div class="dialog">
		<div class="fixed">
			<div class="dialog-box">
				<div class="content overflow">
					<div class="loader"></div>
				</div>
			</div>
		</div>
	</div>
	<?php //end.Dialog ?>

	<?php if ($currentAction == "adminsw370/login") {?>
	<div class="login">
		<div class="fixed">
			<div class="content">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<?php //begin.Header ?>
	<div class="header">
		&nbsp;<br /><br />
	</div>
	<?php //end.Header ?>

	<?php //begin.BodyContent ?>
	<div class="body">
		<div class="container">
			<?php //begin.Menu ?>
			<div class="submenu">
				<?php //begin.Globalmenu ?>
				<div class="globalmenu">
					<?php //begin.Admin Photo ?>
					<div class="photo">
						<img src="<?php echo Yii::app()->request->baseUrl;?>/images/users/default.jpg" alt="Putra Sudaryanto" />
					</div>
					<?php //end.Admin Photo ?>
					<?php $this->widget('SweetoGlobalMenu'); ?>
				</div>
				<?php //end.Globalmenu ?>
				<div class="account">
					<?php $this->widget('SweetoAdminUser'); ?>
				</div>
				<div class="menu">
					<?php $this->widget('SweetoSubMenu'); ?>
				</div>
			</div>
			<?php //end.Menu ?>
			<?php //begin.Content ?>
			<div class="content <?php echo $current?>">
				<div class="shadow"></div>
				<div class="contentmenu">
					<?php $this->widget('SweetoContentMenu'); ?>
					<div class="breadcrumbs">
						<a href="<?php echo Yii::app()->createUrl('admin12/index')?>" title="Dashboard">Dashboard</a><span>\</span>
						<?php 
							$this->widget(
								'SweetoBreadcrumbs', array(
								'links' => Yii::app()->controller->breadcrumbs,
							)); 
						?>
					</div>
					<h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
					<div class="hr"></div>
					<div class="clear"></div>
				</div>
				<div id="get-data">
					<?php echo $content; ?>
				</div>
			</div>
			<?php //end.Content ?>
		</div>
	</div>
	<?php //end.BodyContent ?>

	<?php //begin.Footer ?> 
	<div class="footer">
		<?php //begin.Copyright ?>
		<div class="copyright">
			<div class="right">
				Powered by <a href="<?php echo Yii::app()->createUrl('site/index')?>" title="Swevel">Swevel</a>
			</div>
			Copyright &copy; 2012 <a href="<?php echo Yii::app()->createUrl('site/index')?>" title="Sweeto Platform">Sweeto Platform</a>
			<div class="clear"></div>
		</div>
		<?php //end.Copyright ?>
	</div>
	<?php //end.Footer ?>
	<?php } ?>

 </body>
</html>
