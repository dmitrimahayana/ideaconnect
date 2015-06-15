<?php
/**
 * ModuleHandle file.
 *
 * @author Agus susilo <smartgdi@gmail.com>
 * @link http://www.swevel.com/
 * @copyright Copyright &copy; 2010-2011 Swevel Media
 * @version 1.5
 */

class ModuleHandle extends CApplicationComponent
{
	private $moduleId;
	// Letak modul2
	public $modulePath        = 'protected/modules';
	// Letak file config modul
	public $configPath        = 'protected/config/module_addon.php';

	protected $table          = 'module_to_hook';
	protected $identifier     = 'id_module';
	private $moduleCaches     = array();
	// Daftar modul yg tidak akan discan oleh sistem.
	private $ignoreFromScan   = array();
	private $_moduleTableName = 'swt_com_modules';

	public function __construct() {
		//$this->cacheModuleToFile();
		//$this->installToFile();
	}

	/**
	 * Ubah status aktif modul dari 0 menjadi 1.
	 */
	public function install($moduleName) {
		$model = new ComModules;
		$result = ComModules::model()->find(array(
			'condition' => 'name = :name AND enabled=0',
			'params' => array(
				':name' => $moduleName,
			),
		));

		if($result !== null) {
			return false;
		}else {
			$desc     = Yii::app()->getModule($moduleName)->description;
			$active   = Yii::app()->getModule($moduleName)->active;
			$hookName = Yii::app()->getModule($moduleName)->defaultHook;
			$idHook   = $this->getIdHookByName($hookName);

			Yii::app()->db->createCommand('INSERT INTO module(nama, deskripsi, aktif) VALUES(:nama, :desc, :aktif)')->
			execute(array(
				':nama' => $moduleName, ':desc' => $desc, ':aktif' => $active
			));

			$moduleToHook = new ModuleToHook;
			$moduleToHook->id_module = $result->id_module;
			$moduleToHook->id_hook = $idHook;
			$moduleToHook->position = 0;

			if($moduleToHook->save(false))
				return true;
			else
				return false;
		}
	}

	/*
	 * Hapus modul dari tabel.
	*/
	public function uninstall($idModule) {
		$model = new ComModules;

		$result = ComModules::model()->find(array(
			'condition' => 'id = :id_module',
			'params' => array(':id_module' => $idModule),
		));

		if($result === null) {
			return false;
		}else {
			$idModule = $result->id_module;

			$isModuleHooked = ModuleToHook::model()->find(array(
				'condition' => 'id_module = :id_module',
				'params' => array(
					':id_module' => $idModule,
				),
			));

			// Remove from module_to_hook
			if($isModuleHooked !== null) {
				// Hapus modul dari tabel module_to_hook
				$isModuleHooked->delete();
			}

			// set aktif = 0 pada tabel module.
			$result->aktif = 0;
			if($result->save())
				return true;
			else
				return false;
		}
	}

	/*
	 Memeriksa apakah module telah dihook.
	 @return true jika telah dihook dan false jika belum dihook.
	*/
	public function isModuleHooked($idModule) {
		$conn    = Yii::app()->db;
		$sql     = sprintf('SELECT * FROM module_to_hook hm WHERE hm.id_module = %d', $idModule);
		$result  = $conn->createCommand($sql)->query();

		if(!$result->rowCount)
			return false;
		else
			return true;
	}

	/*
	 Mendapatkan id_hook berdasarkan nama hook.
	 @return false jika tak ditemukan dan id_hook jika ketemu.
	*/
	public function getIdHookByName($hookName) {
		$model = new Hook;
		$result = $model->find(array(
			'condition' => 'LOWER(nama) = :nama',
			'params' => array(
				':nama' => strtolower($hookName),
			),
		));

		if(!$result)
			return false;
		else {
			return $result->id_hook;
		}
	}

	/*
	 Mendapatkan id modul berdasarkan nama module.
	 @return false if not found or id_module if founded.
	*/
	public function getIdModuleByName($moduleName) {
		$conn = Yii::app()->db;
		$sql  = 'SELECT id_module FROM module WHERE nama = "' . $moduleName . '"';
		$command = $conn->createCommand($sql);
		$result = $command->query();

		if(!$result->rowCount)
			return false;
		else {
			$rows = $result->read();
			return $rows['id_module'];
		}
	}

	/**
	 * Mendapatkan daftar modul dari folder protected/modules.
	 *
	 * @return array daftar modul yang ada atau false jika tidak terdapat modul.
	 */
	public function getModulesDirOnDisk() {
		$moduleList = array();
		$modulePath = Yii::getPathOfAlias('application.modules');
		$modules    = scandir(Yii::getPathOfAlias('application.modules'));
		foreach($modules as $name) {
			if (file_exists($moduleFile = $modulePath . '/' . $name . '/' . ucfirst($name) . 'Module.php')) {
				$moduleName = strtolower(trim($name));
				if(!in_array($moduleName, self::getIgnoreModule())) {
					$moduleList[] = $moduleName;
				}
			}
		}

		if(count($moduleList) > 0) {
			return $moduleList;
		}else {
			return false;
		}
	}

