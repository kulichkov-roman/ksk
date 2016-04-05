<?php
/**
 * Общая конфигурация для всех сайтов и окружений
 */
\Quetzal\Environment\EnvironmentManager::getInstance()->addConfig(
	new \Quetzal\Environment\Configuration\CommonConfiguration(
		array(
			/**
			 * @todo нужно выполнить миграцию 002_create_hero_slider_iblock.php
			 * и записать сюда полученный id
			 */
			// id ИБ "Слайдер"
			'sliderHeroIBlockId' => 6,
			/**
			 * @todo нужно выполнить миграцию 004_create_feedback_iblock.php
			 */
			// id ИБ "Обратная связь"
			'feedbackIBlockId' => 7,
			'feedbackEmailPropId' => 8,
			'feedbackPhonePropId' => 9,
			/**
			 * @todo нужно выполнить миграцию 006_create_contacts_slider_iblock.php
			 */
			// id ИБ "Контакты"
			'contactsSliderIBlockId' => 8,
		)
	)
);
