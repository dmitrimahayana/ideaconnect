<?php
require_once($fckeditor);

$oFCKeditor = new FCKeditor(get_class($model).'['.$attribute.']');
$oFCKeditor->BasePath = $fckBasePath;
$oFCKeditor->Value = $model->$attribute != null ? $model->$attribute : $value;
$oFCKeditor->Width  = $width ;
$oFCKeditor->Height = $height ;
$oFCKeditor->ToolbarSet = $toolbarSet ;
if(isset($config) && is_array($config)){
	foreach($config as $key=>$value){
		$oFCKeditor->Config[$key] = $value;
	}
}
$oFCKeditor->Create();
?>