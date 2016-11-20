<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?>
<div class="content__tab"><span class="content__tab-text">Карта сайта</span></div>
<div class="content__description">
    <div class="site-map">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.map",
            "map", Array(
                "LEVEL"	=>	"1",
                "COL_NUM"	=>	"1",
                "SHOW_DESCRIPTION"	=>	"N",
                "SET_TITLE"	=>	"N",
                "CACHE_TIME"	=>	"36000000"
            )
        );
        ?>
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>
