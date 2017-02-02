<?
use KSK\Helper;

$CLastModifierHelper = KSK\Helper\LastModifierHelper::getInstance();

/*
 * Передать TIMESTAMP_X в кеш для установки в LastModifier
 * */
$CLastModifierHelper->setLastModifier(MakeTimeStamp($arResult['TIMESTAMP_X']));
?>
