.uploadifive-button {
	background-color: #505050;
	background-image: linear-gradient(bottom, #505050 0%, #707070 100%);
	background-image: -o-linear-gradient(bottom, #505050 0%, #707070 100%);
	background-image: -moz-linear-gradient(bottom, #505050 0%, #707070 100%);
	background-image: -webkit-linear-gradient(bottom, #505050 0%, #707070 100%);
	background-image: -ms-linear-gradient(bottom, #505050 0%, #707070 100%);
	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0, #505050),
		color-stop(1, #707070)
	);
	background-position: center top;
	background-repeat: no-repeat;
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;
	border: 2px solid #808080;
	color: #FFF;
	font: bold 12px Arial, Helvetica, sans-serif;
	text-align: center;
	text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
	text-transform: uppercase;
	width: 100%;
}
.uploadifive-button:hover {
	background-color: #606060;
	background-image: linear-gradient(top, #606060 0%, #808080 100%);
	background-image: -o-linear-gradient(top, #606060 0%, #808080 100%);
	background-image: -moz-linear-gradient(top, #606060 0%, #808080 100%);
	background-image: -webkit-linear-gradient(top, #606060 0%, #808080 100%);
	background-image: -ms-linear-gradient(top, #606060 0%, #808080 100%);
	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0, #606060),
		color-stop(1, #808080)
	);
	background-position: center bottom;
}
.uploadifive-queue-item {
	background-color: #F5F5F5;
	border-bottom: 1px dotted #D5D5D5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	font: 12px Arial, Helvetica, Sans-serif;
	margin-top: 3px;
	padding: 15px;
}
.uploadifive-queue-item .close {
	background: url('<?php echo themes_url('images/uploadify-cancel.png'); ?>') 0 0 no-repeat;
	display: block;
	float: right;
	height: 16px;
	text-indent: -9999px;
	width: 16px;
}
.uploadifive-queue-item .progress {
	border: 1px solid #D0D0D0;
	height: 3px;
	margin-top: 5px;
	width: 100%;
}
.uploadifive-queue-item .progress-bar {
	background-color: #0072BC;
	height: 3px;
	width: 0;
}