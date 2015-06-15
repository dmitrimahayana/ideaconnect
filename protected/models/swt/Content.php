<?php

/**
 * This is the model class for table "swt_content".
 *
 * The followings are the available columns in table 'swt_content':
 * @property string $id
 * @property integer $content_categories_id
 * @property integer $section_id
 * @property integer $published
 * @property string $parent_id
 * @property string $title
 * @property string $alias_url
 * @property string $intro_text
 * @property string $full_text
 * @property string $meta_key
 * @property string $meta_desc
 * @property string $created_by
 * @property string $modified_by
 * @property string $created
 * @property string $modified
 * @property string $publish_up
 * @property string $publish_down
 * @property string $images
 * @property string $url
 * @property string $params
 * @property integer $ordering
 * @property integer $access
 * @property string $hits
 *
 * The followings are the available model relations:
 * @property SwtContentCategories $contentCategories
 * @property SwtContentCategories $section
 * @property SwtUsers $createdBy
 * @property SwtUsers $modifiedBy
 * @property SwtContentFrontpage[] $swtContentFrontpages
 * @property SwtContentLang[] $swtContentLangs
 */
class Content extends CActiveRecord
{
	public $defaultColumns = array();
	public $getCategory; // fetch cid or sid for redirect aftersave content
	public $oldImage;
	public $author;
	public $quotes;
	// If display_quotes == 0 it means display image instead of quotes
	public $display_quotes = 0;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Content the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_categories_id, section_id, title, alias_url, intro_text, full_text', 'required'),
			array('content_categories_id, section_id, published, ordering, access, display_quotes',
				'numerical', 'integerOnly'=>true),
			array('parent_id, created_by, modified_by, hits, getCategory', 'length', 'max'=>11),
			array('title,source', 'length', 'max'=>80),
			array('alias_url', 'length', 'max'=>200),
			array('images, url, source_url', 'length', 'max'=>255),
			//array('images', 'file', 'allowEmpty' => false, 'types' =>'jpg,JPG,png', 'wrongType'=>'Hanya file jpg, png  yang diijinkan', 'on'=>'create'),
			array('images', 'file', 'allowEmpty' => true, 'types' =>'jpg,JPG,png', 'wrongType'=>'Hanya file jpg, png  yang diijinkan'),
			array('modified, meta_key, meta_desc, created, publish_up, publish_down, images, url, params, oldImage', 'safe'),
			array('author', 'length', 'max' => 75, 'min' => 10),

