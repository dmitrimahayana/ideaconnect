<?php $this->beginContent('//layouts/default');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);

	if($module == null) {
		if($controller == 'site') {
			if($action == 'index') {
				$class = 'main';
			} else if($action == 'login') {
				$class = 'login';
			} else {
				$class = $action;
			}
		} else {
			$class = $controller;
		}
	} else {
		if($controller == 'site') {
			$class = $module;
		} else {
			$class = $controller;
		}
	}

if($this->dialogDetail == false) {?>
	
	<?php //begin.Project Slider ?>
	<?php if($module == null && $currentAction == 'site/index') {?>
	<div id="slider">
		<div class="carousel">
			<ul class="clearfix">
				<li><img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/users/default_user.jpg', 1400, 420, 1);?>" alt=""></li>
			</ul>
		</div>			
	</div>
	<?php }?>
	<?php //end.Project Slider ?>

	<div class="container clearfix">
		<div id="<?php echo $class;?>" <?php echo ($module == null && $currentAction == 'site/index') ? 'class="home"' : ($this->layout == 'front_sidebar' ? 'class="sidebar-on clearfix"' : '');?>>
			<?php echo $content; ?>
		</div>
	</div>

<?php } else {?>
	<div id="<?php echo $class;?>" class="clearfix">
		<?php echo $content; ?>
	</div>
	
<?php }?>

<?php $this->endContent(); ?>