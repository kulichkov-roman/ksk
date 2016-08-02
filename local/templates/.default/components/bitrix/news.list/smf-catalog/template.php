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

<?$class = sizeof($arResult) % 2 == 0 ? '_odd' : '';?>
<div class="products <?=$class?>">
	<article class="products-item _part-3"><span class="products-item__corner"></span><a href="#" class="products-item__link">
			<div class="products-item__img-h"><img src="images/pelmeni.jpg" alt="" class="products-item__img"></div>
			<div class="products-item__inner">
				<h3 class="products-item__title"><span class="products-item__title-text">Пельмени ручной лепки</span></h3>
				<div class="products-item-info">
					<div class="products-item-info__item"><span class="products-item-info__item-text">Самовывоз -&#32;<span class="products-item-info__item-value">520</span>&#32;р/кг,</span></div>
					<div class="products-item-info__item"><span class="products-item-info__item-text">Доставка -&#32;<span class="products-item-info__item-value">550</span>&#32;р/кг</span><span class="products-item-info__item-notice">&#32;(при заказе от 120кг)</span></div>
				</div>
				<div class="products-item__description">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</div>
				<div class="products-item-composition"><strong class="products-item-composition__title">Состав</strong>
					<ul class="products-item-composition__list">
						<li class="products-item-composition__item"><span class="products-item-composition__item-value">- Тесто дрожжевое</span><span class="products-item-composition__item-notice">(мука пшеничная 1с., яцйо куриное, соль, масло сливочное)</span></li>
						<li class="products-item-composition__item"><span class="products-item-composition__item-value">- Фарш свинной</span><span class="products-item-composition__item-notice">(60% мясо, 10% жилы, 30% жир)</span></li>
						<li class="products-item-composition__item"><span class="products-item-composition__item-value">- Лук репчатый</span><span class="products-item-composition__item-notice">(классический белый)</span></li>
					</ul>
				</div>
			</div></a>
	</article>
</div>

<section class="feed">
	<?$index  = 0;?>
	<?foreach($arResult["ITEMS"] as $arItem){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<article class="feed__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<figure class="feed__img-h">
				<a href="<?=$arItem['DETAIL_PICTURE']['SRC']?>"
				   data-header="<?=$arItem['NAME']?>" title="<?=$arItem['DETAIL_PICTURE']['DESCRIPTION']?>"
				   rel="fancybox-feed" class="feed__img-link _fancybox">
					<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['DESCRIPTION']?>" class="feed__img">
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