			// Trim all text
			array('meta_key, meta_desc', 'filter', 'filter' => 'trim'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content_categories_id, section_id, published, parent_id, title, alias_url, intro_text, full_text, meta_key, meta_desc, created_by, modified_by, created, modified, publish_up, publish_down, images, url, params, ordering, access, hits, author, quotes, display_quotes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'content_categories' => array(self::BELONGS_TO, 'ContentCategories', 'content_categories_id'),
			'section'            => array(self::BELONGS_TO, 'ContentSection', 'section_id'),
			'create_by'          => array(self::BELONGS_TO, 'Users', 'created_by'),
			'modify_by'          => array(self::BELONGS_TO, 'Users', 'modified_by'),
			'content_frontpages' => array(self::HAS_MANY, 'ContentFrontpage', 'content_id'),
			'content_langs'      => array(self::HAS_MANY, 'ContentLang', 'content_id'),
			'parent_name'        => array(self::BELONGS_TO, 'Menu', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'content_categories_id' => Yii::t('label', 'Kategori Konten'),
			'section_id' => Yii::t('label', 'Section'),
			'published' => Yii::t('label', 'Diterbitkan'),
			'parent_id' => Yii::t('label', 'Parent'),
			'title' => Yii::t('label', 'Judul'),
			'alias_url' => Yii::t('label', 'Alias Url'),
			'intro_text' => Yii::t('label', 'Teks Pembuka'),
			'full_text' => Yii::t('label', 'Konten'),
			'meta_key' => Yii::t('label', 'Meta Key'),
			'meta_desc' => Yii::t('label', 'Meta Desc'),
			'created_by' => Yii::t('label', 'Created By'),
			'modified_by' => Yii::t('label', 'Modified By'),
			'created' => Yii::t('label', 'Created'),
			'modified' => Yii::t('label', 'Sunting'),
			'publish_up' => Yii::t('label', 'Publish Up'),
			'publish_down' => Yii::t('label', 'Publish Down'),
			'images' => Yii::t('label', 'Gambar'),
			'source' => Yii::t('label', 'Source'),
			'source_url' => Yii::t('label', 'Source Url'),
			'url' => Yii::t('label', 'Url'),
			'params' => Yii::t('label', 'Params'),
			'ordering' => Yii::t('label', 'Ordering'),
			'access' => Yii::t('label', 'Access'),
			'hits' => Yii::t('label', 'Hits'),
			'author'      => Yii::t('admin', 'Author'),
			// 'is_headline' => Yii::t('label', 'Headline'),
			//'section.title' => Yii::t('label', 'Section'),
			//'content_categories.title' => Yii::t('label', 'Categories'),
			'display_quotes' => Yii::t('label', 'Tampilkan quotes atau image'),
		);
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			$this->alias_url = Utility::clearUrl($this->title);

			//echo $this->content_categories_id;
			$model = ContentCategories::model()->findByAttributes(array(
				'id'=>$this->content_categories_id,
			));
			$this->section_id = $model->content_section_id;
			if($this->isNewRecord) {
				if($this->section_id == 1) {
					$this->params = '#INPUT-FIELD#
							content_categories_id=1,
							parent_id=1,
							title=1,
							alias_url=1,
							intro_text=1,
							full_text=1,
							meta_key=1,
							meta_desc=1,
							publish_up=1,
							publish_down=1,
							images=1,
							source=1,
							source_url=1,
							url=1,
							ordering=1,
							published=1
							#END-INPUT-FORM#
							-----
							#DISPLAY-FIELD#
							content_categories_id=1,
							parent_id=1,
							title=0,
							alias_url=1,
							intro_text=1,
							full_text=1,
							meta_key=1,
							meta_desc=1,
							publish_up=1,
							publish_down=1,
							images=1,
							source=1,
							source_url=1,
							url=1,
							ordering=1,
							published=1
							#END-DISPLAY-FIELD#';

				}
			}

		}
		return true;
	}

	/**
	 * Delete images content
	 */
	protected function beforeDelete() {
		if(parent::beforeDelete()) {
			$image = array();
			$image[] = 'article_';
			$image[] = 'article_thumb_';
			$image[] = 'article_firstrow_';
			$image[] = 'headline_';

			$cat = $this->replaceSpaceWithUnderscore($this->content_categories->title);
			$imagePath = Yii::getPathOfAlias('webroot.images.content');
			foreach($image as $fileName) {
				$fname = "{$imagePath}/{$cat}/{$fileName}{$this->images}";
				if(file_exists($fname)) {
					@unlink($fname);
				}
			}
		}
		return true;
	}

	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$params = array();
			$params['display_quotes'] = 0;
			if($this->display_quotes == 1) {
				$params['display_quotes'] = 1;
			}
			$this->params = serialize($params);

			if($this->isNewRecord) {
				$this->created_by = Yii::app()->user->id_user;
				$this->created = $this->modified = date('Y-m-d H:i:s');

			}else {
				$this->created_by = Yii::app()->user->id_user;
				$this->modified   = date('Y-m-d H:i:s');

				if($this->published == 0) {
					$this->publish_down = date('Y-m-d H:i:s');
				}
			}
            $search = array('--', '–');
            $replace = array('-', '%E2%80%93');
            $this->alias_url = str_replace($search, $replace, $this->alias_url);

			$this->images = CUploadedFile::getInstance($this, 'images');
			if($this->images instanceOf CUploadedFile) {
				$cat    = ContentCategories::model()->findByPk($this->content_categories_id);
				$target = Yii::getPathOfAlias('webroot.images.content');
				if(!file_exists($target)) {
					@mkdir($target, 0777, true);
				}

				if($cat !== null) {
					$catDir  = strtolower($this->replaceSpaceWithUnderscore($cat->title));
					$target .= '/'.$catDir;
					if(!file_exists($target)) {
						@mkdir($target, 0777, true);
						@chmod($target, 0777);
					}
				}

				$fileName = time().'_'.$this->replaceSpaceWithUnderscore($this->images->name);
				if($this->images->saveAs($target.'/'.$fileName)) {
					//create thumb image
					Yii::import('ext.phpThumb.PhpThumbFactory');
					$articleImg = PhpThumbFactory::create($target.'/'.$fileName, array('jpegQuality' => 90, 'correctPermissions' => true));
					//$thumb->resizeUp = false;
					$articleImg->adaptiveResize(460, 340);
					$articleImg->save($target.'/article_'.$fileName);
					
					$articleImg->adaptiveResize(120, 80);
					$articleImg->save($target.'/article_thumb_'.$fileName);
					
					$headlineImg = PhpThumbFactory::create($target.'/'.$fileName, array('jpegQuality' => 90, 'correctPermissions' => true));
					$headlineImg->adaptiveResize(640, 290);
					$headlineImg->save($target.'/headline_'.$fileName);
					
					$firstRowArticleImg = PhpThumbFactory::create($target.'/'.$fileName, array('jpegQuality' => 90, 'correctPermissions' => true));
					$firstRowArticleImg->adaptiveResize(280, 210);
					$firstRowArticleImg->save($target.'/article_firstrow_'.$fileName);
					
					//delete temp image
					@unlink($target.'/'.$fileName);
					
					//save to db
					$this->images = $fileName;
					
					//remove old image if currently update
					if(!$this->isNewRecord) {
						@unlink($target.'/article_'.$this->oldImage);
						@unlink($target.'/article_thumb_'.$this->oldImage);
						@unlink($target.'/headline_'.$this->oldImage);
						@unlink($target.'/article_firstrow_'.$this->oldImage);
					}
				}
			}else{
				$temp=self::model()->findByPk($this->primaryKey);
				$this->images=$temp->images;
			}
				
			// If meta desc empty, fill with intro text
			if(empty($this->meta_desc))
				$this->meta_desc = $this->intro_text;

			if($this->published == 1) {
				$this->publish_up = date('Y-m-d H:i:s');
			}
		}
		return true;
	}


	/**
	 * After save attributes
	 */
	/* protected function afterSave() {
		parent::afterSave();
		// Create action
	} */

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$action = strtolower(Yii::app()->controller->action->id);
		$criteria=new CDbCriteria;

		$criteria->compare('content_categories_id',$this->content_categories_id);
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('published',$this->published);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias_url',$this->alias_url,true);
		$criteria->compare('intro_text',$this->intro_text,true);
		$criteria->compare('full_text',$this->full_text,true);
		$criteria->compare('meta_key',$this->meta_key,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('date(modified)',$this->modified);
		$criteria->compare('publish_up',$this->publish_up,true);
		$criteria->compare('publish_down',$this->publish_down,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('source_url',$this->source_url,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('access',$this->access);
		$criteria->compare('hits',$this->hits,true);
		// $criteria->compare('is_headline',$this->is_headline);
		if(!isset($_GET['Content_sort']))
			$criteria->order = 'modified DESC';
		$criteria->with = array('create_by');
		
/*		if($action == 'headline'){
			$criteria->condition = 'is_headline = 1';
		}*/
		$attr = $this->getAttributeNames();
		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
			'sort' => array(
				'attributes' => CMap::mergeArray(
					$attr,
					array( 
						'author' => array(
							'asc' => 'create_by.name ASC',
							'desc' => 'create_by.name DESC',
							'default' => 'asc'
						)
					)
				)
			)
		));
	}

	/**
	 * Get list attributes from current model
	 *
	 * @return array list attributes
	 */
	public function getAttributeNames() {
		$result = array();
		foreach($this->attributes as $attrName => $val) {
			$result[] = $attrName;
		}
		return $result;
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
			// $this->defaultColumns[] = 'content_categories_id';
			// $this->defaultColumns[] = 'section_id';
			// $this->defaultColumns[] = 'parent_id';
			// $this->defaultColumns[] = 'publish';
			// $this->defaultColumns[] = 'title';
			// $this->defaultColumns[] = 'alias_url';
			// $this->defaultColumns[] = 'intro_text';
			// $this->defaultColumns[] = 'full_text';
			$this->defaultColumns[] = 'author';
			// $this->defaultColumns[] = 'modified_by';
			$this->defaultColumns[] = 'created';
			// $this->defaultColumns[] = 'modified';
			// $this->defaultColumns[] = 'published';
			// $this->defaultColumns[] = 'hits';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		$contentCat = CHtml::listData(ContentCategories::model()->findAll(array(
						'select' => 'id, title'
					)),'id','title');
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'title',
				'value' => '$data->title',
				'htmlOptions' => array(
					'class' => 'large',
				)
			);			
			$this->defaultColumns[] = array(
				'name' => 'content_categories_id',
				'value' => '$data->content_categories->title',
				'htmlOptions'	=> array('class' => 'center'),
				'filter'		=> $contentCat,
			);			
