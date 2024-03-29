<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="google-site-verification" content="ZFuymgQ3ja41PCnmKa0QArJpllxRFKIRiHKSdwdCGwc" />
	<title><?php echo wp_title() ?></title>
	<?php wp_head(); ?>
</head>
<body class="text-dark">

<?php get_template_part('/components/boardhouse-header'); ?>
<?php get_template_part('/components/header/boardhouse-sticky-header'); ?>
<?php get_template_part('/components/header/boardhouse-nav-mobile'); ?>
