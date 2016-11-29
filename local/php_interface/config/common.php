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
			'headerSliderClassesTemplates'  => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_smf/'  => '_products',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list',
				'/news_detail/'  => '_news-page',
				'/404.php'       => '_404',
				'/search/map.php' => '_404'
			),
			'bodyClassesTemplates'    => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_smf/'  => '_products',
				'/contacts/'     => '_contacts',
				'/news/'         => '_news-list',
				'/news_detail/'  => '_news-page',
				'/404.php'       => '_404',
				'/search/map.php' => ''
			),
			'footerClassesTemplates'    => array(
				'/news/'         => '_compact',
				'/news_detail/'  => '_compact'
			),
			'contentClassesTemplates' => array(
				'/catalog_meat/' => '_catalog',
				'/catalog_smf/'  => '_products',
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
			'newsDir'             => '/news/',
			'newsDetailDir'       => '/news_detail/',
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
			'width' => '311',
			'height' => '250',
			'type' => 'jpg'
		)
	);
}

/*
 * Отдать last-modifier
 * */
$LastModified_unix = strtotime(date("D, d M Y H:i:s", filectime($_SERVER['SCRIPT_FILENAME'])));
$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
$IfModifiedSince = false;


if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
	$IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));


if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
	$IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));


if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
	exit;
}

header('Last-Modified: '. $LastModified);
