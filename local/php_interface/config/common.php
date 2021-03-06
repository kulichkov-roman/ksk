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
			'seoSecDescIBlockId'      => 10,
			'newsIBlockId'            => 9,
			'ordersIBlockId'          => 11,
			'ordersPhonePropId'       => 17,
			'ordersEmailPropId'       => 18,
			'ordersProdPropId'        => 19,
			'ordersQuantityPropId'    => 20,
			'headerSliderClassesTemplates'  => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_meat_detail/' => '_product-page',
				'/catalog_smf/'  => '_products',
				'/catalog_smf_detail/'  => '_product-page',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list',
				'/news_detail/'  => '_news-page',
				'/404.php'       => '_404',
				'/search/map.php' => '_404'
			),
			'bodyClassesTemplates'    => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_meat_detail/' => '_product-page',
				'/catalog_smf/'  => '_products',
				'/catalog_smf_detail/'  => '_product-page',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list',
				'/news_detail/'  => '_news-page',
				'/404.php'       => '_404',
				'/search/map.php' => ''
			),
			'footerClassesTemplates'    => array(
				'/news/'         => '_compact',
				'/catalog_meat_detail/' => '_compact',
				'/catalog_smf_detail/'  => '_compact'
			),
			'contentClassesTemplates' => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_meat_detail/' => '_product-page',
				'/catalog_smf/'  => '_products',
				'/catalog_smf_detail/'  => '_product-page',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list',
				'/news_detail/'  => '_news-page',
				'/404.php'       => '_404',
				'/search/map.php' => '_404'
			),
			'feedbackIBlockId'    => '7',
		    'feedbackPropPhoneId' => '7',
			'catalogSmfIBlockId'  => '8',
			'newsPlugId'          => '181',
			'w111h115crPlugId'    => '181',
			'w504h537aPlugId'     => '181',
			'w1024h768wPlugId'    => '181',
			'newsDir'             => '/news/',
			'newsDetailDir'       => '/news_detail/',
			'catalogMeatDetailDir'  => '/catalog_meat_detail/',
			'catalogMeatPageUrl'  => '/catalog_meat/',
			'catalogSmfDetailDir'   => '/catalog_smf_detail/',
			'catalogSmfPageUrl'   => '/catalog_smf/',
			'page404'             => '/404.php',
			'pageMap'             => '/search/map.php',
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
			'width' => '418',
			'height' => '241',
			'type' => 'jpg'
		)
	);

	itc\Resizer::addPreset('w111h115cr', array(
			'mode' => 'crop',
			'width' => '111',
			'height' => '115',
			'type' => 'jpg'
		)
	);

	itc\Resizer::addPreset('w504h537a', array(
			'mode' => 'auto',
			'width' => '504',
			'height' => '537',
			'type' => 'jpg'
		)
	);

	itc\Resizer::addPreset('w1024h768wd', array(
			'mode' => 'width',
			'width' => '1024',
			'height' => '768',
			'type' => 'jpg'
		)
	);
}
