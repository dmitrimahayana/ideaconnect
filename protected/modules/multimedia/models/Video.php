<?php

/**
 * This is the model class for table "ic_video".
 *
 * The followings are the available columns in table 'ic_video':
 * @property string $id
 * @property string $video_key
 * @property string $video_path
 *
 * The followings are the available model relations:
 * @property IcProject[] $icProjects
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ic_video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('video_key', 'length', 'max'=>20),
			array('video_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, video_key, video_path', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'icProjects' => array(self::HAS_MANY, 'IcProject', 'video_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'video_key' => 'Video Key',
			'video_path' => 'Video Path',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('video_key',$this->video_key,true);
		$criteria->compare('video_path',$this->video_path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getVideo() {
        $model = self::model()->findAll();
        $items = array();
        if($model != null) {
            foreach($model as $key => $val) {
                $items[$val->id] = $val->video_key;
            }
            return $items;
        } else {
            return false;
        }
    }
}