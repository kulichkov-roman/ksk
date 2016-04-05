<?php
/**
 * Обновляет правило начисления рейтинга за портфолио
 */
use Quetzal\Tools\Data\Migration\Common\MigrationInterface;

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'rehau.pro';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

while (ob_get_level()) {
	ob_end_flush();
}

if (!CModule::IncludeModule('iblock')) {
	die('Unable to include "iblock" module');
}

/**
 * Class UpdatePortfolioRatingDescriptions
 */
class UpdatePortfolioRatingDescriptions implements MigrationInterface
{
	/**
	 * @var int
	 */
	protected $iblockId;

	/**
	 * @var \Quetzal\Tools\LoggerInterface
	 */
	private $logger;

	public function __construct()
	{
		$this->iblockId = \Quetzal\Environment\EnvironmentManager::getInstance()->get('ratingDescriptionIBlockId');
		$this->logger = new \Quetzal\Tools\Logger\EchoLogger();
	}

	/**
	 * Применяет миграцию
	 */
	public function up()
	{
		CIBlockElement::SetPropertyValuesEx(
			3345,
			\Quetzal\Environment\EnvironmentManager::getInstance()->get('ratingDescriptionIBlockId'),
			array(
				'VAL'     => 1,
				'IS_ONCE' => '',
			)
		);
	}

	/**
	 * Отменяет миграцию
	 */
	public function down()
	{
		throw new \Quetzal\Exception\Common\NotImplementedException('Method "down" was not implement');
	}
}

$migration = new UpdatePortfolioRatingDescriptions();

try {
	$migration->up();

	echo 'OK' . PHP_EOL;
} catch (\Quetzal\Exception\Data\Migration\MigrationException $e) {
	echo sprintf('Error of migration apply: "%s"', $e->getMessage()) . PHP_EOL;
}
