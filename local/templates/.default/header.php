<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html><!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html>

<!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" width="960">
	<title><?$APPLICATION->ShowTitle()?></title>
	<?
	CJSCore::Init();

	$APPLICATION->AddHeadString('
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500italic,400italic,500" rel="stylesheet" type="text/css">
	');

	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/slick-1.4.1/slick.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/fancybox-2.1.5/jquery.fancybox.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.css');

	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-1.11.2.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/slick-1.4.1/slick.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox-2.1.5/jquery.fancybox.pack.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/init.js');
	?>
	<?$APPLICATION->ShowHead()?>
</head>
<body>
	<?$APPLICATION->ShowPanel();?>
	<div class="wrapper">
		<header class="header">
			<?
			$APPLICATION->IncludeComponent("bitrix:main.include", "",
				Array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/local/include/site_templates/hd_main_menu.php",
					"EDIT_TEMPLATE" => ""
				),
				false
			);
			$APPLICATION->IncludeComponent("bitrix:main.include", "",
				Array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/local/include/site_templates/hd_slider_main.php",
					"EDIT_TEMPLATE" => ""
				),
				false,
				Array('HIDE_ICONS' => 'Y')
			);
			?>
		</header>
		<?
		$APPLICATION->IncludeComponent("bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/local/include/site_templates/hd_news_main.php",
				"EDIT_TEMPLATE" => ""
			),
			false,
			Array('HIDE_ICONS' => 'Y')
		);
		$APPLICATION->IncludeComponent("bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/local/include/site_templates/hd_rewards_main.php",
				"EDIT_TEMPLATE" => ""
			),
			false,
			Array('HIDE_ICONS' => 'Y')
		);
		?>
