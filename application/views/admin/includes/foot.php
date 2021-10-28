    <script type="text/javascript" src="<?php public_assets("js/jquery.min.js") ?>"></script>
	<script type="text/javascript" src="<?php public_assets("js/popper.min.js") ?>"></script>
	<script type="text/javascript" src="<?php public_assets("js/bootstrap.min.js") ?>"></script>
	<?php if(isset($load_scripts)) { foreach($load_scripts as $src) { ?>
		<script type="text/javascript" src="<?php admin_assets($src) ?>"></script>
	<?php } } ?>
	<script type="text/javascript" src="<?php admin_assets('js/admin.js') ?>"></script>