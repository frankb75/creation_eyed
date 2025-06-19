<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
	</div>
	</div>
	</div>
</section>
</div>
</div>
<script type="text/javascript">
<?php 
	include(FCPATH."/themes/default/js/main.php");
	if( ! empty($js))
	{
		foreach($js as $javascript)
		{
			include(FCPATH."/themes/default/js/".$javascript.".php");
		}
    }
?>
/*
var rightNavHeight = document.getElementById('main-right-nav').clientHeight;
var mainHeight = document.getElementById('ani').clientHeight;
if(rightNavHeight > mainHeight)
{
	document.getElementById('ani').style.height = '1350px';
	document.getElementsByClassName('body')[0].style.height = '1030px';
}
*/
document.onkeypress = function (event) {
	event = (event || window.event);
	if (event.keyCode == 123) {
		return false;
	}
};
document.onmousedown = function (event) {
	event = (event || window.event);
	if (event.keyCode == 123) {
		return false;
	}
};
document.onkeydown = function (event) {
event = (event || window.event);
	if (event.keyCode == 123) {
		return false;
	}
};

function getScrollTop()
{
    if(typeof window.pageYOffset !== 'undefined' ){
		return window.pageYOffset;
    }

    var d = document.documentElement;
    if (d.clientHeight) {
		return d.scrollTop;
	}

    return document.body.scrollTop;
}

window.onscroll = function(){
	var box = document.getElementById('mini');
	scroll = getScrollTop();

	if(scroll <= 400){
		box.style.marginTop = 95 - scroll + "px";
		box.style.position = "fixed";
		console.log('a'+scroll);
	}else{
		box.style.position = "fixed";
		box.style.left = "82%";
		box.style.marginTop = "-290px";
		console.log('c');
	}
};
</script>
</body>
</html>