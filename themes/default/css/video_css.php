<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
.thumb_scroll{
	width: auto; 
	height:210px;
	overflow-x: scroll;
	overflow-y: hidden;
}
.thumb_scroll::-webkit-scrollbar {
    width: 1em;
}
 
.thumb_scroll::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(2,5,6,3);
}
 
.thumb_scroll::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}