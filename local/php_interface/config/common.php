<?php
/**
 * Общая конфигурация для всех сайтов и окружений
 */
\Your\Environment\EnvironmentManager::getInstance()->addConfig(
	new \Your\Environment\Configuration\CommonConfiguration(
		array(
			'sliderMainIBlockId'      => 1,
			'sliderMainPlugId'        => 5,
			'advantageMainIBlockId'   => 2,
			'advantageMainPlugId'     => 16,
			'rewardsMainIBlockId'     => 3,
			'rewardsMainPlugId'       => 16,
			'phoneFooterIBlockId'     => 4,
			'catalogMeatIBlockId'     => 5,
			'emailListIBlockId'       => 6,
			'headerSliderClassesTemplates'  => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_smf/'  => '_products',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list'
			),
			'bodyClassesTemplates'    => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_smf/'  => '_products',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list'
			),
			'footerClassesTemplates'    => array(
				'/news/'         => '_compact'
			),
			'contentClassesTemplates' => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_smf/'  => '_products',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list',
			),
			'feedbackIBlockId'    => '7',
		    'feedbackPropPhoneId' => '7',
			'catalogSmfIBlockId'  => '8',
			'newsPlugId'          => '181',
		)
	)
);

/**
 * Перерезатор
 */
if(\Bitrix\Main\Loader::includeModule("itconstruct.resizer"))
{
	/**
	 * Патерны для перерезатора
	 */
	itc\Resizer::addPreset('sliderMain', array(
			'mode' => 'auto',
			'width' => '2000',
			'height' => '568',
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

	itc\Resizer::addPreset('catalogSmfPreview', array(
			'mode' => 'auto',
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

	itc\Resizer::addPreset('newsPicture', array(
			'mode' => 'auto',
			'width' => '311',
			'height' => '250',
			'type' => 'jpg'
		)
	);
}
