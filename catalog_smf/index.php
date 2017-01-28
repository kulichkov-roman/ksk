<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Вкусные и домашние полуфабрикаты от мясо54.рф");
$APPLICATION->SetPageProperty("keywords", "полуфабрикаты");
$APPLICATION->SetPageProperty("title", "Купить полуфабрикаты в Новосибирске");
$APPLICATION->SetTitle("Полуфабрикаты");
?>
<?
$APPLICATION->IncludeComponent(
    "your:catalog",
    "catalog_smf",
    array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "IBLOCK_ID" => "5",
        "IBLOCK_TYPE" => "dynamic_content",
        "ITEMS_LIMIT" => "99",
        "SEF_FOLDER" => "/catalog_smf/",
        "SEF_MODE" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "SEF_URL_TEMPLATES" => array(
            "list" => "",
            "detail" => "#ELEMENT_CODE#/",
        )
    ),
    false
);
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
