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
    $arResult['DETAIL_PICTURE']['SRC'] = itc\Resizer::get($environment->get('newsPlugId'), 'w1024_h768_w');
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

    if($arItem = $rsFile->Fetch())
    {
        $arDetailPicture[$arItem['ID']] = $arItem;
        $urlDetailPicture = itc\Resizer::get($arItem['ID'], 'w1024_h768_w');

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
            'PREVIEW_PICTURE' => itc\Resizer::get($pictId, 'w111_h115_cr'),
            'DETAIL_PICTURE'  => itc\Resizer::get($pictId, 'w504_h537_cr'),
            'FULL_PICTURE'  => itc\Resizer::get($pictId, 'w1024_h768_w')
        );
    }

    if(!empty($arPicture))
    {
        $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] = $arPicture;
    }
}
?>
