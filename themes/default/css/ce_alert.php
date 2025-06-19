<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
/** 
 * Alert CSS
 *
 * No Description
 *
 * @author		Enalds
 * @copyright	Copyright (c) 2013, CreationEyed.
 *
 * @since		CE Version 3.1
 * @version		1.0
 *
 * NOTE: You can changed the style.
 */
 .input_submit{ } /* Button */
.cehead { background:#000000; height:35px; width:auto }
#cebox{
	display:none;
	opacity:0.5;
	filter:alpha(opacity=50);
	position:fixed;
	top:0px;
	left:0px;
	min-width:100%;
	min-height:100%;
	z-index:1000;
}
#cebox-panel{
	width:560px;
	display:none;
	position:fixed;
	margin:auto;
	left:0;
	right:0;
	top:200px;
	z-index:1001;
	font-size:80%;
	-webkit-animation:pop-in 0.5s;
	-moz-animation:pop-in 0.5s;
	-ms-animation:pop-in 0.5s;
}

@-webkit-keyframes pop-in {
0% { opacity: 0;-moz-transform: scale(0.5);-webkit-transform: scale(0.1); }
100% { opacity: 1;-moz-transform: scale(1);-webkit-transform: scale(1); }
}
@-moz-keyframes pop-in {
0% { opacity: 0;-moz-transform: scale(0.5);-webkit-transform: scale(0.1); }
100% { opacity: 1;-moz-transform: scale(1);-webkit-transform: scale(1); }
}
@-ms-keyframes pop-in {
0% { opacity: 0;-moz-transform: scale(0.5);-webkit-transform: scale(0.1); }
100% { opacity: 1;-moz-transform: scale(1);-webkit-transform: scale(1); }
}