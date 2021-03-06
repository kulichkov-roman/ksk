<div class="content__content">
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
        <?
        $APPLICATION->IncludeComponent("bitrix:main.include", "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/local/include/page_templates/pg_catalog_smf_text.php",
                "EDIT_TEMPLATE" => ""
            ),
            false
        );
        ?>
    </div>
    <?$APPLICATION->IncludeComponent(
	    "bitrix:news.list",
	    "smf-catalog",
	    array(
	    	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	    	"ADD_SECTIONS_CHAIN" => "Y",
	    	"AJAX_MODE" => "N",
	    	"AJAX_OPTION_ADDITIONAL" => "",
	    	"AJAX_OPTION_HISTORY" => "N",
	    	"AJAX_OPTION_JUMP" => "N",
	    	"AJAX_OPTION_STYLE" => "Y",
	    	"CACHE_FILTER" => "N",
	    	"CACHE_GROUPS" => "Y",
	    	"CACHE_TIME" => "36000000",
	    	"CACHE_TYPE" => "A",
	    	"CHECK_DATES" => "Y",
	    	"DETAIL_URL" => "",
	    	"DISPLAY_BOTTOM_PAGER" => "Y",
	    	"DISPLAY_DATE" => "Y",
	    	"DISPLAY_NAME" => "Y",
	    	"DISPLAY_PICTURE" => "Y",
	    	"DISPLAY_PREVIEW_TEXT" => "Y",
	    	"DISPLAY_TOP_PAGER" => "N",
	    	"FIELD_CODE" => array(
	    		0 => "",
	    		1 => "",
	    	),
	    	"FILTER_NAME" => "",
	    	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	    	"IBLOCK_ID" => "8",
	    	"IBLOCK_TYPE" => "dynamic_content",
	    	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	    	"INCLUDE_SUBSECTIONS" => "Y",
	    	"MESSAGE_404" => "",
	    	"NEWS_COUNT" => "99",
	    	"PAGER_BASE_LINK_ENABLE" => "N",
	    	"PAGER_DESC_NUMBERING" => "N",
	    	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	    	"PAGER_SHOW_ALL" => "N",
	    	"PAGER_SHOW_ALWAYS" => "N",
	    	"PAGER_TEMPLATE" => ".default",
	    	"PAGER_TITLE" => "Новости",
	    	"PARENT_SECTION" => "",
	    	"PARENT_SECTION_CODE" => "",
	    	"PREVIEW_TRUNCATE_LEN" => "",
	    	"PROPERTY_CODE" => array(
	    		0 => "COMPOSITION",
	    		1 => "PRICE_DELIVERY",
	    		2 => "",
	    	),
	    	"SET_BROWSER_TITLE" => "Y",
	    	"SET_LAST_MODIFIED" => "N",
	    	"SET_META_DESCRIPTION" => "Y",
	    	"SET_META_KEYWORDS" => "Y",
	    	"SET_STATUS_404" => "Y",
	    	"SET_TITLE" => "Y",
	    	"SHOW_404" => "N",
	    	"SORT_BY1" => "SORT",
	    	"SORT_BY2" => "",
	    	"SORT_ORDER1" => "ASC",
	    	"SORT_ORDER2" => "",
	    	"COMPONENT_TEMPLATE" => "smf-catalog"
	    ),
	    false
    );?>
</div>
