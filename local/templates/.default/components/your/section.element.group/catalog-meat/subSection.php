<?
global $arSectionsChild, $arParams;
?>
<?foreach ($arSectionsChild as $arSectionChild) {?>
	<div class="catalog__list">
		<?
		$this->AddEditAction($arSectionChild['ID'], $arSectionChild['EDIT_LINK'], CIBlock::GetArrayByID($arSectionChild["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSectionChild['ID'], $arSectionChild['DELETE_LINK'], CIBlock::GetArrayByID($arSectionChild["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		?>
		<h2 id="<?=$this->GetEditAreaId($arSectionChild['ID']);?>" class="catalog__title"><?=$arSectionChild["NAME"]?></h2>
		<?foreach ($arSectionChild["ITEMS"] as $kSubItems => $vSubItems) {
			$GLOBALS['resItems'] = $vSubItems;
			include(__DIR__.'/'.$arParams['TEMP_OUTPUT_ELEMETS']);
			unset($GLOBALS['resItems']);
		}
		if($arSectionChild["SECTION_CHILD"]) {
			$GLOBALS['arSectionsChild'] = $arSectionChild["SECTION_CHILD"];
			include(__DIR__.'/'.$arParams['TEMP_OUTPUT_SECTIONS']);
		}
		?>
	</div>
<?}?>
