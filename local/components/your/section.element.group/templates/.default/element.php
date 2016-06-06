<?
global $arParams, $resItems;
$arResult = $GLOBALS['resItems'];
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<p class="news-item" id="<?=$this->GetEditAreaId($arResult['ID']);?>">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["PREVIEW_PICTURE"])):?>
		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arResult["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<a href="<?=$arResult["DETAIL_PAGE_URL"]?>"><img
					class="preview_picture"
					border="0"
					src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/></a>
		<?else:?>
			<img
				class="preview_picture"
				border="0"
				src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
				width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
				height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
				alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
				title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
				style="float:left"
				/>
		<?endif;?>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?echo $arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arResult["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
			<a href="<?echo $arResult["DETAIL_PAGE_URL"]?>"><b><?echo $arResult["NAME"]?></b></a><br />
		<?else:?>
			<b><?echo $arResult["NAME"]?></b><br />
		<?endif;?>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["PREVIEW_TEXT"]):?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif;?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["PREVIEW_PICTURE"])):?>
		<div style="clear:both"></div>
	<?endif?>
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
		<small>
		<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
		</small><br />
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<small>
		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		</small><br />
	<?endforeach;?>
</p>