/*			$this->defaultColumns[] = array(
				'name' => 'intro_text',
				'value' => 'Utility::shortText($data->intro_text,100)'
			);*/
			$this->defaultColumns[] = array(
				'name'			=> 'published',
				'value'			=> '$data->published ? Utility::getPublishedToImg($data->published) : CHtml::link(Utility::getPublishedToImg($data->published), ContentController::activateUrl($_GET[id], $data->primaryKey))',
				'type'		=> 'raw',
				'htmlOptions'	=> array('class' => 'center'),
				'filter'		=> array(0 => 'Tidak', 1 => 'Ya'),
			);	
/*			$this->defaultColumns[] = array(
				'name'			=> 'is_headline',
				'value'			=> '$data->is_headline ? Utility::getPublishedToImg($data->is_headline) : Utility::getPublishedToImg($data->is_headline)',
				'type'		=> 'raw',
				'htmlOptions'	=> array('class' => 'center'),
				'filter'		=> array(0 => 'Tidak', 1 => 'Ya'),
			);*/
			
			/*$this->defaultColumns[] = array(
				'header'	=> 'Tipe',
				'value'		=> '$data->online == 1 ? "Apply" : "Non Apply"',
				'name'		=> 'job_type'
			);*/
			$this->defaultColumns[] = array(
				'name'			=> 'modified',
				'value'			=> 'date("d-m-Y", strtotime($data->modified))',
				'htmlOptions'	=> array('class' => 'center'),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$this, 
                'attribute'=>'modified', 
                'language' => 'ja',
                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
                'htmlOptions' => array(
                    'id' => 'datepicker_for_modified',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true),
			);
		}
		parent::afterConstruct();
	}

	protected function afterFind() {
		$this->author = $this->create_by->name;
		if(trim($this->meta_key) == '')
			$this->meta_key = '-';

		if(trim($this->meta_desc) == '')
			$this->meta_desc = '-';

		$params = unserialize($this->params);
		if(is_array($params) && count($params) > 0) {
			$this->display_quotes = 0;
			if(array_key_exists('display_quotes', $params)) {
				$this->display_quotes = $params['display_quotes'];
			}
		}
		parent::afterFind();
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
	 * replace space with underscore
	 *
	 * @return string
	 */
	public function replaceSpaceWithUnderscore($fileName) {
		return str_ireplace(' ', '_', strtolower(trim($fileName)));
	}
	
	protected function afterSave(){
		//cek user actived subscribe
/*		Yii::import('application.modules.member.models.CcnSubscribeContent');
		Yii::import('application.modules.email.models.CcnEmailTemplate');
		$allUser = CcnSubscribeContent::model()->findAll();
		if($allUser != null){
			foreach($allUser as $val){
				if($val->content_category == $this->content_categories->title){
					$user = Users::model()->findByPk($val->swt_users_id);
					$activationTemplate = CcnEmailTemplate::model()->find(array(
						'condition' => 'name = :name',
						'params' => array(
							':name' => 'email_subscribe',
						),
					));
					$date = date('d F Y');
					$email = $user->email;
					$content .= 'Berikut ini artikel terbaru dari kami tentang '.$this->title.' :<br/>';
					$content .= '<a href="'.Yii::app()->createUrl('content/view/'.$this->id.'/'.$this->title.'').'">'.Yii::app()->createUrl('content/view/'.$this->id.'/'.$this->title.'').'</a>';
					$key = Users::model()->hashPassword($user->mobile_no);
					$email = $user->email;
					$unsubscribe = Yii::app()->createUrl('site/unsubscribe', array('key'=>$key,'email'=>$email,'type'=>'content'));
					$replace = array(
						$date, $email, $content, $unsubscribe
					);

					$search = array(
						'{$tanggal}','{$email}','{$content}','{$unsubscribe}',
					);
					$webOption = WebOption::model()->findByPk(1);
					$msg = str_ireplace($search, $replace, $activationTemplate->message);
					
					Utility::sentEmail($webOption->email_admin, 'PCR', $user->email, $user->name, 'Berita Terbaru', $msg);
				}
			}
		}*/
	}
	
	/**
	 * @return boolean, check subscribe vacancy enabled
	 */ 
	 public function isSubscribeEnabled($id){
		Yii::import('application.modules.member.models.CcnSubscribeContent');
		$cekSubscribeNews = CcnSubscribeContent::model()->findByAttributes(array('swt_users_id'=>$id));
		
		if($cekSubscribeNews != null){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}

	public function listDataContentCategories()	{
		$listcategoris = array();
		$categories    = ContentCategories::model()->findAll(array(
			'condition'=>'parent_id = 0', 
			'order' => 'title ASC')); 
		if($categories !== null) {
			foreach($categories as $val) {
				$parent = ContentCategories::model()->findByPk($val->parent_id);
				$listCategories[] = array('id'=>$val->id,'text'=>$val->title,'group'=>$parent->title);
			}
		}
		
		return $listCategories;
	}

	/**
	 * image view for adminview
	 *
	 * @return string
	 */
	public function getImage($idContent) {
		$model = self::model()->findByPk($idContent);
		if($model->images == '') {
			$result = '-';
		}else {
			$cat = $this->replaceSpaceWithUnderscore($model->content_categories->title);
			$result = CHtml::image(Yii::app()->baseUrl.'/images/content/'. $cat
				. '/article_thumb_'.$model->images, $model->images);
		}
		
		return $result;
	}	
}
