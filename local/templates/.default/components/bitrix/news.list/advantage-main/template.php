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
<section class="content">
	<div class="content__inner">
		<div class="content__substrate"></div>
		<div class="content__content">
			<div class="content__tab"><span class="content__tab-text">О нас</span></div>
			<h1 class="content__title">Корниловский свинокомплекс</h1>
			<section class="feed">
				<?$index  = 0;?>
				<?foreach($arResult["ITEMS"] as $arItem){
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<article class="feed__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<figure class="feed__img-h">
							<a href="/local/templates/images/pic.jpg"
							   data-header="<?=$arItem['NAME']?>" title="lala"
							   rel="fancybox-feed" class="feed__img-link _fancybox">
								<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="" class="feed__img">
							</a>
						</figure>
						<div class="feed__content _bg-<?=$index?>">
							<h2 class="feed__title"><?=$arItem['NAME']?></h2>
							<?if($arItem['PREVIEW_TEXT'] <> ''){?>
								<div class="feed__text">
									<?=$arItem['PREVIEW_TEXT']?>
								</div>
							<?}?>
						</div>
					</article>
					<?$index++;?>
				<?}?>
				<button type="button" class="feed__photos-btn">Смотреть все фотографии</button>
			</section>
		</div>
	</div>
</section>
