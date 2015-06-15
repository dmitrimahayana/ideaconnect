<?php

	$module = strtolower(Yii::app()->controller->module->id);
	$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$cs = Yii::app()->getClientScript();

    /*made in demit*/
    /*Yii::app()->clientScript->registerPackage('http://code.jquery.com/jquery-1.9.1.js');
    Yii::app()->clientScript->registerPackage('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
    //$cs->registerCoreScript('http://code.jquery.com/jquery-1.9.1.js');
    //$cs->registerCoreScript('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
    $cs->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');*/
	/*end*/

    $cs->registerCoreScript('jquery', CClientScript::POS_END);
	if ($current != 'backoffic3/login') {
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/general.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/layout.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/form.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/typography.css');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/fonts/cufon.js', CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/fonts/Bell_Gothic_Std_700-Bell_Gothic_Std_500.font.js', CClientScript::POS_END);
		//$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugin/jquery.scrollTo-1.4.2-min.js', CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom/custom.js', CClientScript::POS_END);
$js=<<<EOP
	Cufon.set('fontFamily', 'Bell Gothic Std').replace('.bell-gothic');
EOP;
		$cs->registerScript('cufon', $js, CClientScript::POS_END);
	} else {
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/login.css');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom/login.js', CClientScript::POS_END);
	}
	if($module == null) {
		$class = $controller;
	} else {
		if($module == 'admin') {
			$class = $controller;
		} else {
			$class = $module;
		}
	}
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8" />
  <title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo CHtml::encode(Yii::app()->name); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php /* <meta name="keywords" content="<?php echo CHtml::encode($this->pageMeta); ?>" />
  <meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />*/ ?>
  <meta name="author" content="Nirwasita Studio" />
  <script type="text/javascript">
	var baseUrl = '<?php echo BASEURL;?>';
  </script>
  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.ico" />
 </head>
 <body>


