<?php
/**
 * Merge file modules and developments
 */
return CMap::mergeArray(
	require(dirname(__FILE__).'/production.php'),
	require(dirname(__FILE__).'/setting.php'),
	require(dirname(__FILE__).'/database.php'),
	require(dirname(__FILE__).'/modules.php')
	/**
	 * Url manager and theme setting has been moved to protected/sweeto/Sweeto.php
	 * since Saturday, 11 August 2012,
	 * to change theme use admin web/Sweeto.php instead this using file
	 */
	// require(dirname(__FILE__).'/url.php'),
	// require(dirname(__FILE__).'/theme.php')
);
