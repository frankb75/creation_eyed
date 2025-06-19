<?php
// Debug
$debug = debug_backtrace();
$file_name = isset($debug[$num]['file']) ? $debug[$num]['file'] : "";
$line_number = isset($debug[$num]['line']) ? $debug[$num]['line'] : "";

if($show_info)
{
	exit('
	<html>
	<head>
		<title></title>
		<style type="text/css">
			html
			{
				font-family:"Verdana",sans-serif;
				margin:10px
			}
			.box
			{
				border:1px solid #ccc;
				padding:10px;
				box-shadow: 5px 5px 5px #888888;
				background:#fff;
			}
		</style>
	</head>
	<body>
		<div class="box">
			<b>THERE IS AN ERROR</b>
			<hr />
			<span style="font-size:12px">
				'.$data['msg'].'
				<br /><br /><br />
				<b>File Name:</b> '.substr(str_replace(str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']),'',$file_name),1).'
				<br />
				<b>Line Number:</b> '.$line_number.'
			</span>
		</div>
	</body>
	</html>
	');
}
else
{
		exit('
	<html>
	<head>
		<title></title>
		<style type="text/css">
			html
			{
				font-family:"Verdana",sans-serif;
				margin:10px
			}
			.box
			{
				border:1px solid #ccc;
				padding:10px;
				box-shadow: 5px 5px 5px #888888;
				background:#fff;
			}
		</style>
	</head>
	<body>
		<div class="box">
			<b>THERE IS AN ERROR</b>
			<hr />
			<span style="font-size:12px">
				'.$data['msg'].'
			</span>
		</div>
	</body>
	</html>
	');
}
?>