	/**
	 * Install modul ke file protected/config/modules.php
	 */
	public function installToFile($module = array()) {
		$config = '';
		$moduleCaches = $this->getModulesDirOnDisk();
		if(count($module) > 0 && is_array($module)) {
			$moduleCaches = $module;
		}

		if(count($moduleCaches) > 0) {
			$config .= "<?php \n";
			$config .= "return array(\n\t'modules' => array(\n";
			for($i = 0; $i < count($moduleCaches); $i++) {
				if($i !== (count($moduleCaches) - 1))
					$config .= "\t\t'" . $moduleCaches[$i] . "',\n";
				else
					$config .= "\t\t'" . $moduleCaches[$i] . "'\n";
			}
			$config .= "\t),\n);";
			$config .= "\n?>";
		}

		$fileHandle = fopen($this->configPath, 'w');
		fwrite($fileHandle, $config, strlen($config));
		fclose($fileHandle);
	}

	/**
	 * Install modul ke database
	 */
	public function installKeTabel() {
		$countModulesFile = count($this->getModulesDirOnDisk());
		$toBeInstalled    = array();

		if($countModulesFile > $this->getTotalModuleFromDb()) {
			$cacheModule     = file(Yii::getPathOfAlias('application.config').'/cache_module.php');
			$installedModule = $this->getModulesDirOnDisk();
			$toBeInstalled   = array();
			$caches = array();
			foreach($cacheModule as $val) {
				$caches[] = trim(strtolower($val));
			}

			// Cari nama modul yang belum masuk database.
			if(count($cacheModule) == 0 || count($cacheModule) < 1) {
				if($installedModule) {
					foreach($installedModule as $val) {
						$toBeInstalled[] = $val;
					}
				}

			}else {
				if($installedModule) {
					foreach($installedModule as $val) {
						$val = trim($val);
						if(!in_array(strtolower($val), $caches)) {
							$toBeInstalled[] = $val;
						}
					}
				}
			}

			$sql = "INSERT INTO {$this->_moduleTableName}(id, name, enabled) VALUES";
			$id  = $this->getIdMax('id', 'swt_com_modules');
			for($i = 0; $i < count($toBeInstalled); $i++) {
				if(isset(Yii::app()->getModule($toBeInstalled[$i])->active))
					$active = Yii::app()->getModule($toBeInstalled[$i])->active;
				else
					$active = 0;

				$desc = Yii::app()->getModule($toBeInstalled[$i])->description;

				if($i == (count($toBeInstalled) - 1)) {
					$sql .= '(' . $id . ', "' . $toBeInstalled[$i] . '", ' . $active . ')';
				}else
					$sql .= '(' . $id . ', "' . $toBeInstalled[$i] . '", ' . $active . '),';

				$id++;
			}

			//Check if module already inserted to table.
			$conn    = Yii::app()->db;

			if(count($toBeInstalled) > 0) {
				$result  = $conn->createCommand($sql)->execute();
				if($result)
					return true;
				else
					return false;
			}
		}
	}

	public function registerHook($hookName) {
		$conn = Yii::app()->db;
		$sql  = 'SELECT id_module FROM module_to_hook hm, hook h WHERE h.nama = "' . $hookName . '"';
		$sql .= ' AND hm.id_module = ' . $this->id . ' AND hm.id_hook = h.id_hook';
		$command = $conn->createCommand($sql);
		$result  = $command->query();

		$idModule = 0;
		if(!$result->rowCount)
			return false;
		else {
			$rows     = $result->read();
			$idModule = $rows['id_module'];
		}

		// Get id hook
		$sql  = 'SELECT id_hook FROM hook WHERE nama = "' . $hookName . '"';
		$command = $conn->createCommand($sql);
		$result  = $command->query();
		$idHook = 0;
		if(!$result->rowCount)
			return false;
		else {
			$rows = $result->read();
			$idHook = $rows['id_hook'];
		}

		// Get module position in hook
		$sql  = 'SELECT MAX(position) AS position FROM module_to_hook WHERE id_hook = ' . $idHook;
		$command = $conn->createCommand($sql);
		$result  = $command->query();
		$position = 0;

		if(!$result->rowCount)
			return false;
		else {
			$rows = $result->read();
			$position = $rows['position'];
		}

		// Register module in hook
		$sql  = 'INSERT INTO module_to_hook(id_module, id_hook, position) VALUES(' . $idModule . ', ';
		$sql .= $idHook . ', ' . ($position + 1) . ')';
		$command = $conn->createCommand($sql);
		$result  = $command->query();
		if(!$result)
			return false;
		else
			return true;
	}

	public function unregisterHook($idHook) {
	}

	public function getPosition($idHook) {
	}

	public function updatePosition($idHook) {
	}

	public function getModulesInstalled($position = 0) {
	}

	public function isModuleInstalled($idModule) {
		$model = new Module;
		$result = $model->find(array(
			'condition' => 'id_module = :id_module AND aktif = :aktif',
			'params' => array(
				':id_module' => $idModule,
				':aktif' => 1,
			),
		));

		if($result)
			return true;
		else
			return false;
	}

