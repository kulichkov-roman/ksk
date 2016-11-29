<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$environment = \Your\Environment\EnvironmentManager::getInstance();
?>
<div class="content__content">
	<div class="content__tab">
		<?
		$APPLICATION->IncludeComponent("bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/local/include/page_templates/pg_news_title.php",
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
				"PATH" => "/local/include/page_templates/pg_news_text.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);
		?>
	</div>
	<div class="news-list">
		<div class="news-list__list">
			<?$ElementID = $APPLICATION->IncludeComponent(
				"bitrix:news.detail",
				"detail-news",
				Array(
					"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
					"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
					"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
					"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
					"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"META_KEYWORDS" => $arParams["META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
					"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
					"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
					"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"MESSAGE_404" => $arParams["MESSAGE_404"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"SHOW_404" => $arParams["SHOW_404"],
					"FILE_404" => $arParams["FILE_404"],
					"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
					"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
					"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
					"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
					"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
					"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
					"CHECK_DATES" => $arParams["CHECK_DATES"],
					"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
					"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
					"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
					"USE_SHARE" => $arParams["USE_SHARE"],
					"SHARE_HIDE" => $arParams["SHARE_HIDE"],
					"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
					"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
					"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : '')
				),
				$component
			);?>
		</div>
		<div class="news-list__footer">
			<?
			$arSecIds = array();
			$obCache = new \CPHPCache();
			$arSeeMoreList = array();
			$cacheLifeTime = 3600;
			$cacheID = 'arSeeMoreList'.$ElementID;
			$cachePath = '/yt/'.$cacheID;
			if($obCache->InitCache($cacheLifeTime, $cacheID, $cachePath))
			{
				$vars = $obCache->GetVars();
				$arSeeMoreList = $vars['arSeeMoreList'];
			}
			elseif($obCache->StartDataCache())
			{
				$arNewsDetailSort = array();
				$arNewsDetailSelect = array(
					'ID',
					'NAME',
					'PROPERTY_SEE_ALSO_LINK'
				);
				$arNewsDetailFilter = array(
					'IBLOCK_ID' => $environment->get('newsIBlockId'),
					'ACTIVE'    => 'Y',
					'ID'        => $ElementID
				);
				$rsNewsDetailElements = \CIBlockElement::GetList(
					$arNewsDetailSort,
					$arNewsDetailFilter,
					false,
					false,
					$arNewsDetailSelect
				);
				if($arNewsDetailItem = $rsNewsDetailElements->Fetch())
				{
					if(!empty($arNewsDetailItem['PROPERTY_SEE_ALSO_LINK_VALUE']))
					{
						$arSeeMoreSort = array();
						$arSeeMoreSelect = array(
							'ID',
							'NAME',
							'DETAIL_PAGE_URL'
						);
						$arSeeMoreFilter = array(
							'IBLOCK_ID' => $environment->get('newsIBlockId'),
							'ACTIVE'    => 'Y',
							'ID'        => $arNewsDetailItem['PROPERTY_SEE_ALSO_LINK_VALUE']
						);
						$rsSeeMoreElements = \CIBlockElement::GetList(
							$arSeeMoreSort,
							$arSeeMoreFilter,
							false,
							false,
							$arSeeMoreSelect
						);
						while($arSeeMoreItem = $rsSeeMoreElements->Fetch())
						{
							$arSeeMoreItem['DETAIL_PAGE_URL'] = '#SITE_DIR#/news/#ELEMENT_CODE#/';
							$pattern = array('#SITE_DIR#', '#ELEMENT_CODE#');
							$replace = array('', $arSeeMoreItem['CODE']);
							$arSeeMoreItem['DETAIL_PAGE_URL'] = str_replace($pattern, $replace, $arSeeMoreItem['DETAIL_PAGE_URL']);
							$arSeeMoreList[$arSeeMoreItem['ID']] = $arSeeMoreItem;
						}
					}
				}
				$obCache->EndDataCache(array('arSeeMoreList' => $arSeeMoreList));
			}
			if(!empty($arSeeMoreList))
			{
				$obCache = new \CPageCache;
				$cacheId = $ElementID.$arParams['IBLOCK_TYPE'].$USER->GetUserGroupString();
				$cacheLifeTime = 3600;
				if($obCache->StartDataCache($cacheLifeTime, $cacheId, "/"))
				{
					?>
					<ul class="cross-links">
						<?foreach($arSeeMoreList as $arSeeMoreItem){?>
							<li class="cross-links__item">
								<a href="<?=$arSeeMoreItem['DETAIL_PAGE_URL']?>" class="cross-links__link">
									<?=$arSeeMoreItem['NAME']?>
								</a>
							</li>
						<?}?>
					</ul>
					<?
					$obCache->EndDataCache();
				}
			}
			?>
		</div>
	</div>
</div>
