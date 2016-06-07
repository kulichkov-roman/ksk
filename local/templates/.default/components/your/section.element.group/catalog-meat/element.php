<?
global $arParams, $resItems;
$arResult = $GLOBALS['resItems'];

echo "<pre>"; var_dump($GLOBALS['resItems']); echo "</pre>";

$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<article class="catalog-item " id="<?=$this->GetEditAreaId($arResult['ID']);?>">
	<span class="catalog-item__corner"></span>
	<a href="javascript:void(0)" class="catalog-item__link">
		<div class="catalog-item__img-h">
			<img
				src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
				alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
				title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
				class="catalog-item__img"
			/>
		</div>
		<div class="catalog-item__inner">
			<h3 class="catalog-item__title">
				<span class="catalog-item__title-text"><?=$arResult["NAME"]?></span>
			</h3>
			<div class="catalog-item-info">
				<?if($arResult['PROPERTIES']['PRICE_PICKUP']['VALUE']){?>
					<div class="catalog-item-info__item">
						<span class="catalog-item-info__item-text">Самовывоз -&#32;
							<span class="catalog-item-info__item-value"><?=$arResult['PROPERTIES']['PRICE_PICKUP']['VALUE']?></span>&#32;р/кг,
						</span>
					</div>
				<?}?>
				<?if($arResult['PROPERTIES']['PRICE_DELIVERY']['VALUE']){?>
					<div class="catalog-item-info__item">
						<span class="catalog-item-info__item-text">Доставка -&#32;
							<span class="catalog-item-info__item-value"><?=$arResult['PROPERTIES']['PRICE_DELIVERY']['VALUE']?></span>&#32;р/кг,
							<span class="catalog-item-info__item-notice">&#32;(при заказе от 120кг)</span>
						</span>
					</div>
				<?}?>
			</div>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["PREVIEW_TEXT"]){?>
				<div class="catalog-item__description">
					<?=$arResult["PREVIEW_TEXT"];?>
				</div>
			<?}?>
		</div>
	</a>
</article>
