<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
 
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = 'default';

	/**
	 * admin controller
	 */
	public $trashOption = false;
	public $searchOption = false;

	/**
	 * front controller
	 */
	public $dialogDetail = false;
	public $dialogWidth = '';
	public $dialogGroundUrl = '';
	public $ownerId = '';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs  = array();
	public $blocks       = array();
	public $addon_module = array();
	public $pageDescription;
	public $pageMeta; 

	public function render($view, $data = null, $return = false) {
		if ($this->beforeRender($view)) {
            parent::render($view, $data, $return);
        }
   }
 
	protected function beforeRender($view) {
		$desc = WebOption::model()->findByPk(1);
		if(parent::beforeRender($view)) {
			if (!empty($this->pageDescription)) {
				$description = $this->pageDescription;
			} else {
				$description = $desc->meta_description;
			}
			Yii::app()->clientScript->registerMetaTag($description, 'description');
		
			if (!empty($this->pageMeta)) {
				$keywords = $this->pageMeta;
			} else {
				$keywords = $desc->meta_keyword;
			}
			Yii::app()->clientScript->registerMetaTag($keywords, 'keywords');
		
		}
		return true;
	}
	
}
