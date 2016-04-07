<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$environment = \Quetzal\Environment\EnvironmentManager::getInstance();

$arIds = array();
foreach($arResult['ITEMS'] as &$arItem)
{
    if(is_array($arItem['PREVIEW_PICTURE']))
    {
        $arIds[] = $arItem['PREVIEW_PICTURE']['ID'];
    }
}
unset($arItem);

if(sizeof($arIds) > 0)
{
    $strIds = implode(',', $arIds);

    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        'MODULE_ID' => 'iblock',
        '@ID' => $strIds
    );

    $arPreviewPicture = array();
    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);
    while($arItem = $rsFile->GetNext())
    {
        $arPreviewPicture[$arItem['ID']] = $arItem;
        $urlPreviewPicture = itc\Resizer::get($arItem['ID'], 'rewardsMainPreview');
        $urlDetailPicture = itc\Resizer::get($arItem['ID'], 'rewardsMainDetail');

        $arPreviewPicture[$arItem['ID']]['SRC'] = $urlPreviewPicture;
        $arDetailPicture[$arItem['ID']]['SRC'] = $urlDetailPicture;
    }

    foreach($arResult['ITEMS'] as &$arItem)
    {
        if(!$arItem['PREVIEW_PICTURE']['SRC'] == '')
        {
            $arItem['PREVIEW_PICTURE']['SRC'] = $arPreviewPicture[$arItem['PREVIEW_PICTURE']['ID']]['SRC'];
            $arItem['DETAIL_PICTURE']['SRC'] = $arDetailPicture[$arItem['PREVIEW_PICTURE']['ID']]['SRC'];
        }
        else
        {
            $arItem['PREVIEW_PICTURE']['SRC'] = itc\Resizer::get($environment->get('rewardsMainPlugId'), 'rewardsMainPreview');
            $arItem['DETAIL_PICTURE']['SRC'] = itc\Resizer::get($environment->get('rewardsMainPlugId'), 'rewardsMainDetail');
        }
    }
    unset($arItem);
}
else
{
    foreach($arResult['ITEMS'] as &$arItem)
    {
        $arItem['PREVIEW_PICTURE']['SRC'] = itc\Resizer::get($environment->get('rewardsMainPlugId'), 'rewardsMainPreview');
        $arItem['DETAIL_PICTURE']['SRC'] = itc\Resizer::get($environment->get('rewardsMainPlugId'), 'rewardsMainDetail');
    }
    unset($arItem);
}
?>
