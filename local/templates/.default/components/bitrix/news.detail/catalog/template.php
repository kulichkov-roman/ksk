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
<article class="product-page">
	<div class="product-page__gallery">
		<div class="product-page-photo-main"><?if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])){?><span class="product-page-photo-main__zoom"></span><?}?>
			<div class="product-page-photo-main__inner">
				<img
					src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"
					data-index="0"
					class="product-page-photo-main__img"
				>
			</div>
		</div>
		<div class="product-page-photo-thumbs _raw">
			<?
			if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
			{
				$index = 1;
				foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $arPhotoItem)
				{
					?>
					<div class="product-page-photo-thumbs__item">
						<div class="product-page-photo-thumbs__inner">
							<img src="<?=$arPhotoItem['PREVIEW_PICTURE']?>"
							     data-big="<?=$arPhotoItem['DETAIL_PICTURE']?>"
							     data-full="<?=$arPhotoItem['FULL_PICTURE']?>"
							     data-title="<?=$arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key] ? $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key] : 'Фото '.$index;?>"
							     data-index="0"
							     class="product-page-photo-thumbs__img"
							>
						</div>
					</div>
					<?
					$index++;
				}
			}
			?>
		</div>
	</div>
	<div class="product-page__inner">
		<div class="product-page-content">
			<h3 class="product-page-content__title"><span class="product-page-content__title-text"><?=$arResult['NAME']?></span></h3>
			<div class="product-page-content__description">
				<?=$arResult['DETAIL_TEXT'] ? $arResult['DETAIL_TEXT'] : $arResult['PREVIEW_TEXT']?>
			</div>
			<?if(!empty($arResult['PROPERTIES']['COMPOSITION']['VALUE'])){?>
				<h4 class="product-page-content__subtitle"><span class="product-page-content__subtitle-text">Состав:</span></h4>
				<div class="product-page-content-structure">
					<ul class="product-page-content-structure__list">
						<?foreach($arResult['PROPERTIES']['COMPOSITION']['VALUE'] as $key => $value){?>
							<li class="product-page-content-structure__item">
								<span class="product-page-content-structure__item-value"><?=$value?></span>&#32;
								<?if($arResult['PROPERTIES']['COMPOSITION']['DESCRIPTION'][$key]){?>
									<span class="product-page-content-structure__item-notice">(<?=$arResult['PROPERTIES']['COMPOSITION']['DESCRIPTION'][$key]?>)</span>
								<?}?>
							</li>
						<?}?>
					</ul>
				</div>
			<?}?>
		</div>
		<div class="product-page-buy">
			<?if($arResult['PROPERTIES']['PRICE_PICKUP']['VALUE']){?>
				<div class="product-page-buy__price"><?=$arResult['PROPERTIES']['PRICE_PICKUP']['VALUE']?></div>
			<?}?>
			<div class="product-page-buy-count">
				<input type="text" value="1" readonly class="product-page-buy-count__field">
				<div class="product-page-buy-count__controls"><span class="product-page-buy-count__more"></span><span class="product-page-buy-count__less"></span></div>
			</div>
			<div class="product-page-buy__button-h">
				<button type="button" class="product-page-buy__button">Заказать</button>
			</div>
		</div>
	</div>
</article>

