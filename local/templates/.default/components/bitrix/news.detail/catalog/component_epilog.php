<?
use KSK\Helper;

$environment = \Your\Environment\EnvironmentManager::getInstance();
$CLastModifierHelper = KSK\Helper\LastModifierHelper::getInstance();

/*
 * Передать TIMESTAMP_X в кеш для установки в LastModifier
 * */
$CLastModifierHelper->setLastModifier(MakeTimeStamp($arResult['TIMESTAMP_X']));

/*
 * Форма заявки
 * */
$APPLICATION->IncludeComponent(
    "your:iblock.element.add.form",
    "order",
    array(
        "SEF_MODE" => "N",
        "IBLOCK_TYPE" => "dynamic_content",
        "IBLOCK_ID" => $environment->get('ordersIBlockId'),
        "PROPERTY_CODES" => array(
            0 => "NAME",
            1 => $environment->get('ordersPhonePropId'),
            2 => $environment->get('ordersEmailPropId'),
            3 => $environment->get('ordersProdPropId'),
            4 => $environment->get('ordersQuantityPropId'),
        ),
        "PROPERTY_CODES_REQUIRED" => array(
            0 => "NAME",
            1 => $environment->get('ordersPhonePropId'),
            2 => $environment->get('ordersEmailPropId'),
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
        "COMPONENT_TEMPLATE" => "order",
        "PREFIX_FORM" => "orders",
        "PRODUCT" => $arResult['NAME']
    ),
    false
);
?>
