<?php
/**
 * Общая конфигурация для всех сайтов и окружений
 */
\Your\Environment\EnvironmentManager::getInstance()->addConfig(
	new \Your\Environment\Configuration\CommonConfiguration(
		array(
			'sliderMainIBlockId' => 1,
			'sliderMainPlugId' => 5,
			'advantageMainIBlockId' => 2,
			'advantageMainPlugId' => 16,
			'rewardsMainIBlockId' => 3,
			'rewardsMainPlugId' => 16,
			'phoneFooterIBlockId' => 4,
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
		'type' => 'png'
	)
);

itc\Resizer::addPreset('advantageMainPreview', array(
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