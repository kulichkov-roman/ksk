<?php
/**
 * Общая конфигурация для всех сайтов и окружений
 */
\Quetzal\Environment\EnvironmentManager::getInstance()->addConfig(
	new \Quetzal\Environment\Configuration\CommonConfiguration(
		array(
			'sliderMainIBlockId' => 1,
			'sliderMainPlugId' => 5,
			'advantageMainIBlockId' => 2,
			'advantageMainPlugId' => 16,
			'tolerancesIBlockId' => 3
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

itc\Resizer::addPreset('advantageMain', array(
		'mode' => 'crop',
		'width' => '554',
		'height' => '354',
		'type' => 'jpg'
	)
);

itc\Resizer::addPreset('rewardsMainPreview', array(
		'mode' => 'auto',
		'width' => '150',
		'height' => '221',
		'type' => 'jpg'
	)
);

itc\Resizer::addPreset('rewardsMainDetail', array(
		'mode' => 'width',
		'width' => '1024',
		'height' => null,
		'type' => 'jpg'
	)
);