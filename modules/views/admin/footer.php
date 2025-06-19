<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
	</div>
	</div>
	</div>
</section>
<footer>
<div class="footer">
	<div class="footer_body">
		<br />
	</div>
</div>
</footer>
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
</script>
</body>
</html>