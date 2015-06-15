<?php
/**
 * ThemeHandle file.
 *
 * @author Agus susilo <smartgdi@gmail.com>
 * @link http://www.swevel.com/
 * @copyright Copyright &copy; 2010-2011 Swevel Media
 * @version 1.5
 */

class ThemeHandle {
	private $_themes;
	private $_themePath;
	public $assetBaseUrl;
	public static $instance = null;

	public function getAsset() {
	}

	public static function getInstance() {
		if(self::$instance == null) {
			self::$instance = new ThemeHandle;
		}
		return self::$instance;
	}

	/**
	 * Update list of theme from themes folder
	 */
	public function installThemes() {
		$themes       = Yii::app()->themeManager->themeNames;
		$templates    = Templates::model()->findAll(array('select' => 'template'));
		$themesFromDb = array();
		if($templates !== null) {
			foreach($templates as $key => $val) {
				$themesFromDb[] = $val->template;
			}
		}

		$shouldInstall = array_diff($themes, $themesFromDb);
		$sql           = 'INSERT INTO swt_templates(template, default_theme, path_folder, thumbnail) VALUES';
		$i             = 1;
		$countTheme    = count($shouldInstall);
		$path          = Yii::app()->baseUrl.'/themes';

		foreach($shouldInstall as $val) {
			if($i == $countTheme) {
				$sql .= "('{$val}', '0', '{$path}/{$val}', '');";
			}else {
				$sql .= "('{$val}', '0', '{$path}/{$val}', ''),";
			}
			$i++;
		}

		if(count($shouldInstall) > 0) {
			Yii::app()->db->createCommand($sql)->execute();
		}
	}
}
