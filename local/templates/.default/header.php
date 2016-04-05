<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html class="no-js" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?
	CJSCore::Init();

	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/main.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/vendor.css');

	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/modernizr.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/core.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/vendor.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/main.js');
	?>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" data-skip-moving="true"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" data-skip-moving="true"></script>
	<![endif]-->
	<?$APPLICATION->ShowHead()?>
</head>
	<?$APPLICATION->ShowPanel();?>