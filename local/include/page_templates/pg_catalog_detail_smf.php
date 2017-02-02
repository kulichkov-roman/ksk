<?$environment = \Your\Environment\EnvironmentManager::getInstance();?>

<div class="content__tab">
	<?
	$APPLICATION->IncludeComponent("bitrix:main.include", "",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/local/include/page_templates/pg_catalog_smf_title.php",
			"EDIT_TEMPLATE" => ""
		),
		false
	);
	?>
</div>
<div class="content__description">
	<?
	$APPLICATION->IncludeComponent("bitrix:main.include", "",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => "/local/include/site_templates/hd_breadcrumbs.php",
			"EDIT_TEMPLATE" => ""
		),
		false
	);
	?>
</div>
<?
$arVariables = array();
CComponentEngine::ParseComponentPath(
	$environment->get('catalogSmfPageUrl'),
	array('#ELEMENT_CODE#/'),
	$arVariables
);
$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"catalog", 
	array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "dynamic_content",
		"IBLOCK_ID" => $environment->get("catalogSmfIBlockId"),
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $arVariables["ELEMENT_CODE"],
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "PRICE_DELIVERY",
			2 => "PRICE_PICKUP",
			3 => "PARTS_BODY",
			4 => "",
		),
		"IBLOCK_URL" => "",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "catalog",
		"DETAIL_URL" => "",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);
?>
