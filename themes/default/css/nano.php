<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
/** initial setup **/
.nano {
  position : relative;
  width    : 100%;
  height   : 100%;
  overflow : hidden;
}
.nano > .nano-content {
  position      : absolute;
  overflow      : scroll;
  overflow-x    : hidden;
  top           : 0;
  right         : 0;
  bottom        : 0;
  left          : 0;
}
.nano > .nano-content:focus {
  outline: thin dotted;
}
.nano > .nano-content::-webkit-scrollbar {
  display: none;
}
.has-scrollbar > .nano-content::-webkit-scrollbar {
  display: block;
}
.nano > .nano-pane {
  background : #fceaa5;
  position   : absolute;
  width      : 10px;
  right      : 0;
  top        : 0;
  bottom     : 0;
  visibility : hidden\9; /* Target only IE7 and IE8 with this hack */
  opacity    : .01;
  -webkit-transition    : .2s;
  -moz-transition       : .2s;
  -o-transition         : .2s;
  transition            : .2s;
  -moz-border-radius    : 5px;
  -webkit-border-radius : 5px;
  border-radius         : 5px;
  width:13px;
}
.nano > .nano-pane > .nano-slider {
   background: #0db2f7;  
  position              : relative;
  margin                : 0 1px;
  -moz-border-radius    : 3px;
  -webkit-border-radius : 3px;
  border-radius         : 3px;
}
.nano:hover > .nano-pane, .nano-pane.active, .nano-pane.flashed {
  visibility : visible\9; /* Target only IE7 and IE8 with this hack */
  opacity    : 0.99;
}