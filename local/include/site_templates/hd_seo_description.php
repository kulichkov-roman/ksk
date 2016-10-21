<?
use Bitrix\Main\Loader;
Loader::includeModule('iblock');

$environment = \Your\Environment\EnvironmentManager::getInstance();

$arSecSeoDescription = array();
$obCache = new CPHPCache();
$curDir = $APPLICATION->GetCurDir();
$cacheLifeTime = 3600;
$cacheID = 'arSubSecSeoDesc'.$curDir;
$cachePath = '/yt/'.$cacheID;

if($obCache->InitCache($cacheLifeTime, $cacheID, $cachePath))
{
    $vars = $obCache->GetVars();
    $arSecSeoDescription = $vars['arSubSecSeoDesc'];
}
elseif($obCache->StartDataCache())
{
    $arDescriptionSort = array();
    $arDescriptionSelect = array(
        'ID',
        'NAME',
        'PROPERTY_CUR_DIR',
        'PREVIEW_TEXT',
    );
    $arDirFilter = array(
        'IBLOCK_ID' => $environment->get('seoSecDescIBlockId'),
        'ACTIVE' => 'Y',
        'PROPERTY_CUR_DIR' => $curDir
    );
    $rsDescription = CIBlockElement::GetList(
        $arDescriptionSort,
        $arDirFilter,
        false,
        false,
        $arDescriptionSelect
    );
    if ($arSecSeoDescription = $rsDescription->Fetch());

    $obCache->EndDataCache(array('arSubSecSeoDesc' => $arSecSeoDescription));
}

if($arSecSeoDescription['PREVIEW_TEXT'] && $arSecSeoDescription['NAME'])
{
    ?>
    <div class="seo-block">
        <div class="seo-block__inner">
            <div class="seo-block__content">
                <h3 class="seo-block__title"><?=$arSecSeoDescription['NAME'];?></h3>
                <div class="seo-block__text"><?=$arSecSeoDescription['PREVIEW_TEXT'];?></div>
            </div>
            <div class="seo-block__toggle"><span class="seo-block__toggle-text _expand">Развернуть</span><span class="seo-block__toggle-text _minimize">Свернуть</span></div>
        </div>
    </div>
    <?
}
?>
