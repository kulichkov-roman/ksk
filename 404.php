<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");

?>
<div class="content__tab"><span class="content__tab-text">Ошибка 404</span></div>
<div class="content__description">Oops, такой страницы нет, вы можете выбрать из списка необходимый раздел
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
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
