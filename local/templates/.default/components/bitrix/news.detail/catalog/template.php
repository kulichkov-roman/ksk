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
		<div class="product-page-photo-main"><span class="product-page-photo-main__zoom"></span>
			<div class="product-page-photo-main__inner"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" data-index="0" class="product-page-photo-main__img"></div>
		</div>
		<div class="product-page-photo-thumbs _raw">
			<?
			if(is_array($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
			{
				$index = 1;
				foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $arPhotoItem)
				{
					?>
					<div class="product-page-photo-thumbs__item">
						<div class="product-page-photo-thumbs__inner">
							<img src="<?=$arPhotoItem['PREVIEW_PICTURE']?>"
							     data-big="<?=$arPhotoItem['DETAIL_PICTURE']?>"
							     data-full="<?=$arPhotoItem['FULL_PICTURE']?>"
							     data-title="Фото <?=$index?>"
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
				<?=$arResult['DETAIL_TEXT']?>
			</div>
			<?if(is_array($arResult['PROPERTIES']['COMPOSITION']['VALUE']) && sizeof($arResult['PROPERTIES']['COMPOSITION']['VALUE'])){?>
				<h4 class="product-page-content__subtitle"><span class="product-page-content__subtitle-text">Состав:</span></h4>
				<div class="product-page-content-structure">
					<ul class="product-page-content-structure__list">
						<?foreach($arResult['PROPERTIES']['COMPOSITION']['VALUE'] as $key => $value){?>
							<li class="product-page-content-structure__item">
								<span class="product-page-content-structure__item-value"><?=$value?></span>&#32;
								<?if($arResult['PROPERTIES']['COMPOSITION']['DESCRIPTION'][$key]){?>
									<span class="product-page-content-structure__item-notice">(<?=$arItem['PROPERTIES']['COMPOSITION']['DESCRIPTION'][$key]?>)</span>
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
<template id="sendForm-tpl">
	<div class="b-send-form">
		<form @submit="onFormSubmit">
			<input type="hidden" name="OFFERID" value="2313213">
			<input type="hidden" name="QUANTITY" :value="offerQuantity">
			<!-- Рома, здесь ты можешь подставить любые удобные имена полей для отправки-->
			<input v-for="field in form" type="hidden" :name="getFieldName(field.name, {
                                            name: 'MY_NAME',
                                            phone: 'MY_PHONE',
                                            email: 'MY_EMAIL'
                                        })" :value="field.value">
			<field v-for="field in form" :field="field" :validate-field="validateField"></field>
			<div v-for="field in form" v-if="field.error && field.message && field.message[field.error]" v-html="field.message[field.error]" class="b-send-form__field-error"></div>
			<div v-if="isFormSuccess" class="b-send-form__note">Всё, поля заполнены верно, нажмите «Отправить»</div>
			<button class="b-send-form__submit">Отправить</button>
		</form>
	</div>
</template>
<template id="sendFormField-tpl">
	<div class="b-send-form__row">
		<input type="input" :class="{_error: field.error, _success: field.success}" :placeholder="field.placeholder" autocomplete="off" ref="input" class="b-send-form__input">
	</div>
</template>
<div class="product-page__footer">
	<ul class="cross-links">
		<li class="cross-links__item"><a href="#" class="cross-links__link">Где купить мясо в Новосибирске?</a></li>
		<li class="cross-links__item"><a href="#" class="cross-links__link">Вкусные манты: где купить в вашем городе?</a></li>
	</ul>
</div>
