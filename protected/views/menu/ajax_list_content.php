	<?php
	if($destType == 'module') {
		if($model != null) {			
			foreach($model as $val) {
				$arrOption[$val->name] = $val->name;
			}
			echo CHtml::radioButtonList('id_dest', '', $arrOption);
		}else
			echo 'Module is empty';
		
		
	}elseif($_POST['dest_type'] == 'content_section') {		
		if($model != null)  {			
			foreach($model as $val) {
				$arrOption[$val->id] = $val->title;
			}
			echo CHtml::radioButtonList('id_dest', '', $arrOption);
		}else
			echo 'Section is empty';

	}elseif($_POST['dest_type'] == 'content_category') {
		if($model != null)  {			
			foreach($model as $val) {
				$arrOption[$val->id] = $val->title;
			}
			echo CHtml::radioButtonList('id_dest', '', $arrOption);
		}else
			echo 'Category is empty';
		
	}elseif($_POST['dest_type'] == 'content_detil') {
		if($model != null) {
			echo '<h3>Static Content</h3><div style="height:140px;width:520px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">';
			foreach($model as $val) {
				$arrOption[$val->id] = $val->title;
			}
			echo CHtml::radioButtonList('id_dest', '', $arrOption);
			echo '</div>';
		}else
			echo 'Content is empty';
		
	}elseif($_POST['dest_type'] == 'contact_detail') {
		if($model != null) {
			foreach($model as $val) {
				$arrOption[$val->id] = $val->name;
			}
			echo CHtml::radioButtonList('id_dest', '', $arrOption);
		}else
			echo 'Contact Data is empty';
	}
	?>
