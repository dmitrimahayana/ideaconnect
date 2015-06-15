<?php

/**
 * This is the model class for table "swt_languages".
 *
 * The followings are the available columns in table 'swt_languages':
 * @property string $lang_id
 * @property string $title
 * @property integer $active
 * @property string $iso
 * @property string $code
 * @property string $image
 * @property string $params
 * @property integer $ordering
 *
 * The followings are the available model relations:
 * @property SwtContentCategoriesLang[] $swtContentCategoriesLangs
 * @property SwtContentLang[] $swtContentLangs
 * @property SwtContentSectionLang[] $swtContentSectionLangs
 * @property SwtMenuLang[] $swtMenuLangs
 */
class Languages extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Languages the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_languages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang_id, params', 'required'),
			array('active, ordering', 'numerical', 'integerOnly'=>true),
			array('lang_id', 'length', 'max'=>6),
			array('title, image', 'length', 'max'=>100),
			array('iso, code', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lang_id, title, active, iso, code, image, params, ordering', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'swt_content_categories_langs' => array(self::HAS_MANY, 'SwtContentCategoriesLang', 'lang_id'),
			'swt_content_langs' => array(self::HAS_MANY, 'SwtContentLang', 'lang_id'),
			'swt_content_section_langs' => array(self::HAS_MANY, 'SwtContentSectionLang', 'lang_id'),
			'swt_menu_langs' => array(self::HAS_MANY, 'SwtMenuLang', 'lang_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'lang_id' => Yii::t('label', 'Kode Bahasa'),
			'title' => Yii::t('label', 'Judul'),
			'active' => Yii::t('label', 'Aktif'),
			'iso' => Yii::t('label', 'Iso'),
			'code' => Yii::t('label', 'Kode'),
			'image' => Yii::t('label', 'Gambar'),
			'params' => Yii::t('label', 'Parameter'),
			'ordering' => Yii::t('label', 'Urutan'),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('iso',$this->iso,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('ordering',$this->ordering);
		//$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}

	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		}else {
			$this->defaultColumns[] = 'lang_id';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'active';
			$this->defaultColumns[] = 'iso';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'image';
			$this->defaultColumns[] = 'params';
			$this->defaultColumns[] = 'ordering';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = 'lang_id';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'active';
			$this->defaultColumns[] = 'iso';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'image';
			$this->defaultColumns[] = 'params';
			$this->defaultColumns[] = 'ordering';
		}
		parent::afterConstruct();
	}

	/**
	 * before validate attributes
	 */
	/* protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				$this->verifyPassword = $data;
			
			}else {
				
			}			
		}
		return true;
	} */
	
	/**
	 * before save attributes
	 */
	/* protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->start_date 	= date('Y-m-d', strtotime($this->start_date));			
			}else {
				
			}
		}
		return true;
	} */
	
	/**
	 * After save attributes
	 */
	/* protected function afterSave() {
		parent::afterSave();
		// Create action		
	} */

}