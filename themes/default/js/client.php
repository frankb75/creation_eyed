<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
function open_div(val)
{
	var newVal = val.split("-");
	if(newVal.length == 3)
	{
		if(newVal[2] == "FALSE")
		{
			location.href = newVal[1];
		}
	}
	else
	{
		var xmlhttp;
		
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				if(xmlhttp.responseText == "Success")
				{
					location.href = newVal[1];
					document.getElementById('mainLoading').style.display = "inline";
				}
				else
				{
					document.getElementById('viewEvent'+newVal[0]).style.display = "block";
				}
			}
		};
		
		xmlhttp.open("GET","<?php echo base_url('gallery/checksession'); ?>/"+newVal[0],true);
		xmlhttp.send();
	}
}

function close_div(val)
{
	document.getElementById('viewEvent'+val).style.display = "none";
}