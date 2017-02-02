<?php

/**
 * Class LastModifierHandler
 */
class LastModifierHandler
{
    public function CheckIfModifiedSince()
    {
        $CLastModifierHelper = KSK\Helper\LastModifierHelper::getInstance();

        if ($strLastModifier = $CLastModifierHelper->getLastModifier())
        {
            header('Last-Modified: '.gmdate('D, d M Y H:i:s', $strLastModifier).' GMT');
            $arr = apache_request_headers();
            foreach ($arr as $header => $value)
            {
                if ($header == 'If-Modified-Since')
                {
                    $ifModifiedSince = strtotime($value);
                    if ($ifModifiedSince > $strLastModifier)
                    {
                        $GLOBALS['APPLICATION']->RestartBuffer();
                        CHTTP::SetStatus('304 Not Modified');
                    }
                }
            }
        }
    }
}
