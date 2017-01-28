<?php

/**
 * Class SendingEmailHandler
 */
class SendingEmailHandler
{
    public static function SendFeedbackForm(&$arFields)
    {
        $environment = \Your\Environment\EnvironmentManager::getInstance();

        if($arFields["IBLOCK_ID"] == $environment->get('feedbackIBlockId'))
        {
            $arEventFields = array(
                'NAME' => $arFields['NAME'],
                'PHONE' => $arFields['PROPERTY_VALUES'][$environment->get('feedbackPropPhoneId')] <> '' ? $arFields['PROPERTY_VALUES'][$environment->get('feedbackPropPhoneId')] : '-',
                'PREVIEW_TEXT'  => $arFields['PREVIEW_TEXT']
            );
            \CEvent::Send('FEEDBACK_FORM', SITE_ID, $arEventFields);
        }
    }

    public static function SendOrderForm(&$arFields)
    {
        $environment = \Your\Environment\EnvironmentManager::getInstance();

        if($arFields["IBLOCK_ID"] == $environment->get('ordersIBlockId'))
        {
            $arEventFields = array(
                'NAME' => $arFields['NAME'],
                'PHONE' => $arFields['PROPERTY_VALUES'][$environment->get('ordersPhonePropId')] <> '' ? $arFields['PROPERTY_VALUES'][$environment->get('ordersPhonePropId')] : '-',
                'EMAIL' => $arFields['PROPERTY_VALUES'][$environment->get('ordersEmailPropId')] <> '' ? $arFields['PROPERTY_VALUES'][$environment->get('ordersEmailPropId')] : '-',
                'PRODUCT' => $arFields['PROPERTY_VALUES'][$environment->get('ordersProdPropId')] <> '' ? $arFields['PROPERTY_VALUES'][$environment->get('ordersProdPropId')] : '-',
                'QUANTITY' => $arFields['PROPERTY_VALUES'][$environment->get('ordersQuantityPropId')] <> '' ? $arFields['PROPERTY_VALUES'][$environment->get('ordersQuantityPropId')] : '-',
            );
            \CEvent::Send('ADD_NEW_ORDER', SITE_ID, $arEventFields, 'Y');
        }
    }
}
?>