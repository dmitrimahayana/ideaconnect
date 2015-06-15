<?php
/**
 * DefaultController class file
 */
class DefaultController extends SBaseController
{
	public $defaultAction = 'adminmanage';

	/**
	 * Preview selected theme
	 */
	public function actionAdminPreview() {
		$session = new CHttpSession;
		$session->open();
		$session['themeDefault'] = Yii::app()->theme->name;
		$theme = trim($_GET['id']);

		$config = "<?php\n";
		$config .= "/**\n";
		$config .= " * Theme setting\n";
		$config .= " */\n";
		$config .= "return array(\n";
		$config .= "\t'theme' => '$theme',\n";
		$config .= ");";

		$fileHandle = fopen(Yii::getPathOfAlias('application.config').'/theme.php', 'w');
		fwrite($fileHandle, $config, strlen($config));
		fclose($fileHandle);
		$this->render('admin_preview');
	}

	/**
	 * Display admin manage
	 */
	public function actionAdminManage() {
		$runtimePath = Yii::app()->runtimePath;

		// Upload and extract yii module
		if(isset($_FILES['file_name'])) {
			$fileName = CUploadedFile::getInstanceByName('file_name');

			if($fileName->type == 'application/zip' && $fileName->extensionName == 'zip') {
				if($fileName->saveAs($runtimePath.'/'.$fileName->name)) {
					$zip       = new ZipArchive;
					$zipFile   = $zip->open($runtimePath.'/'.$fileName->name);
					$extractTo = explode('.', $fileName->name);

					if($zipFile == true) {
						if($zip->extractTo(Yii::getPathOfAlias('webroot.themes'))) {
							Utility::chmodr(Yii::getPathOfAlias('webroot.themes').'/'.$extractTo[0], 0777);
							Yii::app()->user->setFlash('success', 'Themes sukses diextract.');
						}

						$zip->close();
					}

				}else
					Yii::app()->user->setFlash('error', 'Gagal menyimpan file.');

			}else
				Yii::app()->user->setFlash('error', 'Hanya file .zip yang dibolehkan.');
		}

		$theme = Yii::app()->themeManager->themeNames;
		$this->render('admin_manage', array(
			'theme' => $theme,
		));
	}

	/**
	 * Apply selected theme.
	 */
	public function actionAdminApply() {
		$theme = trim($_GET['id']);

		if(isset(Yii::app()->dbparams->sweeto_theme)) {
			Yii::app()->dbparams->sweeto_theme = $theme;
			Yii::app()->user->setFlash('success', 'Tema sukses diterapkan.');
		}
		$this->redirect(array('adminmanage'));
	}

	public function actionResetTheme() {
		$session = new CHttpSession;
		$session->open();
		$theme = trim($session['themeDefault']);

		$config = "<?php\n";
		$config .= "/**\n";
		$config .= " * Theme setting\n";
		$config .= " */\n";
		$config .= "return array(\n";
		$config .= "\t'theme' => '$theme',\n";
		$config .= ");";

		$fileHandle = fopen(Yii::getPathOfAlias('application.config').'/theme.php', 'w');
		fwrite($fileHandle, $config, strlen($config));
		fclose($fileHandle);
		$this->render('admin_preview');
	}

	/**
	 * Initialize module.
	 */
	public function init() {
		Yii::app()->theme = Yii::app()->dbparams->sweeto_theme;
		Utility::applyCurrentTheme($this->module);
	}
}
