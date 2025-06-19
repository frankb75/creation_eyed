<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

/** 

 * CE Text Editor

 *

 * First CE Text Editor

 *

 * @author		Enalds

 * @copyright	Copyright (c) 2013 - 2015, CreationEyed.

 *

 * @since		CE Version 3.1

 * @version		1.5 BETA

 */

var textarea = document.getElementsByTagName("textarea");

var iFrameBody = new Array();

var ce_editor = new Array();

var none = "";

var show_dropdown = false;

var show_ids = "";

var called = false;

var filter_int = <?php echo FILTER_INT; ?>;



eval(function(p,a,c,k,e,r){e=function(c){return c.toString(a)};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('0.f("9",j(e){4(5&&(e.3.8!==0.2(1))&&(e.3!==0.2(1))){4(0.2(\'a\'+1)==e.3||e.3==0.2(\'b\'+1)||e.3==0.2(\'c\'+1)||e.3==0.2(\'d\'+1)||e.3==0.2(\'u\'+1)||e.3==0.2(\'g\'+1)||e.3==0.2(\'h\'+1)||e.3==0.2(\'i\'+1)||e.3==0.2(\'7\'+1)||e.3==0.2(\'k\'+1)||e.3==0.2(\'l\'+1)||e.3==0.2(\'m\'+1)||e.3==0.2(\'n\'+1)||e.3==0.2(\'o\'+1)||e.3==0.2(\'p\'+1)){}q{0.2(1).r.s="t";5=6}}},6);',31,31,'document|show_ids|getElementById|target|if|show_dropdown|false|ce_add_image5|parentNode|click|ce_add_link_url|ce_add_link_url2|ce_add_link_url3|ce_add_link_url4||addEventListener|ce_add_image2|ce_add_image3|ce_add_image4|function|ce_add_table|ce_add_table2|ce_add_table3|ce_add_table4|ce_add_table5|ce_add_table6|else|style|display|none|ce_add_image'.split('|'),0,{}));



function ce_editor_initialized()

{

	for(var i = 0; i < textarea.length; i++)

	{

		(function () {

			eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('I 1i=D.5g("5e")[i];1i.b.L="g";1i.1f("t","1p"+i);I 15=D.1l("5d");15.1f("t","5c"+i);15.b.M="P K #5b";15.b.h="#5a";I 1o=D.F("1p"+i).b.C;1P(1o==0){}1K{15.b.C=1o}I 1m=D.F("1p"+i).b.1r;1P(1m==0){}1K{15.b.1r=1m}I 1q=D.1l("7");1q.1f("t","1W"+i);I 1t=D.1l("7");1t.1f("t","22"+i);59(1i,1t);I 1n=D.F("22"+i);1n.1S(1q);I 1V=D.F("1W"+i);I 9=\'<s t="1Y\'+i+\'" c="1Y" d="f 58(\\\'\'+i+\'\\\')" A="50" b="z:w"></s>\';9+=\'<s c="4Y" d="f 4U(\\\'\'+i+\'\\\')" A="4O" b="z:w"></s>\';9+=\'<s c="4M" d="f 4K(\\\'\'+i+\'\\\')" A="4G" b="z:w"></s>\';9+=\'<7 b="z:w">\';9+=\'<s t="2w\'+i+\'" c="4F" A="1k 1N"></s>\';9+=\'<7 t="4E\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="h:1a; M:P K Q; v:0; J:0; C:1e; S:16;">\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'2u\'+g+\'\\\')"><r u="2">2u</r></7>\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'4z\'+g+\'\\\')"><r b="r-u:4x">18 1</r></7>\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'4p\'+g+\'\\\')"><r b="r-u:4o">18 2</r></7>\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'4n\'+g+\'\\\')"><r b="r-u:12">18 3</r></7>\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'4m\'+g+\'\\\')"><r b="r-u:1c">18 4</r></7>\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'4k\'+g+\'\\\')"><r b="r-u:4i">18 5</r></7>\';9+=\'<7 c="E" d="f 13(\\\'\'+i+\'\\\',\\\'4g\'+g+\'\\\')"><r b="r-u:4e">18 6</r></7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<7 b="z:w">\';9+=\'<s t="26\'+i+\'" c="4c" A="1k 4a"></s>\';9+=\'<7 t="47\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="h:1a; M:P K Q; v:0; J:0; C:1I; S-y:3M; 1r:3L;">\';3K(I 1b=8;1b<=3J;1b++){9+=\'<7 c="E" d="f 3I(\\\'\'+i+\'\\\',\\\'\'+1b+g+\'\\\')"><1Q b="r-u:1c;">\'+1b+\'</1Q></7>\'}9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<7 b="z:w">\';9+=\'<s t="1R\'+i+\'" c="3H" A="1k"></s>\';9+=\'<7 t="3D\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="h:1a; M:P K Q; v:0; J:0; C:1e; S:16;">\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1s\'+g+\'\\\')"><r 10="1s" u="2">1s</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1u 1v\'+g+\'\\\')"><r 10="1u 1v" u="2">1u 1v</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1w 1x 1y\'+g+\'\\\')"><r 10="1w 1x 1y" u="2">1w 1x 1y</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1z 17\'+g+\'\\\')"><r 10="1z 17" u="2">1z 17</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1B\'+g+\'\\\')"><r 10="1B" u="2">1B</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1C\'+g+\'\\\')"><r 10="1C" u="2">1C</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1D 17 1E\'+g+\'\\\')"><r 10="1D 17 1E" u="2">1D 17 1E</r></7>\';9+=\'<7 c="E" d="f R(\\\'\'+i+\'\\\',\\\'1F\'+g+\'\\\')"><r 10="1F" u="2">1F</r></7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<s c="3C" d="f 3B(\\\'\'+i+\'\\\')" A="2b 3A" b="z:w"></s>\';9+=\'<s c="3z" d="f 3y(\\\'\'+i+\'\\\')" A="2b 3x" b="z:w"></s>\';9+=\'<s c="3w" d="f 3v(\\\'\'+i+\'\\\')" A="1G 3u" b="z:w"></s>\';9+=\'<s c="3t" d="f 3s(\\\'\'+i+\'\\\')" A="1G 3r" b="z:w"></s>\';9+=\'<s c="3q" d="f 3p(\\\'\'+i+\'\\\')" A="1G 3o" b="z:w"></s>\';9+=\'<7 b="z:w">\';9+=\'<s t="2p\'+i+\'" c="3n" A="4l 2s"></s>\';9+=\'<7 t="3m\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="M:P K Q; v:0; J:0; C:1e; S:16;">\';9+=\'<7 c="k" b="h:#2v;" d="f m(\\\'\'+i+\'\\\',\\\'#2v\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2x;" d="f m(\\\'\'+i+\'\\\',\\\'#2x\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2y;" d="f m(\\\'\'+i+\'\\\',\\\'#2y\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2z;" d="f m(\\\'\'+i+\'\\\',\\\'#2z\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2A;" d="f m(\\\'\'+i+\'\\\',\\\'#2A\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2B;" d="f m(\\\'\'+i+\'\\\',\\\'#2B\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2C;" d="f m(\\\'\'+i+\'\\\',\\\'#2C\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2D;" d="f m(\\\'\'+i+\'\\\',\\\'#2D\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2E;" d="f m(\\\'\'+i+\'\\\',\\\'#2E\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2F;" d="f m(\\\'\'+i+\'\\\',\\\'#2F\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2G;" d="f m(\\\'\'+i+\'\\\',\\\'#2G\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2H;" d="f m(\\\'\'+i+\'\\\',\\\'#2H\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2I;" d="f m(\\\'\'+i+\'\\\',\\\'#2I\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2J;" d="f m(\\\'\'+i+\'\\\',\\\'#2J\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2K;" d="f m(\\\'\'+i+\'\\\',\\\'#2K\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2L;" d="f m(\\\'\'+i+\'\\\',\\\'#2L\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2M;" d="f m(\\\'\'+i+\'\\\',\\\'#2M\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#1X;" d="f m(\\\'\'+i+\'\\\',\\\'#1X\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2O;" d="f m(\\\'\'+i+\'\\\',\\\'#2O\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2P;" d="f m(\\\'\'+i+\'\\\',\\\'#2P\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2Q;" d="f m(\\\'\'+i+\'\\\',\\\'#2Q\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2R;" d="f m(\\\'\'+i+\'\\\',\\\'#2R\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2S;" d="f m(\\\'\'+i+\'\\\',\\\'#2S\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2T;" d="f m(\\\'\'+i+\'\\\',\\\'#2T\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2U;" d="f m(\\\'\'+i+\'\\\',\\\'#2U\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2V;" d="f m(\\\'\'+i+\'\\\',\\\'#2V\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2W;" d="f m(\\\'\'+i+\'\\\',\\\'#2W\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2X;" d="f m(\\\'\'+i+\'\\\',\\\'#2X\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2Y;" d="f m(\\\'\'+i+\'\\\',\\\'#2Y\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2Z;" d="f m(\\\'\'+i+\'\\\',\\\'#2Z\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#30;" d="f m(\\\'\'+i+\'\\\',\\\'#30\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#31;" d="f m(\\\'\'+i+\'\\\',\\\'#31\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#32;" d="f m(\\\'\'+i+\'\\\',\\\'#32\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#33;" d="f m(\\\'\'+i+\'\\\',\\\'#33\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#34;" d="f m(\\\'\'+i+\'\\\',\\\'#34\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#35;" d="f m(\\\'\'+i+\'\\\',\\\'#35\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#36;" d="f m(\\\'\'+i+\'\\\',\\\'#36\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#37;" d="f m(\\\'\'+i+\'\\\',\\\'#37\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#38;" d="f m(\\\'\'+i+\'\\\',\\\'#38\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#39;" d="f m(\\\'\'+i+\'\\\',\\\'#39\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3a;" d="f m(\\\'\'+i+\'\\\',\\\'#3a\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3b;" d="f m(\\\'\'+i+\'\\\',\\\'#3b\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3c;" d="f m(\\\'\'+i+\'\\\',\\\'#3c\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3d;" d="f m(\\\'\'+i+\'\\\',\\\'#3d\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3e;" d="f m(\\\'\'+i+\'\\\',\\\'#3e\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3f;" d="f m(\\\'\'+i+\'\\\',\\\'#3f\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3g;" d="f m(\\\'\'+i+\'\\\',\\\'#3g\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3h;" d="f m(\\\'\'+i+\'\\\',\\\'#3h\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3i;" d="f m(\\\'\'+i+\'\\\',\\\'#3i\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3j;" d="f m(\\\'\'+i+\'\\\',\\\'#3j\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3k;" d="f m(\\\'\'+i+\'\\\',\\\'#3k\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#3l;" d="f m(\\\'\'+i+\'\\\',\\\'#3l\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2t;" d="f m(\\\'\'+i+\'\\\',\\\'#2t\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2r;" d="f m(\\\'\'+i+\'\\\',\\\'#2r\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2q;" d="f m(\\\'\'+i+\'\\\',\\\'#2q\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2o;" d="f m(\\\'\'+i+\'\\\',\\\'#2o\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2n;" d="f m(\\\'\'+i+\'\\\',\\\'#2n\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2m;" d="f m(\\\'\'+i+\'\\\',\\\'#2m\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2l;" d="f m(\\\'\'+i+\'\\\',\\\'#2l\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2k;" d="f m(\\\'\'+i+\'\\\',\\\'#2k\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2j;" d="f m(\\\'\'+i+\'\\\',\\\'#2j\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2i;" d="f m(\\\'\'+i+\'\\\',\\\'#2i\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2h;" d="f m(\\\'\'+i+\'\\\',\\\'#2h\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2g;" d="f m(\\\'\'+i+\'\\\',\\\'#2g\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2f;" d="f m(\\\'\'+i+\'\\\',\\\'#2f\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2e;" d="f m(\\\'\'+i+\'\\\',\\\'#2e\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2d;" d="f m(\\\'\'+i+\'\\\',\\\'#2d\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2c;" d="f m(\\\'\'+i+\'\\\',\\\'#2c\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#2a;" d="f m(\\\'\'+i+\'\\\',\\\'#2a\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:#29;" d="f m(\\\'\'+i+\'\\\',\\\'#29\'+g+\'\\\')"></7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<7 b="z:w">\';9+=\'<s t="1T\'+i+\'" c="3E" A="3F 2s"></s>\';9+=\'<7 t="3G\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="M:P K Q; v:0; J:0; C:1e; S:16;">\';9+=\'<7 c="k" b="h:j(l,l,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,l,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,p,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,p,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(19,19,19);" d="f n(\\\'\'+i+\'\\\',\\\'j(19,19,19)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,q,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,q,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,o,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,o,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,51,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,51,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,0,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,0,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,p,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,p,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,o,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,o,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,0,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,0,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,0,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,0,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,0,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,0,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,0,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,0,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,0,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,0,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,p,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,p,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,q,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,q,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,q,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,q,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,o,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,o,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,o,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,o,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,51,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,51,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,51,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,51,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,l,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,l,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,l,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,l,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,p,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,p,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,p,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,p,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,q,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,q,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,o,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,o,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,51,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,51,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,l,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,l,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,l,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,l,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,l,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,l,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,p,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,p,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,q,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,q,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,o,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,o,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,o,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,51,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,l,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,l,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,l,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,l,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,l,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,l,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,p,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,p,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,q,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,q,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,o,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,o,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,51,0);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,51,0)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,l,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,l,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,l,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,l,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,p,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,p,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,p,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,p,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,q,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,q,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,o,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,o,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,51,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,51,51)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,l,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,l,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,l,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,l,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,p,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,p,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,o,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,o,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,51,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,51,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,0,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,0,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(0,0,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(0,0,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,p,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,p,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,q,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,q,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,o,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,o,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,51,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,51,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,0,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,0,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,51,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,51,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,0,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,0,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,p,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,p,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(l,q,l);" d="f n(\\\'\'+i+\'\\\',\\\'j(l,q,l)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,o,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,o,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(p,51,p);" d="f n(\\\'\'+i+\'\\\',\\\'j(p,51,p)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(q,51,q);" d="f n(\\\'\'+i+\'\\\',\\\'j(q,51,q)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(o,51,o);" d="f n(\\\'\'+i+\'\\\',\\\'j(o,51,o)\'+g+\'\\\')"></7>\';9+=\'<7 c="k" b="h:j(51,0,51);" d="f n(\\\'\'+i+\'\\\',\\\'j(51,0,51)\'+g+\'\\\')"></7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<s c="3N" d="f 3O(\\\'\'+i+\'\\\')" A="3P 1N" b="z:w"></s>\';9+=\'<s c="3Q" d="f 3R(\\\'\'+i+\'\\\')" A="3S" b="z:w"></s>\';9+=\'<s c="3T" d="f 3U(\\\'\'+i+\'\\\')" A="3V" b="z:w"></s>\';9+=\'<s c="3W" d="f 3X(\\\'\'+i+\'\\\')" A="3Y" b="z:w"></s>\';9+=\'<s c="3Z" d="f 40(\\\'\'+i+\'\\\')" A="41" b="z:w"></s>\';9+=\'<s c="42" d="f 43(\\\'\'+i+\'\\\')" A="44" b="z:w"></s>\';9+=\'<s c="45" d="f 46(\\\'\'+i+\'\\\')" A="1H 48 49" b="z:w"></s>\';9+=\'<7 b="z:w">\';9+=\'<s t="28\'+i+\'" c="4b" A="1g 25"></s>\';9+=\'<7 t="4d\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="h:1a; M:P K Q; v:0; J:0; C:1J; S:16;">\';9+=\'<7 t="4f\'+i+\'" b="v:O; r-u:12;">1g a 25:</7>\';9+=\'<7 t="4h\'+i+\'" b="v:O; r-u:12;">\';9+=\'<H t="4j\'+i+\'" 20="1Z://" G="14" b="C:1U" b="v:O;"/> <H G="1j" b="v:N; r-u:1c;" d="f 4q(\'+i+\');"/>\';9+=\'<1O /><H t="4r\'+i+\'" G="4s"/> 4t 4u 4v 4w?\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<7 b="z:w">\';9+=\'<s t="1M\'+i+\'" c="4y" A="1H 1L"></s>\';9+=\'<7 t="4A\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="h:1a; M:P K Q; v:0; J:0; C:1J; S:16;">\';9+=\'<7 t="4B\'+i+\'" b="v:O; r-u:12;">1g a 1L:</7>\';9+=\'<7 t="4C\'+i+\'" b="v:O; r-u:12;">\';9+=\'<H t="4D\'+i+\'" G="14" 1d="2N" b="v:N; C:1I;"/> x <H t="4H\'+i+\'" G="14" 1d="4I" b="v:N; C:1I;"/>\';9+=\'<H t="4J\'+i+\'" G="14" 20="1Z://"b="C:1U; v:N; J-27:O;"/> <H G="1j" b="v:N; r-u:1c;" d="f 4L(\'+i+\');"/>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<7 b="z:w">\';9+=\'<s t="24\'+i+\'" c="4N" A="1H 23"></s>\';9+=\'<7 t="4P\'+i+\'" b="Y:Z; L:g;">\';9+=\'<7 b="h:1a; M:P K Q; v:0; J:0; C:1J; S:16;">\';9+=\'<7 t="4Q\'+i+\'" b="v:O; r-u:12;">1g a 23:</7>\';9+=\'<7 t="4R\'+i+\'" b="v:O; r-u:12;">\';9+=\'<H t="4S\'+i+\'" G="14" 1d="4T" b="v:N; C:1A;"/> x <H t="4V\'+i+\'" G="14" 1d="4W" b="v:N; C:1A;"/>\';9+=\'<1O /><H t="4X\'+i+\'" G="14" 1d="2N" b="v:N; C:1A; J-27:O;"/> <21 t="4Z\'+i+\'"><1h>52</1h><1h>53</1h></21> <H G="1j" b="v:N; r-u:1c;" d="f 54(\'+i+\');"/>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'</7>\';9+=\'<7 b="55:56;"></7>\';1V.57=9;1n.1S(15);I B=i;D.F(\'26\'+B).11("V",W(e){e.U();e.X();5f(B)},T);D.F(\'1R\'+B).11("V",W(e){e.U();e.X();5h(B)},T);D.F(\'2w\'+B).11("V",W(e){e.U();e.X();5i(B)},T);D.F(\'2p\'+B).11("V",W(e){e.U();e.X();5j(B)},T);D.F(\'1T\'+B).11("V",W(e){e.U();e.X();5k(B)},T);D.F(\'28\'+B).11("V",W(e){e.U();e.X();5l(B)},T);D.F(\'1M\'+B).11("V",W(e){e.U();e.X();5m(B)},T);D.F(\'24\'+B).11("V",W(e){e.U();e.X();5n(B)},T);',62,334,'|||||||div||btn_content||style|class|onclick||return|none|background||rgb|btn_ce_editor_font_color|255|ce_font_color|ce_font_highlights|102|204|153|font|button|id|size|padding|left|||float|title|i_resize|width|document|btn_ce_editor_font|getElementById|type|input|var|margin|solid|display|border|2px|5px|1px|gray|ce_font_face|overflow|false|preventDefault|click|function|stopPropagation|position|absolute|face|addEventListener|14px|ce_font_heading|text|frame|hidden|New|Heading|192|white|fontSizeCount|12px|placeholder|119px|setAttribute|Add|option|textarea_id|submit|Font|createElement|get_textarea_height_style|box_id|get_textarea_width_style|ta|buttons|height|Arial|box|Century|Gothic|Comic|Sans|MS|Courier|55px|Georgia|Tahoma|Times|Roman|Verdana|Justify|Insert|50px|259px|else|Image|ce_editor_btn_add_image|Format|br|if|span|ce_editor_btn_font_format|appendChild|ce_editor_btn_font_highlights|auto|ce_btn|ce_text_editor_buttons|ff6600|ce_editor_bold|http|value|select|ce_box|Table|ce_editor_btn_add_table|Link|ce_editor_btn_font_size|top|ce_editor_btn_add_link|330033|663366|Indent|993399|cc33cc|cc66cc|ff99ff|ffccff|330099|333399|6600cc|6633ff|6666cc|9999ff|ccccff|000066|ce_editor_btn_font_color|000099|3333ff|color|3366ff|Normal|ffffff|ce_editor_btn_font_heading|cccccc|c0c0c0|999999|666666|333333|000000|ffcccc|ff6666|ff0000|cc0000|990000|660000|330000|ffcc99|ff9966|ff9900|Width|cc6600|993300|663300|ffff99|ffff66|ffcc66|ffcc33|ff9933|996633|663333|ffffcc|ffff33|ffff00|ffcc00|999900|666600|333300|99ff99|66ff99|33ff33|33cc00|009900|006600|003300|99ffff|33ffff|66cccc|00cccc|339999|336666|003333|ccffff|66ffff|33ccff|ce_editor_font_color_hidden|ce_editor_font_color|Right|ce_justify_right|ce_editor_justify_right|Center|ce_justify_center|ce_editor_justify_center|Left|ce_justify_left|ce_editor_justify_left|Less|ce_outdent|ce_editor_indent_less|More|ce_indent|ce_editor_indent_more|ce_editor_font_format_hidden|ce_editor_font_highlights|Background|ce_editor_font_highlights_hidden|ce_editor_font|ce_font_size|72|for|150px|scroll|ce_editor_remove_format|ce_font_remove_format|Remove|ce_editor_numbering|ce_orderList|Numbering|ce_editor_bullet|ce_bullets|Bullets|ce_editor_strikethrough|ce_strikeThrough|Strikethrough|ce_editor_substrike|ce_subScript|Subscript|ce_editor_superscript|ce_superScript|Superscript|ce_editor_horizontal|ce_horizontalRule|ce_editor_font_size_hidden|horizontal|rule|Size|ce_editor_link|ce_editor_font_size|ce_editor_add_link_hidden|8px|ce_add_link_url3ce_editor_add_link_hidden|H6|ce_add_link_urlce_editor_add_link_hidden|10px|ce_add_link_url2ce_editor_add_link_hidden|H5|Text|H4|H3|16px|H2|ce_link_button|ce_add_link_url4ce_editor_add_link_hidden|checkbox|Open|in|new|tab|18px|ce_editor_addImage|H1|ce_editor_add_image_hidden|ce_add_imagece_editor_add_image_hidden|ce_add_image2ce_editor_add_image_hidden|ce_add_image4ce_editor_add_image_hidden|ce_editor_font_heading_hidden|ce_editor_font_format|Underline|ce_add_image5ce_editor_add_image_hidden|Height|ce_add_image3ce_editor_add_image_hidden|ce_underline|ce_insertImage|ce_editor_underline|ce_editor_insertTable|Italic|ce_editor_add_table_hidden|ce_add_tablece_editor_add_table_hidden|ce_add_table2ce_editor_add_table_hidden|ce_add_table4ce_editor_add_table_hidden|Columns|ce_italic|ce_add_table5ce_editor_add_table_hidden|Rows|ce_add_table6ce_editor_add_table_hidden|ce_editor_italic|ce_add_table3ce_editor_add_table_hidden|Bold||Percent|Pixel|ce_table_button|clear|both|innerHTML|ce_bold|insertAfter|fff|ebebeb|ce_text_editor|iframe|textarea|toggle_font_size|getElementsByTagName|toggle_font_format|toggle_font_heading|toggle_font_color|toggle_font_highlights|toggle_add_link|toggle_add_image|toggle_add_table'.split('|'),0,{}));

		}());

	}



	for(var k = 0; k < textarea.length; k++)

	{

		(function () {

			var get_value = document.getElementById("ta"+k).value;

			

			if( ! get_value)

			{

				get_value = "<br />";

			}

			

			var get_iframe =  document.getElementById("ce_text_editor"+k);

			get_iframe.contentDocument.write(get_value);

			

			if (get_iframe.contentDocument) 

			{

				iFrameBody[k] = get_iframe.contentDocument.getElementsByTagName('body')[0];

				get_iframe.contentDocument.getElementsByTagName('body')[0].style.fontFamily = "Arial";

				get_iframe.contentDocument.getElementsByTagName('body')[0].style.fontSize = "12px";

			}

			else if (get_iframe.contentWindow) 

			{

				iFrameBody[k] = get_iframe.contentWindow.document.getElementsByTagName('body')[0];

				get_iframe.contentWindow.document.getElementsByTagName('body')[0].style.fontFamily = "Arial";

				get_iframe.contentWindow.document.getElementsByTagName('body')[0].style.fontSize = "12px";

			}

			else

			{

				alert("CE Editor Error: contentDocument not supported.");

			}

			

			/* Prevent Drop Down Show */

			get_iframe.contentDocument.addEventListener("click", function(e)

			{

				if (show_dropdown && (e.target.parentNode !== document.getElementById(show_ids)) && (e.target !== document.getElementById(show_ids))){    

					document.getElementById(show_ids).style.display = "none";

					show_dropdown = false;

				}

			},false);

			

			/* get_iframe.contentDocument.getElementsByTagName('body')[0].setAttribute('onkeypress','update()'); */

			var textarea_update = document.createElement("script");

			var textarea_update_script = "setInterval(update,100);";

			textarea_update_script += 'function update()';

			textarea_update_script += '{';

				textarea_update_script += 'var a = document.getElementsByTagName(\'body\')[0].innerHTML;';

				textarea_update_script += 'a = a.replace('+/<b(\s+|>)/g+', "<strong$1");';

				textarea_update_script += 'a = a.replace('+/<\/b(\s+|>)/g+', "</strong$1");';

				textarea_update_script += 'a = a.replace('+/<i(\s+|>)/g+', "<em$1");';

				textarea_update_script += 'a = a.replace('+/<\/i(\s+|>)/g+', "</em$1");';

				textarea_update_script += 'a = a.replace('+/<!(?:--[\s\S]*?--\s*)?>\s*/g+', "");';

				textarea_update_script += 'a = a.replace('+/&nbsp;/gi+', " ");';

				textarea_update_script += 'a = a.replace('+/ <\//gi+', "</");';

				textarea_update_script += 'a = a.replace('+/^\s*|\s*$/g+', "");';

				textarea_update_script += 'a = a.replace('+/<\?xml[^>]*>/g+', "");';

				textarea_update_script += 'a = a.replace('+/<[^ >]+:[^>]*>/g+', "");';

				textarea_update_script += 'a = a.replace('+/<\/[^ >]+:[^>]*>/g+', "");';

				/* textarea_update_script += 'a = a.replace('+/<(div|span|style|meta|link){1}.*?>/gi+',"");'; */

				textarea_update_script += 'parent.document.getElementById(\'ta'+k+'\').innerHTML = a;';

			textarea_update_script += '}';

			textarea_update.innerHTML = textarea_update_script;

			get_iframe.contentDocument.getElementsByTagName('head')[0].appendChild(textarea_update);

			

			/* CSS */

			var styles_create = document.createElement("style");

			var style_script = "hr { border:1px solid #ccc; height } table{ border-collapse:collapse; border:1px solid #bbb; }";

			styles_create.innerHTML = style_script;

			get_iframe.contentDocument.getElementsByTagName('head')[0].appendChild(styles_create);

			

			/* Meta Tags UTF-8 */

			var meta = document.createElement("meta");

			meta.setAttribute('http-equiv','content-type');

			meta.setAttribute('content','text/html; charset=UTF-8');

			get_iframe.contentDocument.getElementsByTagName('head')[0].appendChild(meta);

			

			/* For Future

			get_iframe.contentDocument.getElementsByTagName('body')[0].setAttribute('onkeypress','detectBold()');

			get_iframe.contentDocument.getElementsByTagName('body')[0].setAttribute('onmouseup','detectBold()');

			var d_bold = document.createElement("script");

			var d_bold_text = "";

			d_bold_text += 'function detectBold()';

			d_bold_text += '{';

				d_bold_text += 'if(document.queryCommandState) {';

					d_bold_text += 'isBold = document.queryCommandState("bold");';

				d_bold_text += '}';

				d_bold_text += 'if (document.designMode == "on") {';

					d_bold_text += 'document.designMode = "off";';

				d_bold_text += '}';

				d_bold_text += 'if(isBold)';

				d_bold_text += '{';

					d_bold_text += 'parent.document.getElementById(\'ce_editor_bold'+k+'\').style.border = "1px solid red";';

				d_bold_text += '}';

				d_bold_text += 'else';

				d_bold_text += '{';

					d_bold_text += 'parent.document.getElementById(\'ce_editor_bold'+k+'\').style.border = "0";';

				d_bold_text += '}';

			d_bold_text += '}';

			d_bold.innerHTML = d_bold_text;

			get_iframe.contentDocument.getElementsByTagName('body')[0].appendChild(d_bold);

			*/

			

			var ce_text_editor = document.getElementById("ce_text_editor"+k);

			ce_editor[k] = ce_text_editor.contentWindow.document;

			

			var ce_editor_body = ce_editor[k].body;

			

			if('spellcheck' in ce_editor_body)

			{

				ce_editor_body.spellcheck = false;

			}

			else

			{

				console.log("ERROR");

			}



			if('contentEditable' in ce_editor_body)

			{

				ce_editor_body.contentEditable = true;

			}

			else

			{

				if('designMode' in ce_editor[k])

				{

					ce_editor[k].designMode = "on";

				}

				else

				{

					console.log("ERROR");

				}

			}

		}());

	}

}



eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('9 16(a){j a=2.3(a);a.1h=""}9 1l(a,b){j a=2.3(a);a.4.Y=b}9 1m(a){f[a].g(\'1j\',6,k);e 6}9 1p(a){f[a].g(\'1r\',6,k);e 6}9 1s(a){f[a].g(\'1v\',6,k);e 6}9 1a(a,b){f[a].g(\'1b\',6,\'<\'+b+\'>\');e 6}9 1c(a,b){f[a].g(\'1g\',6,7);j c=f[a].1k("N");I(j i=0,U=c.1q;i<U;++i){n(c[i].H=="7"){c[i].1t("H");c[i].4.1u=b+"O"}}e 6}9 1w(a,b){f[a].g(\'1x\',6,b);e 6}9 1y(a){f[a].g(\'1z\',6,k);e 6}9 1A(a){f[a].g(\'1J\',6,k);e 6}9 1M(a){f[a].g(\'1O\',6,k);e 6}9 1Q(a){f[a].g(\'1R\',6,k);e 6}9 1T(a){f[a].g(\'1U\',6,k);e 6}9 1V(a,b){f[a].g(\'1X\',6,\'\'+b+\'\');e 6}9 1Y(a,b){f[a].g(\'1Z\',6,\'\'+b+\'\');e 6}9 20(a){f[a].g(\'23\',6,k);e 6}9 24(a){f[a].g(\'25\',6,k);e 6}9 26(a){f[a].g(\'27\',6,k);e 6}9 28(a){f[a].g(\'12\',6,k);e 6}9 13(a){f[a].g(\'14\',6,k);e 6}9 15(a){f[a].g(\'2a\',6,k);e 6}9 17(a){f[a].g(\'18\',6,k);e 6}9 19(a){2.3(\'Q\').4.5="8";2.3(\'Q-1d\').4.5="8";j b=f[a].1e();j c=2.3(\'1f\'+a).l;j d=2.3(\'1i\'+a);n(b==""){n(d.M)f[a].g(\'E\',6,\'<a G="\'+c+\'" P="11">\'+c+\'</a>\');F f[a].g(\'E\',6,\'<a G="\'+c+\'">\'+c+\'</a>\')}F{n(d.M)f[a].g(\'E\',6,\'<a G="\'+c+\'" P="11">\'+b+\'</a>\');F f[a].g(\'E\',6,\'<a G="\'+c+\'">\'+b+\'</a>\')}e 6}9 1o(a){C="t"+a;A=B;2.3("v"+a).4.5="8";2.3("t"+a).4.5="D";2.3("y"+a).4.5="8";2.3("s"+a).4.5="8";2.3("o"+a).4.5="8";2.3("m"+a).4.5="8";2.3("q"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1B(a){C="y"+a;A=B;2.3("v"+a).4.5="8";2.3("t"+a).4.5="8";2.3("y"+a).4.5="D";2.3("s"+a).4.5="8";2.3("o"+a).4.5="8";2.3("m"+a).4.5="8";2.3("q"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1C(a){C="s"+a;A=B;2.3("v"+a).4.5="8";2.3("t"+a).4.5="8";2.3("y"+a).4.5="8";2.3("s"+a).4.5="D";2.3("o"+a).4.5="8";2.3("m"+a).4.5="8";2.3("q"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1D(a){C="v"+a;A=B;2.3("v"+a).4.5="D";2.3("t"+a).4.5="8";2.3("y"+a).4.5="8";2.3("s"+a).4.5="8";2.3("o"+a).4.5="8";2.3("m"+a).4.5="8";2.3("q"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1E(a){C="o"+a;A=B;2.3("v"+a).4.5="8";2.3("t"+a).4.5="8";2.3("y"+a).4.5="8";2.3("s"+a).4.5="8";2.3("o"+a).4.5="D";2.3("m"+a).4.5="8";2.3("q"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1F(a){C="m"+a;A=B;2.3("m"+a).4.5="D";2.3("v"+a).4.5="8";2.3("t"+a).4.5="8";2.3("y"+a).4.5="8";2.3("s"+a).4.5="8";2.3("o"+a).4.5="8";2.3("q"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1G(a){C="q"+a;A=B;2.3("q"+a).4.5="D";2.3("m"+a).4.5="8";2.3("v"+a).4.5="8";2.3("t"+a).4.5="8";2.3("y"+a).4.5="8";2.3("s"+a).4.5="8";2.3("o"+a).4.5="8";2.3("u"+a).4.5="8";e 6}9 1H(a){C="u"+a;A=B;2.3("u"+a).4.5="D";2.3("q"+a).4.5="8";2.3("m"+a).4.5="8";2.3("v"+a).4.5="8";2.3("t"+a).4.5="8";2.3("y"+a).4.5="8";2.3("s"+a).4.5="8";2.3("o"+a).4.5="8";e 6}9 1I(a){j r=2.3(\'1K\'+a).l;j c=2.3(\'1L\'+a).l;j w=2.3(\'1N\'+a).l;j p=2.3(\'1P\'+a).l;n(!r||!c){f[a].g(\'E\',6,\'\')}F{n(L.J(r)&&L.J(c)){n(L.J(r)){n(p=="1S")j b="K:"+w+"O";F j b="K:"+w+"%"}F{j b=""}j d=\'\';d+=\'<R Y="1" 4="N-H:1W; \'+b+\'">\';I(j z=1;z<=c;z++){d+=\'<T>\';I(j x=1;x<=r;x++){d+=\'<V>&21;</V>\'}d+=\'</T>\'}d+=\'</R>\';f[a].g(\'E\',6,d)}}e 6}9 22(a){j b=2.3(\'W\'+a).l;j w=2.3(\'X\'+a).l;j h=2.3(\'Z\'+a).l;n(w||h)f[a].g(\'E\',6,\'<10 S="\'+b+\'" K="\'+w+\'" 29="\'+h+\'"/>\');F f[a].g(\'E\',6,\'<10 S="\'+b+\'"/>\');2.3(\'W\'+a).l="1n://";2.3(\'X\'+a).l="";2.3(\'Z\'+a).l="";e 6}',62,135,'||document|getElementById|style|display|false||none|function|||||return|ce_editor|execCommand|||var|null|value|ce_editor_add_link_hidden|if|ce_editor_font_heading_hidden||ce_editor_add_image_hidden||ce_editor_font_color_hidden|ce_editor_font_size_hidden|ce_editor_add_table_hidden|ce_editor_font_highlights_hidden|||ce_editor_font_format_hidden||show_dropdown|true|show_ids|block|insertHTML|else|href|size|for|test|width|filter_int|checked|font|px|target|cc|table|src|tr|len|td|ce_add_image3ce_editor_add_image_hidden|ce_add_image4ce_editor_add_image_hidden|border|ce_add_image5ce_editor_add_image_hidden|img|_blank|strikeThrough|ce_subScript|subscript|ce_superScript|ce_button|ce_horizontalRule|insertHorizontalRule|ce_link_button|ce_font_heading|formatBlock|ce_font_size|panel|getSelection|ce_add_link_url2ce_editor_add_link_hidden|fontsize|innerHTML|ce_add_link_url4ce_editor_add_link_hidden|bold|getElementsByTagName|ce_border|ce_bold|http|toggle_font_size|ce_underline|length|underline|ce_italic|removeAttribute|fontSize|italic|ce_font_face|FontName|ce_indent|Indent|ce_outdent|toggle_font_format|toggle_font_color|toggle_font_highlights|toggle_font_heading|toggle_add_link|toggle_add_image|toggle_add_table|ce_table_button|Outdent|ce_add_table5ce_editor_add_table_hidden|ce_add_table4ce_editor_add_table_hidden|ce_justify_left|ce_add_table6ce_editor_add_table_hidden|JustifyLeft|ce_add_table3ce_editor_add_table_hidden|ce_justify_center|JustifyCenter|Pixel|ce_justify_right|JustifyRight|ce_font_color|13px|ForeColor|ce_font_highlights|BackColor|ce_font_remove_format|nbsp|ce_insertImage|RemoveFormat|ce_orderList|insertOrderedList|ce_bullets|insertUnorderedList|ce_strikeThrough|height|superscript'.split('|'),0,{}));