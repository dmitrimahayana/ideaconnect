<?php /* right menu */?>
<ul class="left">
	<?php
	// Left Position
	if($model != null) {
		foreach($model as $val) {
			if($val->position == 'left') {
				//list action
				$arrAction = explode(',', $val->action);
				$arrControllerAction = array();
				if(count($arrAction) > 1) {
					foreach($arrAction as $item) {
						$arrControllerAction[] = ($module !=null ? $module .'/' : '').Yii::app()->controller->id.'/'.$item;
					}
				}else
					$arrControllerAction[] = ($module !=null ? $module .'/' : '').Yii::app()->controller->id.'/'.$val->action;				
				
				//attr url					
				$arrAttrParams = array();
				if($val->attr != '-') {
					$arrAttr = explode(',', $val->attr);
					if(count($arrAttr) > 0) {
						foreach($arrAttr as $row) {
							$part = explode('=', $row);
							if(strpos($part[1], '$_GET') !== false) {								
								$list = explode('*', $part[1]);
								if(count($list) == 2)
									$arrAttrParams[$part[0]] = $_GET[$list[1]];
								elseif(count($list) == 3)
									$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
								elseif(count($list) == 4)
									$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
								elseif(count($list) == 5)
									$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
								
							}else
								$arrAttrParams[$part[0]] = $part[1];
						}
					}
				}
				$link = $val->url != 'javascript:void(0);' ? Yii::app()->controller->createUrl($val->url, $arrAttrParams) : 'javascript:void(0);';
				$valueId = $val->dialog == 1 ? 'class="link-dialog" rel="500"' : '';
				$icons = $val->icon != '' ? $val->icon : 'C';
				$class = $val->class;
				if(Yii::app()->controller->id== 'content') {
					/* $link = Yii::app()->createUrl('content/ajaxchoisecategory', array('sid' => $_GET['sid']));
					$valueId = 'id="ajax-on"' ;
					$class = 600; */
					if(isset($_GET['sid']))
						$arrAttrParams['sid'] = $_GET['sid'];
					elseif(isset($_GET['cid']))
						$arrAttrParams['cid'] = $_GET['cid'];
					$arrAttrParams['t'] = str_replace(' ', '-', strtolower($val->menu));
					
					$link = Yii::app()->createUrl($val->url, $arrAttrParams);
					
				}				
				
				$icons = $val->icon == '' ? 'C' : $val->icon;
				if (in_array($currentAction, $arrControllerAction)) {
					echo '<li><a '.$valueId.' class="'.$class.'" href="'.$link.'"><span class="icons">'.$icons.'</span>'.$val->menu.'</a></li>';
				}
			}
		}
	}
	?>
<!-- </ul> -->

<!-- <ul class="right"> -->
	<?php
	// Right Position
	if($model != null) {
		foreach($model as $val) {
			if($val->position == 'right') {
				//list action
				$arrAction = explode(',', $val->action);
				$arrControllerAction = array();
				if(count($arrAction) > 1) {
					foreach($arrAction as $item) {
						$arrControllerAction[] = ($module !=null ? $module .'/' : '').Yii::app()->controller->id.'/'.$item;
					}
				}else
					$arrControllerAction[] = ($module !=null ? $module .'/' : '').Yii::app()->controller->id.'/'.$val->action;
				
				//attr url
				$arrAttrParams = array();
				if($val->attr != '-') {
					$arrAttr = explode(',', $val->attr);
					if(count($arrAttr) > 0) {
						foreach($arrAttr as $row) {
							$part = explode('=', $row);
							if(strpos($part[1], '$_GET') !== false) {
								$list = explode('*', $part[1]);
								if(count($list) == 2)
									$arrAttrParams[$part[0]] = $_GET[$list[1]];
								elseif(count($list) == 3)
									$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
								elseif(count($list) == 4)
									$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
								elseif(count($list) == 5)
									$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
								
							}else
								$arrAttrParams[$part[0]] = $part[1];
						}
					}
				}
			
				$link = $val->url != 'javascript:void(0);' ? Yii::app()->controller->createUrl($val->url, $arrAttrParams) : 'javascript:void(0);';
				$valueId = $val->dialog == 1 ? 'class="link-dialog" rel="500"' : '';
				$icons = $val->icon == '' ? 'C' : $val->icon;
				if(Yii::app()->controller->id== 'content') {
					/* $link = Yii::app()->createUrl('content/ajaxchoisecategory', array('sid' => $_GET['sid']));
					$valueId = 'id="ajax-on"' ;
					$class = 600;					 */
					
					if(isset($_GET['sid']))
						$arrAttrParams['sid'] = $_GET['sid'];
					elseif(isset($_GET['cid']))
						$arrAttrParams['cid'] = $_GET['cid'];
					$arrAttrParams['t'] = str_replace(' ', '-', strtolower($val->menu));
					
					$link = Yii::app()->createUrl($val->url, $arrAttrParams);
					
				}
				if (in_array($currentAction, $arrControllerAction)) {
					echo '<li><a '.$valueId.' class="'.$val->class.'" href="'.$link.'"><span class="icons">'.$icons.'</span>'.$val->menu.'</a></li>';
				}
			}
		}
	}
	?>
</ul>
