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
<article class="news-page">
	<div class="news-page-img-box">
		<div class="news-page-img-box__item"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>" class="news-page-img-box__img">
			<div class="news-page-img-box__description"><?=$arResult['DETAIL_PICTURE']['DESCRIPTION']?></div>
		</div>
		<?if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])){
			foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']['PREVIEW_PICTURE'] as $key=>$src)
			{
				?>
				<div class="news-page-img-box__item"><img src="<?=$src?>" alt="" class="news-page-img-box__img">
					<div class="news-page-img-box__description"><?=$arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key]?></div>
				</div>
				<?
			}
		}?>
	</div>
	<div class="news-page__inner">
		<h3 class="news-page__title"><span class="news-page__title-text"><?=$arResult['NAME']?></span></h3>
		<div class="news-page-info"><span class="news-page-info__date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span></div>
		<?if(strlen($arResult['DETAIL_TEXT'])>0){?>
			<div class="news-page__description">
				<?=$arResult['DETAIL_TEXT'];?>
			</div>
		<?} else {?>
			<div class="news-page__description">
				<?=$arResult['PREVIEW_TEXT'];?>
			</div>
		<?}?>
	</div>
</article>