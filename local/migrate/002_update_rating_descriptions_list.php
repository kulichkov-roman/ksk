<?php
/**
 * Обновляет список правил начисления рейтинга
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
 * Class UpdateRatingDescriptionsList
 */
class UpdateRatingDescriptionsList implements MigrationInterface
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
		$manager = \Quetzal\Data\Bitrix\IBlockElementManager::getInstance();

		// Deactivate "Создать альбом"
		$manager->update(9598, array('ACTIVE' => 'N'));

		// Add a new items
		$items = array(
			array(
				'NAME'            => 'Спасибо на форуме',
				'PROPERTY_VALUES' => array(
					'VAL' => 5,
				),
			),
			array(
				'NAME'            => 'Прохождение вебинара',
				'PROPERTY_VALUES' => array(
					'VAL' => 20,
				),
			),
			array(
				'NAME'            => 'Прохождение опроса',
				'PROPERTY_VALUES' => array(
					'VAL' => 10,
				),
			),
			array(
				'NAME'            => 'Приведи друга',
				'PROPERTY_VALUES' => array(
					'VAL' => 20,
				),
			),
		);

		foreach ($items as $arItem) {
			$arItem['IBLOCK_ID'] = $this->iblockId;

			if ($id = $manager->add($arItem)) {
				$this->logger->log(sprintf('Item "%s" (%s) has been added', $arItem['NAME'], $id));
			} else {
				$this->logger->log(sprintf('Unable to add item "%s": %s', $arItem['NAME']));
			}
		}
	}

	/**
	 * Отменяет миграцию
	 */
	public function down()
	{
		throw new \Quetzal\Exception\Common\NotImplementedException('Method "down" was not implement');
	}
}

$migration = new UpdateRatingDescriptionsList();

try {
	$migration->up();
} catch (\Quetzal\Exception\Data\Migration\MigrationException $e) {
	echo sprintf('Error of migration apply: "%s"', $e->getMessage()) . PHP_EOL;
}
