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
?>

<?$index  = 0;?>
<?foreach($arResult['ITEMS'] as $arItem){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<article <?=$index > 6 ? 'style="display: none"' : '';?> class="news-list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="news-list-item__link">
			<div class="news-list-item__img-h">
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['DESCRIPTION']?>" class="news-list-item__img">
			</div>
			<div class="news-list-item__inner">
				<h3 class="news-list-item__title"><span class="news-list-item__title-text"><?=$arItem['NAME']?></span></h3>
				<div class="news-list-item-info"><span class="news-list-item-info__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span></div>
				<?if($arItem['PREVIEW_TEXT'] <> ''){?>
					<div class="news-list-item__description">
						<?=TruncateText($arItem['PREVIEW_TEXT'], 250)?>
					</div>
				<?}?>
				<div class="news-list-item-read-more">
					<span class="news-list-item-read-more__text">Читать подробнее >></span>
				</div>
			</div>
		</a>
	</article>
	<?$index++;?>
<?}?>
