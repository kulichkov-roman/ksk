<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $USER;

$environment = \Your\Environment\EnvironmentManager::getInstance();

$APPLICATION->IncludeComponent("bitrix:main.include", "",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/local/include/page_templates/pg_catalog_detail_smf.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	Array('HIDE_ICONS' => 'Y')
);
?>
<div class="product-page__footer">
	<?
	$arVariables = array();
	CComponentEngine::ParseComponentPath(
		$environment->get('catalogSmfPageUrl'),
		array('#ELEMENT_CODE#/'),
		$arVariables
	);

	$arSecIds = array();
	$arSeoText = array();
	$obCache = new \CPHPCache();
	$arSeeMoreCatalogMeatList = array();
	$cacheLifeTime = 2628000;
	$cacheID = 'arSeeMoreCatalogMeatList'.$arVariables['ELEMENT_CODE'];
	$cachePath = '/yt/'.$cacheID;
	if($obCache->InitCache($cacheLifeTime, $cacheID, $cachePath))
	{
		$vars = $obCache->GetVars();
		$arSeeMoreCatalogMeatList = $vars['arSeeMoreCatalogMeatList'];
	}
	elseif($obCache->StartDataCache())
	{
		$arCatalogMeatSort = array();
		$arCatalogMeatSelect = array(
			'ID',
			'NAME',
			'PROPERTY_SEE_ALSO_LINK',
			'PROPERTY_SEO_TEXT',
			'PROPERTY_SEO_TITLE'
		);
		$arCatalogMeatFilter = array(
			'IBLOCK_ID' => $environment->get('catalogSmfIBlockId'),
			'ACTIVE'    => 'Y',
			'CODE'      => $arVariables['ELEMENT_CODE']
		);
		$rsCatalogMeatElements = \CIBlockElement::GetList(
			$arCatalogMeatSort,
			$arCatalogMeatFilter,
			false,
			false,
			$arCatalogMeatSelect
		);
		if($arCatalogMeatItem = $rsCatalogMeatElements->Fetch())
		{
			if(!empty($arCatalogMeatItem['PROPERTY_SEE_ALSO_LINK_VALUE']))
			{
				$arSeeMoreSort = array();
				$arSeeMoreSelect = array(
					'ID',
					'NAME',
					'DETAIL_PAGE_URL'
				);
				$arSeeMoreFilter = array(
					'IBLOCK_ID' => $environment->get('catalogMeatIBlockId'),
					'ACTIVE'    => 'Y',
					'ID'        => $arCatalogMeatItem['PROPERTY_SEE_ALSO_LINK_VALUE']
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
					$arSeeMoreItem['DETAIL_PAGE_URL'] = '#SITE_DIR#/catalog_meat/#ELEMENT_CODE#/';
					$pattern = array('#SITE_DIR#', '#ELEMENT_CODE#');
					$replace = array('', $arSeeMoreItem['CODE']);
					$arSeeMoreItem['DETAIL_PAGE_URL'] = str_replace($pattern, $replace, $arSeeMoreItem['DETAIL_PAGE_URL']);
					$arSeeMoreCatalogMeatList[$arSeeMoreItem['ID']] = $arSeeMoreItem;
				}
			}
            $arSeoText['TEXT'] = $arCatalogMeatItem['PROPERTY_SEO_TEXT_VALUE']['TEXT'];
            $arSeoText['TITLE'] = $arCatalogMeatItem['PROPERTY_SEO_TITLE_VALUE'];
		}
		$obCache->EndDataCache(array('arSeeMoreCatalogMeatList' => $arSeeMoreCatalogMeatList));
	}

	if(!empty($arSeeMoreCatalogMeatList))
	{
		$obCache = new \CPageCache;
		$cacheId = 'link'.$arVariables['ELEMENT_CODE'].$arParams['IBLOCK_TYPE'].$USER->GetUserGroupString();
		$cacheLifeTime = 2628000;
		if($obCache->StartDataCache($cacheLifeTime, $cacheId, '/'))
		{
			?>
			<ul class="cross-links">
				<?foreach($arSeeMoreCatalogMeatList as $arSeeMoreItem){?>
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
<?
if(!empty($arSeoText['TEXT']))
{
	$obCache = new \CPageCache;
	$cacheId = 'seo_text'.$arVariables['ELEMENT_CODE'].$arParams['IBLOCK_ID'].$USER->GetUserGroupString();
	$cacheLifeTime = 2628000;
	if($obCache->StartDataCache($cacheLifeTime, $cacheId, '/'))
	{
		?>
		<div class="seo-block">
			<div class="seo-block__inner">
				<div class="seo-block__content">
                    <h3 class="seo-block__title"><?=$arSeoText['TITLE']?></h3>
                    <div class="seo-block__text"><?=$arSeoText['TEXT']?></div>
				</div>
                <div class="seo-block__toggle"><span class="seo-block__toggle-text _expand">Развернуть</span><span class="seo-block__toggle-text _minimize">Свернуть</span></div>
            </div>
		</div>
		<?
		$obCache->EndDataCache();
	}
}
?>
