<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Контакты');
?>
<?
$APPLICATION->IncludeComponent("bitrix:main.include", "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/local/include/page_templates/pg_contacts.php",
        "EDIT_TEMPLATE" => ""
    ),
    false,
    Array('HIDE_ICONS' => 'Y')
);
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
