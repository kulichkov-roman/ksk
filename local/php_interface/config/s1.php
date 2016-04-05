<?php
/**
 * Конфигурация для сайта с id s1
 */
\Quetzal\Environment\EnvironmentManager::getInstance()->addConfig(
	new \Quetzal\Environment\Configuration\SiteConfiguration(
		's1',
		array(
			// 'key' => 'value',
		)
	)
);
