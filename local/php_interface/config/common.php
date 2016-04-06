<?php
/**
 * Общая конфигурация для всех сайтов и окружений
 */
\Quetzal\Environment\EnvironmentManager::getInstance()->addConfig(
	new \Quetzal\Environment\Configuration\CommonConfiguration(
		array(
			'sliderMainIBlockId' => 1,
		)
	)
);

/**
 * Перерезатор
 */
\Bitrix\Main\Loader::includeModule("itconstruct.resizer");

/**
 * Патерны для перерезатора
 */
itc\Resizer::addPreset('sliderMain', array(
		'mode' => 'crop',
		'width' => '1920',
		'height' => '620',
		'type' => 'jpg'
	)
);