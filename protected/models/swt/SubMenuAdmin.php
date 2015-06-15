<?php

/**
 * This is the model class for table "swt_sub_menu_admin".
 *
 * The followings are the available columns in table 'swt_sub_menu_admin':
 * @property integer $id
 * @property string $group_type
 * @property string $controller
 * @property string $action
 * @property integer $enabled
 * @property string $menu
 * @property string $attr
 */
class SubMenuAdmin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SubMenuAdmin the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()	{
		return 'swt_sub_menu_admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controller, action, menu, attr', 'required'),
			array('enabled, ordering', 'numerical', 'integerOnly'=>true),
			array('group_type, position, dialog', 'length', 'max'=>12),
			array('controller, action, url, icon, module', 'length', 'max'=>100),
			array('menu, class', 'length', 'max'=>50),
			array('attr', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_type, controller, action, enabled, menu, attr', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('label', 'ID'),
			'group_type' => Yii::t('label', 'Group Page'),
			'controller' => Yii::t('label', 'At Controller'),
			'action' => Yii::t('label', 'At List Action'),
			'enabled' => Yii::t('label', 'Enabled'),
			'menu' => Yii::t('label', 'Menu Title'),
			'attr' => Yii::t('label', 'Attr'),
		);
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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('group_type',$this->group_type,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('menu',$this->menu,true);
		$criteria->compare('attr',$this->attr,true);
//		$criteria->order = ''
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}
}