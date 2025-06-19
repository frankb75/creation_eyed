<?php

/*
ini_set('zlib.output_compression', 0);
ini_set('output_buffering', 0);
ini_set('implicit_flush', 1);
while (ob_get_level()) {
    ob_end_clean(); // clear any output buffers
}
flush();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

echo "Testing error output...<br>";
trigger_error("This is a test notice", E_USER_NOTICE);

*/

//echo ini_get('max_file_uploads');

//exit("Under Maintenance!");

/**
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */

/* ===============================================================================
 *	PHP Version
 * ============================================================================ */ 
	if (version_compare(PHP_VERSION, '5.3.0', '<')) {
		echo '<h2>Error</h2>';
		echo '<p>PHP 5.3.0 or higher is required to use Creation Eyed.</p>';
		echo '<p>You are running '.PHP_VERSION.'</p>';
		exit;
	}


/* ===============================================================================
 *	FOLDER
 *   - Do not change.
 * ============================================================================ */ 
$ce_main = 'creation eyed';

/* ===============================================================================
 *	Define
 * ============================================================================ */ 
	define('FCPATH', str_replace('\\', '/', dirname(__FILE__)));
	define('MODULE_DIR', 'modules/');
	define('THEME_DIR', 'themes/');
	define('BASEPATH', str_replace('\\', '/', $ce_main.'/'));
	define('ENVIRONMENT', 'production');

/* ===============================================================================
 *	Environment
 * ============================================================================ */
	if (defined('ENVIRONMENT'))
	{
		switch (ENVIRONMENT)
		{
			case 'development':
			case 'testing':
				error_reporting(E_ALL);
				break;
		
			case 'production':
				error_reporting(0);
				break;
				
			default:
				exit('The application environment is not set correctly.');
		}
	}

/* Let's get Started */
try {
    require_once "{$ce_main}/core/CreationBody.php";
    require_once "{$ce_main}/core/CreationEyed.php";

    echo "✅ Included core files successfully.<br>";

} catch (Throwable $e) {
    echo "❌ Exception while including core files: " . $e->getMessage();
}