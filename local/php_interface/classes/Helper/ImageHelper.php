<?php

namespace KLRF\Helper;

/**
 * Хелпер для работы с изображениями
 *
 * Class ImagesHelper
 *
 * @package KLRF\Helper
 *
 * @author Kulichkov Roman <roman@kulichkov.pro>
 */
class ResizeTpic
{
    protected static $arParams;

    public function __construct($arParams)
    {
        self::$arParams = $arParams;
    }

    public function resizeImages()
    {
        if(self::$arParams['ID'] > 0)
        {
            if(
                self::$arParams['MODE']  <> ''
            )
            {
                $src = \ft\CTPic::resizeImage(
                    self::$arParams['ID'],
                    self::$arParams['MODE'],
                    self::$arParams['WIDTH']
                );

                return $src;
            }
            else
            {
                throw new \Exception('Не установлен режим работы tpic');
            }
        }
        else
        {
            throw new \Exception('Не указан ID изображения');
        }
    }
}

class ResizeFactory
{
    /**
     * @param $resizerType
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    public static function build($resizeType, $arParams)
    {
        $resize = '\KLRF\Helper\Resize' . ucfirst($resizeType);

        if (class_exists($resize))
        {
            return new $resize($arParams);
        }
        else
        {
            throw new \Exception('Неверный тип ресайзера');
        }
    }
}

class ImageHelper
{
    /**
     * @param $resizeType
     * @param $arParams
     *
     * @return mixed
     * @throws \Exception
     */
    public static function getResizeImages($resizeType, $arParams)
    {
        $objResize = ResizeFactory::build($resizeType, $arParams);

        return $objResize->resizeImages();
    }
}
?>
