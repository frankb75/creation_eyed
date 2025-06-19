<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Filter Types
|--------------------------------------------------------------------------
*/
define('FILTER_STR', '/^[a-z,A-Z, ]+$/'); // Use for names
define('FILTER_INT', '/^[0-9]+$/');
define('FILTER_INT_DEC', '/^[0-9,.]+$/');
define('FILTER_STR_INT', '/^[a-z,A-Z,0-9,]+$/');
define('FILTER_STR_INT_SPA', '/^[a-z,A-Z,0-9, ]+$/');
define('FILTER_USERNAME', '/^[a-z,A-Z,0-9,_, ]+$/');
define('FILTER_EMAIL', '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/');

/*
|--------------------------------------------------------------------------
| Email Settings
|--------------------------------------------------------------------------
*/
define('EMAIL_FROM','zarek@a2plcpnl0248.prod.iad2.secureserver.net');
define('EMAIL_FROM_NAME','Photography by Zarek');
define('EMAIL_SUBJECT','Photography by Zarek');