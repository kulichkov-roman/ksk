<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$arDefaultUrlTemplates404 = array(
	'list' => '',
	'detail' => '#ELEMENT_CODE#/',
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	'ELEMENT_CODE',
);

$arUrlTemplates = array();
if ($arParams['SEF_MODE'] == 'Y')
{
	$arVariables = array();

	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams['SEF_URL_TEMPLATES']);
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams['VARIABLE_ALIASES']);

	$componentPage = CComponentEngine::ParseComponentPath($arParams['SEF_FOLDER'], $arUrlTemplates, $arVariables);

	$b404 = false;
	if(!$componentPage)
	{
		$componentPage = 'list';
		$b404 = true;
	}

	if($b404 && Loader::includeModule('iblock'))
	{
		$folder404 = str_replace('\\', '/', $arParams['SEF_FOLDER']);
		if ($folder404 != '/')
			$folder404 = '/'.trim($folder404, '/ \t\n\r\0\x0B').'/';
		if (substr($folder404, -1) == '/')
			$folder404 .= 'index.php';

		if ($folder404 != $APPLICATION->GetCurPage(true))
		{
			\Bitrix\Iblock\Component\Tools::process404(
				''
				,($arParams['SET_STATUS_404'] === 'Y')
				,($arParams['SET_STATUS_404'] === 'Y')
				,($arParams['SHOW_404'] === 'Y')
				,$arParams['FILE_404']
			);
		}
	}

	if (StrLen($componentPage) > 0)
	{
		CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

		$arResult = array(
			'FOLDER' => $arParams['SEF_FOLDER'],
			'URL_TEMPLATES' => $arUrlTemplates,
			'VARIABLES' => $arVariables,
			'ALIASES' => $arVariableAliases
		);

		$this->IncludeComponentTemplate($componentPage);
	}
}
else
{
	ShowError(Loc::getMessage('ERROR_USE_SEF_MODE'));
	return false;
}
?>
