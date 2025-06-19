<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
#lightbox{
	display:none;
	background:#000;
	opacity:0.5;
	filter:alpha(opacity=50);
	position:fixed;
	top:0px;
	left:0px;
	min-width:100%;
	min-height:100%;
	z-index:1010;
}
#lightbox-panel{
	width:960px;
	display:none;
	position:fixed;
	background:#d53737;
	padding:10px;
	border:2px solid #ac1414;
	border-radius:20px;
	margin:auto;
	left:0;
	right:0;
	bottom:100px;
	top:100px;
	z-index:1011;
}