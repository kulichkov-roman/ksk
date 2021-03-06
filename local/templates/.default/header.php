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

	$environment = \Your\Environment\EnvironmentManager::getInstance();

	$arBodyClasses    = $environment->get('bodyClassesTemplates');
	$arContentClasses = $environment->get('contentClassesTemplates');
	$arHeaderSliderClasses = $environment->get('headerSliderClassesTemplates');

	$isMain = CSite::InDir(SITE_DIR.'index.php');
	$isCatalogMeat = CSite::InDir(SITE_DIR.'catalog_meat/');
	$isNewsDetail  = preg_match('~^/news/[^/]+/~', $_SERVER['REQUEST_URI']);
	$isCatalogMeatDetail = preg_match('~^/catalog_meat/[^/]+/~', $_SERVER['REQUEST_URI']);
	$isCatalogSmfDetail  = preg_match('~^/catalog_smf/[^/]+/~', $_SERVER['REQUEST_URI']);
	$is404 = CSite::InDir(SITE_DIR.'404.php') || defined('ERROR_404') === true;
	$isMap = CSite::InDir(SITE_DIR.'search/map.php');

	$curDir = $APPLICATION->GetCurDir();

	// Деталка новостей
	if($isNewsDetail) {
		$curDir = $environment->get('newsDetailDir');
	}

	// Деталка каталога с мясом
	if($isCatalogMeatDetail) {
		$curDir = $environment->get('catalogMeatDetailDir');
	}

	// Деталка каталога с полуфабрикатами
	if($isCatalogSmfDetail) {
		$curDir = $environment->get('catalogSmfDetailDir');
	}

	// 404 страница
	if($is404) {
		$curDir = $environment->get('page404');
	}

	// Карта сайта
	if($isMap) {
		$curDir = $environment->get('pageMap');
	}

	$APPLICATION->AddHeadString('
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic&amp;amp;subset=cyrillic,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i&amp;amp;subset=cyrillic,cyrillic-ext" rel="stylesheet" type="text/css"><link href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="/favicon.ico">
	');

	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/jquery-ui-1.12.1.custom/jquery-ui.min.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/slick-1.4.1/slick.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/fancybox-2.1.5/jquery.fancybox.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/js/fancybox-2.1.5/helpers/jquery.fancybox-thumbs.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/style.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/developers.css');

	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-1.11.2.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-ui-1.12.1.custom/jquery-ui.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.ui.dialogBodyScroll.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/slick-1.4.1/slick.min.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox-2.1.5/jquery.fancybox.pack.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/fancybox-2.1.5/helpers/jquery.fancybox-thumbs.js');

	$APPLICATION->AddHeadString('
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.min.js"></script>
	');

	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/init.js');
	?>

	<?$APPLICATION->ShowHead()?>

	<?$APPLICATION->IncludeComponent('bitrix:main.include', '',
		Array(
			'AREA_FILE_SHOW' => 'file',
			'PATH' => '/local/include/site_templates/hd_ga.php',
			'EDIT_TEMPLATE' => ''
		),
		false
	);
	$APPLICATION->IncludeComponent('bitrix:main.include', '',
		Array(
			'AREA_FILE_SHOW' => 'file',
			'PATH' => '/local/include/site_templates/hd_jvs.php',
			'EDIT_TEMPLATE' => ''
		),
		false
	);?>

	<meta property="og:title" content="Корниловский свинокомплекс"/>
	<meta property="og:url" content="http://мясо54.рф/"/>
	<meta property="og:image" content="http://xn--54-7lcio7f.xn--p1ai/local/templates/.default/images/pig-part-0.png"/>
	<meta property="og:image:type" content="image/png" />
	<meta property="og:description" content="Полезное и вкусное мяcо, только натуральные корма, племенной репродуктор"/>
</head>
<body <?=$arBodyClasses[$curDir] ? 'class="'.$arBodyClasses[$curDir].'"' : '';?>>
	<?$APPLICATION->ShowPanel();?>
	<?$APPLICATION->IncludeComponent('bitrix:main.include', '',
		Array(
			'AREA_FILE_SHOW' => 'file',
			'PATH' => '/local/include/site_templates/hd_ya.php',
			'EDIT_TEMPLATE' => ''
		),
		false
	);?>
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
			if($isMain)
			{
				$APPLICATION->IncludeComponent("bitrix:main.include", "",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/local/include/site_templates/hd_slider_main.php",
						"EDIT_TEMPLATE" => ""
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);
			}
			else
			{
				?><section class="header-slider <?=$arHeaderSliderClasses[$curDir] ? $arHeaderSliderClasses[$curDir] : '';?>"></section><?
			}
			?>
		</header>
		<section class="content <?=$arContentClasses[$curDir] ? $arContentClasses[$curDir] : '';?>">
			<div class="content__inner">
				<div class="content__substrate">
					<?if(!$isMain && !$is404){?>
						<?
						$APPLICATION->IncludeComponent("bitrix:main.include", "",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => "/local/include/site_templates/hd_seo_description.php",
								"EDIT_TEMPLATE" => ""
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);
						?>
					<?}?>
				</div>
				<div class="content__content">
