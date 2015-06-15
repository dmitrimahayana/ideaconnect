<?php
class FCKEditorWidget extends CInputWidget {
	public $height = "375px";
	public $width = "100%";
	public $config;
	public $fckeditor;
	public $fckBasePath;
	public $toolbarSet;
	public $name;
	public $value;

	public function run() {
		
		if(!isset($this->fckeditor)) {
			throw new CHttpException(500,'"fckeditor" have to be set!');
		}
		if(!isset($this->fckeditor)) {
			throw new CHttpException(500,'"fckBasePath" have to be set!');
		}
		if(!isset($this->model) && !isset($this->name)) {
			throw new CHttpException(500,'"model" have to be set!');
		}
		if(!isset($this->attribute) && !isset($this->name)) {
			throw new CHttpException(500,'"attribute" have to be set!');
		}
		if (!isset($this->model) && !isset($this->attribute) && !isset($this->name)) {
			throw new CHttpException(500,'"name" have to be set!');
		}
		
		
		if(!isset($this->toolbarSet)) {
			$this->toolbarSet = "Default";
		}
		
		
		$controller = $this->controller;
		$action = $controller->action;
		$this->render('fckeditor_view', array(
			"fckBasePath"=>$this->fckBasePath,
			"fckeditor"=>$this->fckeditor,
			"model"=>$this->model,
			"attribute"=>$this->attribute,
			"name"=>$this->name,
			"height"=>$this->height,
			"width"=>$this->width,
			"toolbarSet"=>$this->toolbarSet,
			"config"=>$this->config,
			"value"=>$this->value,
		));
	}
}
?>