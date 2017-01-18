<div class="content__content">
	<div class="content__tab">
		<?
		$APPLICATION->IncludeComponent("bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/local/include/page_templates/pg_catalog_meat_title.php",
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
		<?
		$APPLICATION->IncludeComponent("bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/local/include/page_templates/pg_catalog_meat_text.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);
		?>
	</div>
	<?$APPLICATION->IncludeComponent(
		"your:section.element.group",
		"catalog-meat",
		array(
			"COMPONENT_TEMPLATE" => "catalog-meat",
			"IBLOCK_TYPE" => "dynamic_content",
			"IBLOCK_ID" => "5",
			"NEWS_COUNT" => "99",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "PRICE_DELIVERY",
				1 => "PRICE_PICKUP",
				2 => "PARTS_BODY",
				3 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => array(
			),
			"PARENT_SECTION_CODE" => array(
			),
			"INCLUDE_SUBSECTIONS" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"PAGER_TEMPLATE" => ".default",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"SECTION_DEPTH" => "1",
			"SECTION_COUNT" => "30",
			"SECTION_SORT_BY1" => "ID",
			"SECTION_SORT_ORDER1" => "DESC",
			"SECTION_SORT_BY2" => "SORT",
			"SECTION_SORT_ORDER2" => "ASC",
			"SECTION_FILTER_NAME" => "",
			"SECTION_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"SECTION_DETAIL_URL" => "#ELEMENT_CODE#/",
			"SECTION_CHECK_EMPTY" => "Y",
			"SECTION_CNT_ELEMENTS" => "N",
			"SECTION_CHILD" => "Y",
			"DISPLAY_SECTION_PICTURE" => "Y",
			"SECTION_PREVIEW_TRUNCATE_LEN" => "",
			"NEWS_SHOW_SECTION" => "Y",
			"TEMP_OUTPUT_SECTIONS" => "subSection.php",
			"TEMP_OUTPUT_ELEMENTS" => "element.php"
		),
		false
	);?>
</div>