<?php if ($current == 'backoffic3/login') {?>
	<div class="login">
		<div class="fixed">
			<div class="content">
				<?php echo $content; ?>
			</div>
		</div>
	</div>

<?php } else {
	if(in_array(Yii::app()->user->id, array(4,5,6)))
		$this->redirect(Yii::app()->homeUrl);
 ?>

	<?php //begin.Header ?>
	<header></header>
	<?php //end.Header ?>

	<?php //begin.Dialog ?>
	<div class="dialog">
		<div class="fixed">
			<div class="dialog-box">
				<div class="content overflow">
				</div>
			</div>
		</div>
	</div>
	<?php //end.Dialog ?>

	<?php //begin.BodyContent ?>
	<div class="container clearfix">
		<?php //begin.Sidebar ?>
		<div class="sidebar">
			<?php //begin.Logo ?>
			<div class="logo">
				<a href="" title="Sumatera Career Center"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/resource/logo.png" alt="Sumatera Career Center"></a>
			</div>
			<?php //end.Logo ?>
			<?php //begin.Quickmenu ?>
			<div class="quickmenu">
				<div class="shadow"></div>
				<ul>
					<li <?php echo (!in_array($controller, array('weboption','templates','modules'))) ? 'class="active"' : '' ?> name="application"><a href="javascript:void(0);" title="<?php echo Yii::t('','Aplikasi')?>"><?php echo Yii::t('','Aplikasi')?></a><span></span></li>
					<li <?php echo (in_array($controller, array('weboption','templates','modules'))) ? 'class="active"' : '' ?> name="settings"><a href="javascript:void(0);" title="<?php echo Yii::t('','Pengaturan')?>"><?php echo Yii::t('','Pengaturan')?></a><span></span></li>
					<li <?php echo (in_array($controller, array())) ? 'class="active"' : '' ?> name="account"><a href="javascript:void(0);" title="<?php echo Yii::t('','Akun')?>"><?php echo Yii::t('','Akun')?></a><span></span></li>
				</ul>
			</div>
			<?php //end.Quickmenu ?>
			<?php //begin.Mainmenu ?>
			<div class="mainmenu clearfix">
				<div id="application" name="setting-on" <?php echo (in_array($controller, array('weboption','templates','modules'))) ? 'class="hide"' : '' ?>>
					<div class="title"><?php echo Yii::t('','Aplikasi')?></div>
					<?php $this->widget('OfficeMainMenu'); ?>
				</div>
				<div id="settings" name="setting-on" <?php echo (!in_array($controller, array('weboption','templates','modules'))) ? 'class="hide"' : '' ?>>
					<div class="title"><?php echo Yii::t('','Pengaturan')?></div>
					<ul>
						<li <?php echo $controller == 'weboption' ? 'class="active"' : ''?>><a href="<?php echo Yii::app()->createUrl('weboption/index')?>" title="<?php echo Yii::t('','Basic')?>"><?php echo Yii::t('','Basic')?></a></li>
						<li <?php echo $controller == 'templates' ? 'class="active"' : ''?>><a href="<?php echo Yii::app()->createUrl('templates/index')?>" title="<?php echo Yii::t('','Tema')?>"><?php echo Yii::t('','Tema')?></a></li>
						<li <?php echo $controller == 'modules' ? 'class="active"' : ''?>><a href="<?php echo Yii::app()->createUrl('modules/index')?>" title="<?php echo Yii::t('','Kelola Module')?>"><?php echo Yii::t('','Kelola Module')?></a></li>
					</ul>
				</div>
				<div id="account" name="setting-on" <?php echo (!in_array($controller, array())) ? 'class="hide"' : '' ?>>
					<div class="title"><?php echo Yii::t('','Akun')?></div>
					<ul>
						<li><a class="link-dialog" rel="500" href="<?php echo Yii::app()->createUrl('member/adminbackoffice/admineditaccount',array('id'=>Yii::app()->user->id_user,'type'=>'account'))?>" title="<?php echo Yii::t('','Perbarui Akun')?>"><?php echo Yii::t('','Perbarui Akun')?></a></li>
						<li><a class="link-dialog" rel="500" href="<?php echo Yii::app()->createUrl('member/adminbackoffice/admineditpassword',array('id'=>Yii::app()->user->id_user,'type'=>'password'))?>" title="<?php echo Yii::t('','Perbarui Password')?>"><?php echo Yii::t('','Perbarui Password')?></a></li>
						<li><a href="<?php echo Yii::app()->createUrl('backoffic3/logout')?>" title="<?php echo Yii::t('','Logout')?>"><?php echo Yii::t('','Logout')?></a></li>
					</ul>
				</div>
			</div>
			<?php //end.Mainmenu ?>
		</div>
		<?php //end.Sidebar ?>

		<div class="body" id="<?php echo $class;?>">
			<?php //begin.Topmenu ?>
			<div class="topmenu clearfix">
				<?php //begin.Usermenu ?>
				<div class="usermenu">
					&nbsp;<br><br>
				</div>
				<?php //begin.Breadcrumbs ?>
				<div class="breadcrumbs">
					<a href="<?php echo Yii::app()->createUrl('backoffic3/index')?>" title="<?php echo Yii::t('','Dashboard')?>"><?php echo Yii::t('','Dashboard')?></a><span>\</span>
					<?php
					echo '<h1 class="right bell-gothic">Welcome, <strong>'.Yii::app()->user->name.' ('.Yii::app()->user->group.')</strong></h3>';
					$this->widget(
						'OfficeBreadcrumbs', array(
						'links' => Yii::app()->controller->breadcrumbs,
					));?>
					<h1 class="bell-gothic"><?php echo CHtml::encode($this->pageTitle); ?></h1>
				</div>
			</div>
			<?php //end.Topmenu ?>

			<?php //begin.Title ?>
			<div class="contentmenu clearfix">
				<div class="shadow"></div>
				<?php $this->widget('OfficeContentMenu'); ?>
				<?php $this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'gridmenu'),
				)); ?>
			</div>
			<?php //end.Title ?>

			<?php //begin.Content ?>
			<div class="content <?php echo (in_array($action, array('adminadd','adminedit','adminview','single','blasting','employerdata','employerdataedit'))) || (in_array($current, array('weboption/index','contactdetail/index'))) ? 'edit' : ''?>">
				<?php echo $content; ?>
			</div>
			<?php //end.Content ?>

		</div>
	</div>
	<?php //end.BodyContent ?>

	<?php //begin.Footer ?>
	<footer class="clearfix">
		<?php //begin.Copyright ?>
		<div class="copyright">
			Copyright &copy; 2013 Politeknik Caltex Riau. All rights reserved.
			<?php //begin.Copyright ?>
			<div class="powered">
				Powered by <a href="http://www.swevel.com" target="_blank" title="Swevel Universal Media">Swevel</a>
			</div>
		</div>
		<?php //end.Copyright ?>
	</footer>
	<?php //end.Footer ?>

<?php } ?>

 </body>
</html>
