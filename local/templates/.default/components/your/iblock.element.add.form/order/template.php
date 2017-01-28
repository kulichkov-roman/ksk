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

$environment = \Your\Environment\EnvironmentManager::getInstance();

$isShowError = false;
$isShowMessage = false;
?>

<template id="sendForm-tpl">
	<div class="b-send-form">
		<?
        if (!empty($arResult["ERRORS"])) {
			ShowError(implode("<br />", $arResult["ERRORS"]));
		    $isShowError = true;
        }
		if (strlen($arResult["MESSAGE"]) > 0) {
			ShowNote($arResult["MESSAGE"]);
            $isShowMessage = true;
		}
        if($isShowError || $isShowMessage)
        {
            $this->SetViewTarget('showOrderForm');
            ?>
            <script>
                $(window).load(function() {
                        $('.product-page-buy__button').trigger('click');
                    }
                );
            </script>
            <?
            $this->EndViewTarget();

        }
        if(!$isShowMessage)
        {
            ?>
            <form @submit="onFormSubmit" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                <?=bitrix_sessid_post()?>
                <?if ($arParams["MAX_FILE_SIZE"] > 0){?>
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
                <?}?>
                <input type="hidden" name="PROPERTY[<?=$environment->get('ordersProdPropId')?>][0]" value="<?=$arParams['PRODUCT']?>">
                <input type="hidden" name="PROPERTY[<?=$environment->get('ordersQuantityPropId')?>][0]" :value="offerQuantity">
                <input v-for="field in form" type="hidden" :name="getFieldName(field.name, {
                                            name: 'PROPERTY[NAME][0]',
                                            phone: 'PROPERTY[<?=$environment->get('ordersPhonePropId')?>][0]',
                                            email: 'PROPERTY[<?=$environment->get('ordersEmailPropId')?>][0]'
                                        })" :value="field.value">
                <field v-for="field in form" :field="field" :validate-field="validateField"></field>
                <div v-for="field in form" v-if="field.error && field.message && field.message[field.error]" v-html="field.message[field.error]" class="b-send-form__field-error"></div>
                <div v-if="isFormSuccess" class="b-send-form__note">Всё, поля заполнены верно, нажмите «Отправить»</div>
                <button class="b-send-form__submit">Отправить</button>
            </form>
            <?
        }
        ?>
	</div>
</template>
<template id="sendFormField-tpl">
	<div class="b-send-form__row">
		<input name="<?=$arParams['PREFIX_FORM']?>_iblock_submit" type="input" :class="{_error: field.error, _success: field.success}" :placeholder="field.placeholder" autocomplete="off" ref="input" class="b-send-form__input">
	</div>
</template>

