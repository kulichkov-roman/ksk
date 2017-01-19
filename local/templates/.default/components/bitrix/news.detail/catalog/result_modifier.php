<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?
$environment = \Your\Environment\EnvironmentManager::getInstance();

/**
 * Если есть множественная картинка
 */
$arPictIds = array();
if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
{
    $arPictIds = $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'];

    $arPicture = array();
    foreach($arPictIds as $pictId)
    {
        $arPicture[]  = array(
            'PREVIEW_PICTURE'   => itc\Resizer::get($pictId, 'w111h115cr'),
            'DETAIL_PICTURE'    => itc\Resizer::get($pictId, 'w504h537a'),
            'FULL_PICTURE'      => itc\Resizer::get($pictId, 'w1024h768wd')
        );
    }

    if(!empty($arPicture))
    {
        $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] = $arPicture;
        $arResult['DETAIL_PICTURE']['SRC'] = $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'][0]['DETAIL_PICTURE'];
    }
    else
    {
        $arResult['DETAIL_PICTURE']['SRC']  = itc\Resizer::get($environment->get('w504h537aPlugId'), 'w504h537a');
    }
}
else
{
    /**
     * Одиночная картинка
     */
    $id = '';
    if(is_array($arResult['DETAIL_PICTURE']))
    {
        $id = $arResult['DETAIL_PICTURE']['ID'];

        if($id)
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
                $urlDetailPicture = itc\Resizer::get($arItem['ID'], 'w504h537a');

                $arResult['DETAIL_PICTURE']['SRC'] = $urlDetailPicture;
            }
        }
    }
    else
    {
        $arResult['DETAIL_PICTURE']['SRC']  = itc\Resizer::get($environment->get('w504h537aPlugId'), 'w504h537cr');
    }
}
?>
