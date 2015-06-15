<?php //begin.Mainmenu ?>
<?php 
if($menus != null) { ?>
	<ul>
		<?php
		
		foreach($menus as $val) {
			/* Get arrUrlGroup (menu group class active) */
			//find selected menu
			$arrUrl = explode('/', $val->url);
			$arrUrlGroup = array();
			$attr = '';
			 //list content
			if($controller == 'content' && $val->controller == 'content') {
				$partUrl = explode('cid', $val->url);
				$cid = str_replace('/', '', $partUrl[1]);
				if($val->dest_type == 'content_detil') { //content static
					$controllerAction = $controller.'/'.$action.'/'.$_GET['id'].'?cid='.$_GET['cid'];					
					$arrUrlGroup[] =  $arrUrl[0] .'/'. $arrUrl[1].'/'.$arrUrl[2];
					if($action == 'adminedit') {
						$controllerAction = $controller.'/adminedit/x?cid='.$_GET['cid'];
						$arrUrlGroup[] =  $controller.'/adminedit/x?cid'. $cid;
					}
					
				}else {	//list contents
					if($cid == $_GET['cid']) {
						if($action == 'adminmanage') {
							if(isset($_GET['sid']))
								$cat = 'sid';
							elseif(isset($_GET['cid']))
								$cat = 'cid';
							$controllerAction = $controller.'/adminmanage/'.$cat.'/'.$_GET[$cat];
							$arrUrlGroup[] =  $arrUrl[0] .'/'. $arrUrl[1].'/'.$cat.'/'.$arrUrl[3];
						}else {
							if($action == 'adminview') {
								$controllerAction = $controller.'/adminview/x?cid='.$_GET['cid'];								
								$arrUrlGroup[] =  $controller.'/adminview/x?cid='. $cid;
							}elseif($action == 'adminedit') {
								$controllerAction = $controller.'/adminedit/x?cid='.$_GET['cid'];
								$arrUrlGroup[] =  $controller.'/adminedit/x?cid='. $cid;
							}elseif($action == 'adminadd') {
								$controllerAction = $controller.'/adminadd/cid/'.$_GET['cid'];
								$arrUrlGroup[] =  $arrUrl[0] .'/adminadd/cid/'.$arrUrl[3];
							}
						}
					}
				}
					
			}else { //other controller content				
				
				$controllerAction = ($module != null ? $module .'/' : ''). $controller.'/'.$action;
				if($val->module != '-') {	//module menu
					$arrUrlGroup[] = $val->module.'/'.$val->controller.'/'.$val->action . $attr;
					if($action == 'adminview') {
						$arrUrlGroup[] =  $val->module.'/'.$val->controller.'/adminview';
					}elseif($action == 'adminedit') {
						$arrUrlGroup[] =  $val->module.'/'.$val->controller.'/adminedit';
					}elseif($action == 'adminadd') {
						$arrUrlGroup[] =  $val->module.'/'.$val->controller.'/adminadd';
					}
				}else {
					if($controller == $val->controller) {
						$arrUrlGroup[] = $controller.'/'.$val->action;
						if($action == 'adminview') {
							$arrUrlGroup[] =  $controller.'/adminview';
						}elseif($action == 'adminedit') {
							$arrUrlGroup[] =  $controller.'/adminedit';
						}elseif($action == 'adminadd') {
							$arrUrlGroup[] =  $controller .'/adminadd';
						}
					}							
				}
			}
			
			
			
			//fecth sub menu			
			$subMenu = Menu::model()->findAll(array(
				'select' => 'id, name, in_use, module, controller, action, attr_url, url, alias_url, com_modules_id',
				'condition' => 'id IN ('.$listMenuId.') AND published = 1 AND parent = :id',
				'params' => array(':id' => $val->id),
				'order' => 'ordering',
			));
			if($subMenu != null) {
				foreach($subMenu as $item) {
					$arrUrl = explode('/', $item->url);
					
					if($item->module != '-') {	//module menu
						$arrUrlGroup[] = $item->module.'/'.$item->controller.'/'.$item->action . $attr;
						if($action == 'adminview') {
							$arrUrlGroup[] =  $item->module.'/'.$item->controller.'/adminview';
						}elseif($action == 'adminedit') {
							$arrUrlGroup[] =  $item->module.'/'.$item->controller.'/adminedit';
						}elseif($action == 'adminadd') {
							$arrUrlGroup[] =  $item->module.'/'.$item->controller.'/adminadd';
						}
					}else {
						$arrUrlGroup[] = $item->controller.'/'.$item->action . $attr;
						if($action == 'adminview') {
							$arrUrlGroup[] =  $item->controller.'/adminview';
						}elseif($action == 'adminedit') {
							$arrUrlGroup[] =  $item->controller.'/adminedit';
						}elseif($action == 'adminadd') {
							$arrUrlGroup[] = $item->controller.'/adminadd';
						}
					}
						
					//fetch child subMenu
					$childMenu = Menu::model()->findAll(array(
						'select' => 'id, module, controller, action, attr_url, url, com_modules_id',
						'condition' => 'id IN ('.$listMenuId.') AND published = 1 AND parent = :id',
						'params' => array(':id' => $item->id),
						'order' => 'ordering',
					));
					if($childMenu != null) {
						foreach($childMenu as $row) {
							$arrUrl = explode('/', $row->url);
							if($row->module != '-') {	//module menu
								$arrUrlGroup[] = $row->module.'/'.$row->controller.'/'.$row->action . $attr;
								if($action == 'adminview') {
									$arrUrlGroup[] =  $row->module.'/'.$row->controller.'/adminview';
								}elseif($action == 'adminedit') {
									$arrUrlGroup[] =  $row->module.'/'.$row->controller.'/adminedit';
								}elseif($action == 'adminadd') {
									$arrUrlGroup[] =  $row->module.'/'.$row->controller.'/adminadd';
								}
							}else {
								$arrUrlGroup[] = $row->controller.'/'.$row->action . $attr;
								if($action == 'adminview') {
									$arrUrlGroup[] =  $row->controller.'/adminview';
								}elseif($action == 'adminedit') {
									$arrUrlGroup[] =  $row->controller.'/adminedit';
								}elseif($action == 'adminadd') {
									$arrUrlGroup[] = $row->controller.'/adminadd';
								}
							}
						}
					}						
				}
			}
			
			//check for testing (by didik)
			/* echo '# '.$val->name. ' # url: '.$val->url.' # (CA: '.$controllerAction.') # '. '$cid='.$cid.' # ';
			print_r($arrUrlGroup);
			echo '<br>'; */
			/* End Get arrUrlGroup (menu group class active) */
		?>
			<li<?php echo $val->in_use == 1 ? (in_array($controllerAction, $arrUrlGroup) ? ' class="active"' : '') : ' class="disable"'; ?>>
				<?php $link = Menu::model()->createLink($val->url, $val->module, $val->controller, $val->action, $val->attr_url, $val->alias_url);
				
				?>
				<a <?php echo $subMenu != null ? 'class="child"' : '';?>href="<?php echo $link;?>" title="<?php echo $val->in_use == 1 ? $val->name : 'Menu '.$val->name.' ini belum di pakai'?>"><?php echo $val->name?></a>
					<?php 
					//print sub menu & child menu
					if($subMenu != null) {
						$print = '<ul>';
						foreach($subMenu as $item) {
							//fetch child subMenu
							$childMenu = Menu::model()->findAll(array(
								'select' => 'id, name, module, controller, action, attr_url, url, alias_url',
								'condition' => 'id IN ('.$listMenuId.') AND published = 1 AND parent = :id',
								'params' => array(':id' => $item->id),
								'order' => 'ordering',
							));
							$child = $childMenu != null ? 'class="child"' : '';
							
							$modelControllerAction =  ($item->module != '-' ? $item->module .'/' : ''). $item->controller.'/'.$item->action;
							$link = Menu::model()->createLink($item->url, $item->module, $item->controller, $item->action, $item->attr_url, $item->alias_url);
							$print .= '<li '. ($item->in_use == 1 ? /*(($modelControllerAction == $controllerAction ? ' class="active"' : ''))*/ '' : ' class="disable"').'>';
							$print .= '<a '.$child.' href="'.$link.'" title="'.($item->in_use == 1 ? $item->name : 'Menu '.$item->name.' ini belum di pakai').'"><span class="icons">C</span>'.$item->name.'</a>';
							if($childMenu != null) {
								$print .= '<ul>';
								foreach($childMenu as $row){
									$link = Menu::model()->createLink($row->url, $row->module, $row->controller, $row->action, $row->attr_url, $row->alias_url);
									$print .= '<li><a href="'.$link.'" title="'.$row->name.'"><span class="icons">C</span>'.$row->name.'</a></li>';
								}
								$print .= '</ul>';
							}
							$print .= '</li>';
							
						}
						$print .= '</ul>';
						echo $print;
					}
					?>				
			</li>
		<?php 			
		}?>
	</ul>
<?php 
}else {?>
		No menu
<?php }?>
<?php //end.Mainmenu ?>
