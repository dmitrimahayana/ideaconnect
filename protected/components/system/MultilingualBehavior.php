<?php

class MultilingualBehavior extends CActiveRecordBehavior
{

	public $langClassName;
	public $langForeignKey;
	public $langField = 'lang_id';
	public $localizedAttributes;
	public $languages;
	public $primaryLang;
	public $createScenario = 'insert';
	
	//relation name that will be checked for replacing attributes with translations
	public $relName1 = 'i18n';

	//relation name that will be checked for adding virtual attributes
	public $relName2 = 'multilang';

	//when using relName1, overwrite fields with translations 
	// even if translations are empty?
	public $forceOverwrite=false;

	//force delete translations when parent is deleted? (
	//not needed if using foreign keys with 'on delete cascade)
	public $forceDelete = true; 
	
	private $_langAttributes = array();
	
	public function attach($owner) {
		parent::attach($owner);

		if (!isset($this->langClassName)) {
			$this->langClassName = get_class($owner).'Lang';
		}
		if (!isset($this->langForeignKey)) {
			$this->langForeignKey = str_replace(array('{{','}}'),'',$owner->tableName()).'_id';
		}
		if (array_values($this->languages)!== $this->languages) { //associative array
			$this->languages = array_keys($this->languages);
		}      
	}

	public function hasLangAttribute($name) {
		return array_key_exists($name, $this->_langAttributes);
	}

	public function getLangAttribute($name) {
		return $this->_langAttributes[$name];
	}

	public function setLangAttribute($name, $value) {
		$this->_langAttributes[$name] = $value;
	}

	function afterConstruct() {
		$owner = $this->getOwner(); // Model bersangkutan misalnya News
		if ($owner->scenario==$this->createScenario) {
			$obj = new $this->langClassName;
			foreach ($this->languages as $lang)
				foreach ($this->localizedAttributes as $field)
					$this->setLangAttribute($field.'_'.$lang, $obj->$field);
		}
	}

	public function afterFind() {
		$obj = $this->getOwner();
		if ($obj->hasRelated($this->relName1)) {
			$related = $obj->getRelated($this->relName1);
			if ($row = current($related)) {
				foreach ($this->localizedAttributes as $field)
					if (isset($obj->$field) && (!empty($row[$field]) || $this->forceOverwrite)) $obj->$field = $row[$field];
			}
		} else if ($obj->hasRelated($this->relName2)) {
			$related = $obj->getRelated($this->relName2);
			foreach ($this->languages as $lang)
				foreach ($this->localizedAttributes as $field)
					$this->setLangAttribute($field.'_'.$lang, isset($related[$lang][$field])?$related[$lang][$field]:null);
		}
	}

	public function afterSave() {
		$owner = $this->getOwner();
		$ownerPk = $owner->getPrimaryKey();
		$rs = array();
		if (!$owner->isNewRecord) {
			$model = call_user_func(array($this->langClassName, 'model'));
			$c = new CdbCriteria();
			$c->condition="{$this->langForeignKey}=:id";
			$c->params=array('id'=>$ownerPk);
			$c->index=$this->langField;
			$rs = $model->findAll($c);              
		}
		foreach ($this->languages as $lang) {
			if (!isset($rs[$lang])) {
				$obj = new $this->langClassName;          
				$obj->{$this->langField} = $lang;
				$obj->{$this->langForeignKey} = $ownerPk;          
			} else {
				$obj = $rs[$lang];
			}
			foreach ($this->localizedAttributes as $field) {
				$value = $this->getLangAttribute($field.'_'.$lang);
				$obj->$field = $value;
			}
			$obj->save(false);
		}

	}
    
  public function afterDelete() {
		if ($this->forceDelete) {
			$ownerPk = $this->getOwner()->getPrimaryKey();
			$model = call_user_func(array($this->langClassName, 'model'));
			$model->deleteAll("{$this->langForeignKey}=:id",array('id'=>$ownerPk));
		}
  }
}
