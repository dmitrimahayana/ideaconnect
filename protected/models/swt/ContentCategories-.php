<?php

/**
 * This is the model class for table "swt_content_categories".
 *
 * The followings are the available columns in table 'swt_content_categories':
 * @property integer $id
 * @property integer $content_section_id
 * @property integer $parent_id
 * @property string $title
 * @property string $alias_url
 * @property string $description
 * @property string $image
 * @property string $image_position
 * @property integer $published
 * @property string $editor
 * @property integer $ordering
 * @property integer $access
 * @property string $params
 *
 * The followings are the available model relations:
 * @property SwtContent[] $swtContents
 * @property SwtContent[] $swtContents1
 * @property SwtContentSection $contentSection
 * @property SwtContentCategoriesLang[] $swtContentCategoriesLangs
 */
class ContentCategories extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return ContentCategories the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_content_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_section_id, title, description', 'required'),
			array('content_section_id, parent_id, published, ordering, access', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>80),
			array('alias_url', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('image_position', 'length', 'max'=>30),
			array('editor', 'length', 'max'=>50),
			array('params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content_section_id, parent_id, title, alias_url, description, image, image_position, published, editor, ordering, access, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'contents' => array(self::HAS_MANY, 'Content', 'content_categories_id'),
			'contents1' => array(self::HAS_MANY, 'Content', 'section_id'),
			'content_section' => array(self::BELONGS_TO, 'ContentSection', 'content_section_id'),
			'content_categories_langs' => array(self::HAS_MANY, 'ContentCategoriesLang', 'content_categories_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'content_section_id' => Yii::t('label', 'Bagian Konten'),
			'parent_id' => Yii::t('label', 'Parent'),
			'title' => Yii::t('label', 'Nama Kategori'),
			'alias_url' => Yii::t('label', 'Alias Url'),
			'description' => Yii::t('label', 'Deskripsi'),
			'image' => Yii::t('label', 'Gambar'),
			'image_position' => Yii::t('label', 'Posisi Gambar'),
			'published' => Yii::t('label', 'Diterbitkan'),
			'editor' => Yii::t('label', 'Redaktur'),
			'ordering' => Yii::t('label', 'Ordering'),
			'access' => Yii::t('label', 'Access'),
			'params' => Yii::t('label', 'Params'),
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
		if(Yii::app()->user->id != 1)
			$criteria->AddCondition('id != 1');
		$criteria->compare('content_section_id',$this->content_section_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias_url',$this->alias_url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('image_position',$this->image_position,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('editor',$this->editor,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('access',$this->access);
		$criteria->compare('params',$this->params,true);
		$criteria->order = 'content_section_id';
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
			$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'content_section_id';
			$this->defaultColumns[] = 'parent_id';
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'alias_url';
			$this->defaultColumns[] = 'description';
			$this->defaultColumns[] = 'image';
			$this->defaultColumns[] = 'image_position';
			$this->defaultColumns[] = 'published';
			$this->defaultColumns[] = 'editor';
			$this->defaultColumns[] = 'ordering';
			$this->defaultColumns[] = 'access';
			$this->defaultColumns[] = 'params';
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
			//$this->defaultColumns[] = 'id';
			/* $this->defaultColumns[] = 'content_section_id';
			$this->defaultColumns[] = 'parent_id'; */
			$this->defaultColumns[] = 'title';
			$this->defaultColumns[] = 'alias_url';
			$this->defaultColumns[] = 'description';
			//$this->defaultColumns[] = 'image';
			//$this->defaultColumns[] = 'image_position';
			$this->defaultColumns[] = array(
				'header'	=> 'Diterbitkan',
				'value'		=> 'Utility::getPublishedToImg($data->published)',
				'type'		=> 'html',
				'htmlOptions'	=> array('class' => 'center')
			);
			//$this->defaultColumns[] = 'editor';
			//$this->defaultColumns[] = 'ordering';
			//$this->defaultColumns[] = 'access';
			//$this->defaultColumns[] = 'params';
		}
		parent::afterConstruct();
	}

	/**
	 * Get params	 setting
	 *	@param int categories_id, str $startType, str $endType
	 * @return array params
	 */
	 public function getParams($id, $startType, $endType)  {
		$result = array();
		$model = self::model()->findByPk($id, array('select'=>'params'));
		if($model != null) {			
			$arrParams = explode('-----', $model->params);
			foreach($arrParams as $key=>$val) {
				if(strpos($val, $startType) !== false)
					$index = $key;
			}
			$replaces = str_replace(array($startType, $endType), array('', ''), $arrParams[$index]);
			$listParams = explode(',', $replaces);
			foreach($listParams as $val) {
				$part = explode('=', $val);
				$result[trim($part[0])] = trim($part[1]);		
			}
		}
		return $result;
	 }

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				$this->content_section_id = 2;
			}else {
				
			}			
		}
		return true;
	}
	
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