<?php
/*
 * ------------------------------------------------------
 * Set Date Timezone
 * 
 * For more info visit https://php.net/manual/en/timezones.php
 * ------------------------------------------------------
 */
$config['timezone'] = "America/Los_Angeles";

/*
|--------------------------------------------------------------------------
| CSS Layout
|
| Available Layouts
|	- 960
|	- 960_sticky_footer
|	- full
|	- full_sticky_footer
|	- advertise
|	- advertise_sticky_footer
|--------------------------------------------------------------------------
*/
$config['layout'] = "full";

/*
 * ------------------------------------------------------
 *  Source Code Compress
 * 
 * TRUE = view source code are compressed
 * FALSE = view source code are no compress
 * ------------------------------------------------------
 */
$config['compress'] = TRUE;

/*
 * ------------------------------------------------------
 *  Gzip
 * 
 * TRUE = Enable
 * FALSE = Disable
 * ------------------------------------------------------
 */
$config['gzip'] = TRUE;

/*
 * ------------------------------------------------------
 * Session (Session Name is not yet working)
 * 
 * 'session'		=	TRUE or FALSE
 * 'session_name'	=	Name of the Session
 * 'session_name'	=	Session Timeout (300 = 5 minutes)
 * ------------------------------------------------------
 */
$config['session'] = TRUE;
$config['session_name'] = "zarek";
$config['session_timeout'] = 999999999999999999999999;

/*
 * ------------------------------------------------------
 *  Hooks
 * ------------------------------------------------------
 */
$config['hooks'] = TRUE;