<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>

<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0){?>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
	<?}?>
	<h4 class="contacts-form__title">Возникли вопросы?</h4>
	<div class="contacts-form__description">Оставьте сообщение, воспользовавшись формой обратной связи, и мы свяжемся с вами в ближайшее время!</div>
	<div class="contacts-form-fields">
		<div class="contacts-form-fields__col">
			<textarea name="PROPERTY[PREVIEW_TEXT][0]" placeholder="Введите текст сообщения" class="contacts-form-fields__message"></textarea>
		</div>
		<div class="contacts-form-fields__col">
			<div class="contacts-form-fields__row">
				<input type="text" name="PROPERTY[NAME][0]" placeholder="Представьтесь пожалуйста" class="contacts-form-fields__input">
			</div>
			<div class="contacts-form-fields__row">
				<input type="text" name="PROPERTY[7][0]" placeholder="Контактных номер" class="contacts-form-fields__input">
			</div>
			<div class="contacts-form-fields__row">
				<button type="submit" class="contacts-form-fields__submit" name="<?=$arParams['PREFIX_FORM']?>_iblock_submit" value="1">Отправить</button>
			</div>
		</div>
	</div>
</form>