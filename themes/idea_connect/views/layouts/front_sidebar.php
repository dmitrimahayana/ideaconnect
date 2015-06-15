<?php $this->beginContent('//layouts/front_default');
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

if ($this->dialogDetail == true) {?>
	
	<div id="<?php echo $class;?>">
		<?php echo $content; ?>
	</div>

<?php } else {?>

	<?php //begin.Sidebar ?>
	<div id="sidebar">
		<?php if($module != null) {
			if($module == 'news' && $currentAction == 'site/index') {
				$this->widget('application.modules.news.components.FrontSidebar');				
			} else {
				$this->widget('application.modules.project.components.FrontSidebar');
			}
		}?>
	</div>
	<?php //end.Sidebar ?>
	<?php //begin.Content ?>
	<div id="content">
		<?php echo $content; ?>
	</div>
	<?php //end.Content ?>

<?php }
$this->endContent(); ?>