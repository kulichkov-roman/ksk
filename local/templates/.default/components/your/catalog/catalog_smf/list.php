<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->IncludeComponent("bitrix:main.include", "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/local/include/page_templates/pg_catalog_smf.php",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    Array('HIDE_ICONS' => 'Y')
);
?>
