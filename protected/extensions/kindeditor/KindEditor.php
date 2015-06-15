<?php

class KindEditor extends CInputWidget{
	private $language = 'en';
	public $items = array();

	public function getAssetsPath()
	{
		//$baseDir = dirname(__FILE__);
		//return Yii::app()->getAssetManager()->publish($baseDir.DIRECTORY_SEPARATOR.'assets');
		return Yii::app()->baseUrl.'/kindeditor';
	}

	public function makeOptions()
	{
		list($name, $id) = $this->resolveNameID();

		$assets = $this->getAssetsPath();
		$cssPath = $assets . '/plugins/code/prettify.css';
		$uploadJson = $assets . '/php/upload_json.php';
		$fileManagerJson = $assets . '/php/file_manager_json.php';

		$script = <<<EOP

$(function() {
	var editor = KindEditor.create('textarea[id="{$id}"]', {
		langType : '{$this->language}',
		cssPath : '{$cssPath}',
		uploadJson : '{$uploadJson}',
		fileManagerJson : '{$fileManagerJson}',
		allowFileManager : true,
		afterCreate : function() {
			var self = this;
			KindEditor.ctrl(document, 13, function() {
				self.sync();
				KindEditor('form')[0].submit();
			});
			KindEditor.ctrl(self.edit.doc, 13, function() {
				self.sync();
				KindEditor('form')[0].submit();
			});
		}
	});
	prettyPrint();
	});

EOP;
		return $script;
	}

	/**
	 * Renders the items.
	 * @param array $items the item configuration.
	 */
	protected function renderItems($items)
	{
		$script = '';
		foreach ($items as $key => $item)
		{
			if(is_array($item))
			{
				$script = $script."'$key':[";
				foreach ($item as $value)
					$script = $script."'$value',";
				$script = $script."],";
			} else
				$script = $script."'$key':'$item',";
		}
		return $script;
	}
	
    public function run(){
        parent::run();
        $assets = Yii::app()->baseUrl.'/kindeditor';//$this->getAssetsPath();
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($assets.'/themes/default/default.css');
        $cs->registerCssFile($assets.'/plugins/code/prettify.css');
        $cs->registerScriptFile($assets.'/kindeditor.js',CClientScript::POS_END);
        $cs->registerScriptFile($assets.'/lang/en.js',CClientScript::POS_END);
        $cs->registerScriptFile($assets.'/plugins/code/prettify.js',CClientScript::POS_END);
        $cs->registerScript('content',$this->makeOptions(),CClientScript::POS_END);
    }
}
?>