	/**/
	public function getIdMax($fieldName, $tableName) {
		$conn = Yii::app()->db;
		$sql  = 'SELECT IFNULL(MAX(' . $fieldName . ')+1, 1) as id FROM ' . $tableName;
		return $conn->createCommand($sql)->queryScalar();
	}

	/*
	 Dapatkan total modul yang ada pada tabel modul.
	 @return integer rows.
	*/
	public function getTotalModuleFromDb() {
		return Yii::app()->db->createCommand("SELECT COUNT(id) AS total FROM {$this->_moduleTableName}")->queryScalar();
	}

	/**
	 * Cache modul dari database ke bentuk file.
	 * Untuk mengurangi query pada saat install ke database.
	 */
	public function cacheModuleToFile() {
		$criteria = new CDbCriteria;
		$criteria->order = 'name ASC';
		$modules = ComModules::model()->findAll($criteria);
		$arrayModule = '';

		foreach($modules as $module) {
			$arrayModule .= $module->name . "\n";
		}
		$filePath   = Yii::getPathOfAlias('application.config');
		$fileHandle = fopen($filePath.'/cache_module.php', 'w');
		fwrite($fileHandle, $arrayModule);
		fclose($fileHandle);
	}

	/**
	 * return ignore module from scanner.
	 */
	public function getIgnoreModule() {
		return array('cms', 'modulemanager', 'srbac', 'gii', 'thememanager');
	}

	/**
	 * Check if module already actived or not.
	 *
	 * @param string $name module's name
	 * @return boolean
	 */
	public function isModuleActived($name) {
		$result = Yii::app()->db->createCommand("SELECT * FROM {$this->_moduleTableName} WHERE enabled=1 AND name= :name")->queryRow(true, array(
			':name' => trim(strtolower($name)))
		);

		if($result === false)
			return false;
		else
			return true;
	}

	/**
	 * Update module from db to file
	 */
	public function updateModuleFile() {
		$module = Yii::app()->db->createCommand("SELECT * FROM {$this->_moduleTableName} WHERE enabled=1")->queryAll();

		if(count($module) > 0) {
			$config  = "<?php \n";
			$config .= "return array(\n\t'modules' => array(\n";
			$i = 1;
			foreach($module as $val) {
				if($i !== count($module))
					$config .= "\t\t'" . $val['name'] . "',\n";
				else
					$config .= "\t\t'" . $val['name'] . "'\n";
				$i++;
			}
			$config .= "\t),\n);";

		}else {
			$config  = "<?php \n";
			$config .= "return array(\n\t'modules' => array(\n";
			$config .= "\t),\n);";
		}

		$fileHandle = @fopen(Yii::getPathOfAlias('application.config').'/module_addon.php', 'w');
		@fwrite($fileHandle, $config, strlen($config));
		@fclose($fileHandle);
	}

	/**
	 * Delete modules
	 */
	public function deleteModule($dirname) {
	    // Sanity check
	    if (!file_exists($dirname)) {
	        return false;
	    }

	    // Simple delete for a file
	    if (is_file($dirname) || is_link($dirname)) {
	        return unlink($dirname);
	    }

	    // Loop through the folder
	    $dir = dir($dirname);
	    while (false !== $entry = $dir->read()) {
	        // Skip pointers
	        if ($entry == '.' || $entry == '..') {
	            continue;
	        }

	        // Recurse
	        $this->deleteModule($dirname . DIRECTORY_SEPARATOR . $entry);
	    }

	    // Clean up
	    $dir->close();
	    return rmdir($dirname);
	}

	/**
	 * Get module config from yaml file
	 *
	 * @param string $moduleName
	 * @return array
	 */
	public function getModuleConfig($moduleName) {
		Yii::import('ext.Spyc');

		$path = Yii::getPathOfAlias('modules.'.$moduleName).'/'.$moduleName.'.yaml';
		if(file_exists($path))
			return Spyc::YAMLLoad($path);
		else
			return null;
	}

	/**
	 * Create additional table inside module(if any)
	 *
	 * @param string $moduleName
	 * @return void.
	 */
	public function installTable($moduleName) {
		Yii::import('ext.Spyc');
		define('DS', DIRECTORY_SEPARATOR);

		$configPath = Yii::getPathOfAlias('modules.'.$moduleName).DS.$moduleName.'.yaml';
		if(file_exists($configPath)) {
			$config    = Spyc::YAMLLoad($configPath);
			$tableName = trim($config['table_name']);
			$fileName  = trim($config['sql_filename']);

			if($tableName != '' && $fileName != '') {
				$sqlPath = Yii::getPathOfAlias('modules.'.$moduleName).DS.'assets'.DS.$fileName;
				$tables  = Yii::app()->db->createCommand('SHOW FULL TABLES WHERE table_type = "BASE TABLE"')
					->queryColumn();

				if(!in_array($tableName, $tables)) {
					$sql = file_get_contents($sqlPath);
					Yii::app()->db->createCommand($sql)->execute();
				}
			}
		}
	}
}
