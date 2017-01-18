<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Каталог: мясо и полуфабрикаты');
?>
<?
if($USER->isAdmin())
{
    $APPLICATION->IncludeComponent(
        "your:catalog",
        "catalog_meat",
        array(
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "IBLOCK_ID" => "5",
            "IBLOCK_TYPE" => "dynamic_content",
            "ITEMS_LIMIT" => "99",
            "SEF_FOLDER" => "/catalog_meat/",
            "SEF_MODE" => "Y",
            "COMPONENT_TEMPLATE" => ".default",
            "SEF_URL_TEMPLATES" => array(
                "list" => "",
                "detail" => "#ELEMENT_CODE#/",
            )
        ),
        false
    );
}
else
{
    $APPLICATION->IncludeComponent("bitrix:main.include", "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/local/include/page_templates/pg_catalog_meat.php",
            "EDIT_TEMPLATE" => ""
        ),
        false,
        Array('HIDE_ICONS' => 'Y')
    );
}
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
