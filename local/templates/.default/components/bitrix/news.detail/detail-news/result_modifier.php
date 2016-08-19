<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?
$environment = \Your\Environment\EnvironmentManager::getInstance();

$id = '';
if(is_array($arResult['DETAIL_PICTURE']))
{
    $id = $arResult['DETAIL_PICTURE']['ID'];
}
else
{
    $arResult['DETAIL_PICTURE']['SRC'] = itc\Resizer::get($environment->get('newsPlugId'), 'newsPicture');
}

if($id <> '')
{
    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        'MODULE_ID' => 'iblock',
        '@ID' => $id
    );

    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);

    if($arItem = $rsFile->GetNext())
    {
        $arDetailPicture[$arItem['ID']] = $arItem;
        $urlDetailPicture = itc\Resizer::get($arItem['ID'], 'newsPicture');

        $arResult['DETAIL_PICTURE']['SRC'] = $urlDetailPicture;
    }
}

$arPictIds = array();
if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
{
    $arPictIds = $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'];

    $arPicture = array();
    foreach($arPictIds as $pictId)
    {
        $arPicture[]  = array(
            'PREVIEW_PICTURE' => itc\Resizer::get($pictId, 'newsPicture'),
            'DETAIL_PICTURE'  => itc\Resizer::get($pictId, 'newsPicture')
        );
    }

    if(!empty($arPicture))
    {
        $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] = $arPicture;
    }
}
?>
