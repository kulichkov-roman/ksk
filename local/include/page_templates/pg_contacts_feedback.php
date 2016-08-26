<?
// Форма добавления / редактирования - http://dev.1c-bitrix.ru/user_help/content/iblock/components_2/element_add/iblock_element_add_form.php
$APPLICATION->IncludeComponent(
	"your:iblock.element.add.form", 
	"feedback-contacts", 
	array(
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "dynamic_content",
		"IBLOCK_ID" => "7",
		"PROPERTY_CODES" => array(
			0 => "7",
			1 => "NAME",
			2 => "PREVIEW_TEXT",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "7",
			1 => "NAME",
		),
		"GROUPS" => array(
			0 => "2",
		),
		"STATUS_NEW" => "N",
		"STATUS" => "ANY",
		"LIST_URL" => "",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "",
		"USER_MESSAGE_ADD" => "Спасибо за вопрос, наш менеджер свяжется в ближайшее время!",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "N",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"SEF_FOLDER" => "",
		"COMPONENT_TEMPLATE" => "feedback-contacts",
		"PREFIX_FORM" => "contacts"
	),
	false
);
?>
