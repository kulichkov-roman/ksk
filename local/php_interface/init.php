<?php
require_once 'vendor/QuetzalTools/bootstrap.php';
require_once 'classes/AutoLoader.php';

\spl_autoload_register('\Momentum\AutoLoader::autoLoad');

$environment = \Quetzal\Environment\EnvironmentManager::getInstance();

foreach ($environment->getConfigFileNames() as $fileName) {
	$fileName = sprintf('%s/config/%s.php', __DIR__, $fileName);

	if (file_exists($fileName)) {
		include_once $fileName;
	}
}

AddEventHandler('main', 'OnEpilog', array('RequestHandler', 'Show404IfNeeded'));