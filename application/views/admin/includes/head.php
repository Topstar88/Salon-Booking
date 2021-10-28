<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php echo esc(isset($page_title) ? $page_title . ' - ' : ''); echo esc($page_data['general']['title']) ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php uploads('img/'.$page_data['general']['favicon']) ?>" />
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<!-- Fonts and icons -->
	<script type="text/javascript">"use strict";
		const base 			= '<?php echo esc(base_url()) ?>';
		const layout 		= '<?php echo esc(LAYOUT_CONTROLLER); ?>';
		const updates 		= '<?php echo esc(UPDATES_CONTROLLER); ?>';
		const blog 			= '<?php echo esc(BLOG_CONTROLLER); ?>';
		const adminblog 	= '<?php echo esc(ADMINBLOG_CONTROLLER); ?>';
		const bookings 		= '<?php echo esc(BOOKINGS_CONTROLLER); ?>';
		const services 		= '<?php echo esc(SERVICE_CONTROLLER); ?>';
		const gallery 		= '<?php echo esc(GALLERY_CONTROLLER); ?>';
		const clients 		= '<?php echo esc(CLIENTS_CONTROLLER); ?>';
		const agents 		= '<?php echo esc(AGENTS_CONTROLLER); ?>';
		const fonts 		= '<?php public_assets('css/fonts.min.css'); ?>';
	</script>
	<script type="text/javascript" src="<?php admin_assets('js/plugin/webfont/webfont.min.js') ?>"></script>
	<script type="text/javascript" src="<?php admin_assets('js/includes/font-loader.js'); ?>"></script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php public_assets("css/bootstrap.min.css") ?>">
	<link rel="stylesheet" href="<?php admin_assets("css/admin.css") ?> ">
</head>
<body class="<?php echo esc(isset($body_class) ? $body_class : '') ?>">