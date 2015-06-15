<?php

/**
 * This is the model class for table "swt_com_widgets".
 *
 * The followings are the available columns in table 'swt_com_widgets':
 * @property integer $id
 * @property integer $com_modules_id
 * @property string $title
 * @property string $content
 * @property integer $ordering
 * @property string $hook_position
 * @property integer $enabled
 * @property string $widget
 * @property integer $access
 * @property integer $show_title
 * @property string $params
 *
 * The followings are the available model relations:
 * @property SwtComModules $comModules
 */
class ComWidgets extends CActiveRecord
{
	private $_oldOrder;       // Store ordering value before editing
	private $_prevWidgetId;   // Detect previous widget id for ordering necessary
	private $_tempDirToDelete = array();

	public $file_name;        // For handle upload widget
	public $overwriteWidget;
	public $backupWidgetType; // Backup widget type

	/**
	 * Returns the static model of the specified AR class.
	 * @return ComWidgets the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_com_widgets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('access', 'required'),
			array('com_modules_id, ordering, enabled, show_title', 'numerical', 'integerOnly'=>true),
			array('hook_position, widget', 'length', 'max'=>50),
			array('title, content', 'length', 'max' => 256),
			array('widget_type, backupWidgetType', 'length', 'max' => 45),
			array('widget_path', 'length', 'max' => 128),
			array('file_name', 'file', 'types' => 'zip', 'allowEmpty' => true),
			array('widget_type', 'filter', 'filter' => 'trim'),
			// array('file_name', 'safe', 'on' => 'file_empty'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, com_modules_id, title, content, ordering, hook_position, enabled, widget, access,
				show_title, params', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'com_modules' => array(self::BELONGS_TO, 'ComModules', 'com_modules_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id'             => Yii::t('label', 'ID'),
			'com_modules_id' => Yii::t('label', 'Nama Module'),
			'title'          => Yii::t('label', 'Title'),
			'content'        => Yii::t('label', 'Content'),
			'ordering'       => Yii::t('label', 'Ordering'),
			'hook_position'  => Yii::t('label', 'Hook Position'),
			'enabled'        => Yii::t('label', 'Enabled'),
			'widget'         => Yii::t('label', 'Widget'),
			'access'         => Yii::t('label', 'Access'),
			'show_title'     => Yii::t('label', 'Show Title'),
			'params'         => Yii::t('label', 'Params'),
			'file_name'      => Yii::t('label', 'Nama file'),
			'widget_type'    => Yii::t('label', 'Tipe widget'),
			'widget_path'    => Yii::t('label', 'Path widget'),
		);
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
		}
		return true;
	}

	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$this->access = implode(',', $this->access);
			if(trim($this->backupWidgetType) != '') {
				$this->widget_type = strtolower(trim($this->backupWidgetType));
			}

			if($this->isNewRecord) {
				$this->ordering = $this->getNextOrderPosition($this->hook_position);

				if($this->file_name instanceOf CUploadedFile) {
					if(!$this->file_name->hasError) {
						if(!file_exists(Yii::app()->runtimePath.'/temp')) {
							@mkdir(Yii::app()->runtimePath.'/temp');
							@chmod(Yii::app()->runtimePath.'/temp', 777);
						}

						$filePath = Yii::app()->runtimePath.'/temp/'.$this->file_name->name;
						if($this->file_name->saveAs($filePath)) {
							// Extract widget file to runtime/temp
							$zip        = new ZipArchive;
							$zipFile    = $zip->open($filePath);
							$extractTo  = explode('.', $fileName->name);
							$folderName = $this->getFolderName($filePath);

							if($zipFile == true) {
								if($zip->extractTo(Yii::app()->runtimePath.'/temp/')) {
									Utility::chmodr(Yii::app()->runtimePath.'/temp', 0777);
								}
								$zip->close();

								Utility::chmodr(Yii::app()->runtimePath.'/temp/'.$folderName, 0777);
								// Load widget setting
								Yii::import('ext.Spyc');
								$widgetType = explode('_', trim($this->file_name->name, ".{$this->file_name->extensionName}"));
								$yamlName   = $widgetType[0];
								$widgetType = end($widgetType);
								$setting    = Spyc::YAMLLoad(Yii::app()->runtimePath.'/temp/'.$folderName.
									'/'. $yamlName.'.yaml');

								// Save list dir and files have to deleted after extract finished.
								$this->_tempDirToDelete[] = Yii::app()->runtimePath.'/temp/'.$folderName;
								$this->_tempDirToDelete[] = Yii::app()->runtimePath.'/temp/'.$this->file_name->name;

								// Move widget to appropriate place
								if($widgetType == 'static') {
									Utility::recursiveCopy(Yii::app()->runtimePath.'/temp/'.$folderName,
										Yii::getPathOfAlias('application.widgets'));
									$this->hook_position = $setting['hook_position'];
									$this->enabled       = $setting['enabled'];
									$this->widget_type   = $setting['widget_type'];

								}elseif($widgetType == 'module') {
									$dirTarget = Yii::getPathOfAlias('modules.'.$setting['module_name'].'.components');
									Utility::recursiveCopy(Yii::app()->runtimePath.'/temp/'.$folderName,
										$dirTarget);

									$moduleId = ComModules::model()->findByAttributes(array(
										'name' => trim($setting['module_name'])
									));
									if($moduleId !== null) {
										$this->com_modules_id = $moduleId->id;
									}

									$this->hook_position = $setting['hook_position'];
									$this->enabled       = $setting['enabled'];
									$this->widget_type   = $setting['widget_type'];
								}
							}
						}
					}
				}

			}else {
				// Swap order menu
				$model               = ComWidgets::model()->findByPk($this->ordering);
				$this->_prevWidgetId = $this->ordering;
				if($model !== null) {
					$this->ordering = $model->ordering;
				}
			}
		}
		return true;
	}


	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();

		$sql = "SELECT id, ordering FROM {$this->tableName()} WHERE id= :id";
		$model = Yii::app()->db->createCommand($sql)->queryRow(true, array(
			':id' => $this->_prevWidgetId)
		);

		if($model) {
			$sql = "UPDATE {$this->tableName()} SET ordering = :ordering WHERE id= :wid";
			Yii::app()->db->createCommand($sql)->execute(array(
				':ordering' => $this->_oldOrder,
				':wid'      => $model['id'],
			));
		}

		if(count($this->_tempDirToDelete) > 0) {
			foreach($this->_tempDirToDelete as $val) {
				Utility::chmodr($val, 0777);
				Utility::recursiveDelete($val);
			}
		}
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('com_modules_id',$this->com_modules_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('hook_position',$this->hook_position,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('widget',$this->widget,true);
		$criteria->compare('access',$this->access);
		$criteria->compare('show_title',$this->show_title);
		$criteria->compare('params',$this->params,true);

		if(!isset($_GET['ComWidgets_sort'])) {
			$criteria->order = 'id DESC';
		}
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			/* 'pagination'=>array(
				'pageSize'=>20,
			), */
		));
	}

	/**
	 * Get list order on same widget type
	 *
	 * @param string $hookPosition
	 */
	public function getOrder($hookPosition) {
		$result = array();
		$model  = ComWidgets::model()->findAll(array('condition' => 'hook_position= :hp',
			'params' => array(':hp' => trim($hookPosition)),
			'select' => 'id, ordering, title',
			)
		);
		if($model !== null) {
			$result = CHtml::listData($model, 'id', 'title');
		}

		return $result;
	}

	/**
	 * Save old widget order after find
	 */
	protected function afterFind() {
		parent::afterFind();
		$this->_oldOrder = $this->ordering;
	}

	/**
	 * Get access list from group user table
	 *
	 * @return array
	 */
	public function getAccessList() {
		$model = UsersGroup::model()->findAll(array(
			'select' => 'id, name',
			'order' => 'id ASC')
		);

		return CHtml::listData($model, 'id', 'name');
	}

	/**
	 *
	 */
	public function getNextOrderPosition($hookPosition) {
		$model = self::model()->find(array('condition' => 'hook_position= :hp',
			'params' => array(':hp' => trim($hookPosition)),
			'select' => 'ordering',
			'order'  => 'ordering DESC')
		);

		if($model !== null)
			return ($model->ordering+1);
		else
			return 1;
	}

	/**
	 * Get enum widget type from swt_com_widgets
	 *
	 * @return array key and value
	 */
	public function getWidgetType() {
		$sql    = 'SHOW COLUMNS FROM swt_com_widgets WHERE FIELD = "widget_type"';
		$model  = Yii::app()->db->createCommand($sql)->queryAll();
		$type   = preg_replace("/enum\(|\)|'/i", '', $model[0]['Type']);
		$type   = explode(',', $type);
		$result = array();
		foreach($type as $val) {
			$result[$val] = $val;
		}

		return $result;
	}

	/**
	 * Extract widget based on type
	 *
	 * @param object of CUploadedFile $fileName(.zip)
	 * @param string $widgetType
	 */
	public function extractWidget(CUploadedFile $fileName, $widgetType, $moduleName=null, $overwrite=false) {
		$extractTo  = null;
		$widgetPath = Yii::getPathOfAlias('application.runtime.temp');
		$modulePath = Yii::getPathOfAlias('application.modules');
		$result     = false;

		if(file_exists($widgetPath.'/'.$fileName->name)) {
			if($widgetType == 'static') {
				$extractTo = Yii::getPathOfAlias('application.widgets');
			}elseif($widgetType == 'module') {
				if(!file_exists(Yii::getPathOfAlias('application.modules.'.$moduleName.'.components'))) {
					@mkdir(Yii::getPathOfAlias('application.modules.'.$moduleName).'/components');
				}
				$extractTo = Yii::getPathOfAlias('application.modules.'.$moduleName.'.components');
			}

			$zip        = zip_open($widgetPath.'/'.$fileName->name);
			$zipEntry   = array();
			$widgetName = '';
			if($zip) {
				$i = 1;
				while($zipe = zip_read($zip)) {
					if($i == 1) {
						$widgetName = zip_entry_name($zipe);
					}
					$zipEntry[] = zip_entry_name($zipe);
					$i++;
				}
			}

			$zip       = new ZipArchive;
			$zipFile   = $zip->open($widgetPath.'/'.$fileName->name);
			$dirName   = explode('.', $fileName->name);

			if($zipFile == true) {
				if($overwrite && $this->isWidgetAlreadyExists($extractTo, $zipEntry)) {
					if($zip->extractTo($extractTo)) {
						@chmod($extractTo.'/'.$dirName[0]);
						Utility::chmodr($extractTo.'/'.$dirName[0], 0777);
					}

				}elseif(!$this->isWidgetAlreadyExists($extractTo, $zipEntry)) {
					if($zip->extractTo($extractTo)) {
						@chmod($extractTo.'/'.$dirName[0]);
						Utility::chmodr($extractTo.'/'.$dirName[0], 0777);
					}
				}
				$zip->close();
			}
			$sql = 'UPDATE swt_com_widgets SET widget_path= :wp WHERE id= :wid';
			Yii::app()->db->createCommand($sql)->execute(array(
				':wp'  => $extractTo.'/'.$widgetName,
				':wid' => $this->primaryKey,
			));

			Utility::chmodr($extractTo, 0777);
			$result = true;
		}
	}

	/**
	 * Check if widget already exist in directory
	 *
	 * @return boolean
	 */
	public function isWidgetAlreadyExists($widgetPath, $widgetName=array()) {
		$dh    = opendir($widgetPath);
		$files = array();

		if($dh !== false) {
			while( ($file = readdir($dh)) !== false) {
				if($file != '.' && $file != '..') {
					$files[] = $file;
				}
			}
			closedir($dh);
		}

		$result = false;
		foreach($widgetName as $val) {
			if(in_array(trim($val), $files)) {
				$result |= true;
			}
		}
		return $result;
	}

	/**
	 * Get folder from zip file
	 *
	 * @param string $zipFile
	 * @return string folder name
	 */
	public function getFolderName($zipFile) {
		$zip        = zip_open($zipFile);
		$zipEntry   = array();
		if($zip) {
			while($zipe = zip_read($zip)) {
				$zipEntry[] = zip_entry_name($zipe);
			}
		}

		$folderName = array_shift($zipEntry);
		$folderName = str_ireplace(array('/', '\\'), array('', ''), $folderName);
		return $folderName;
	}
}
