<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?>
<?
$APPLICATION->IncludeComponent('bitrix:main.include', '',
    Array(
        'AREA_FILE_SHOW' => 'file',
        'PATH' => '/local/include/page_templates/pg_news_main.php',
        'EDIT_TEMPLATE' => ''
    ),
    false,
    Array('HIDE_ICONS' => 'Y')
);
$APPLICATION->IncludeComponent('bitrix:main.include', '',
    Array(
        'AREA_FILE_SHOW' => 'file',
        'PATH' => '/local/include/site_templates/hd_rewards_main.php',
        'EDIT_TEMPLATE' => ''
    ),
    false,
    Array('HIDE_ICONS' => 'Y')
);
?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>