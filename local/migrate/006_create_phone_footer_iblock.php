<?php
/**
 * Создает инфоблок «Телефоны»
 *
 * @global $APPLICATION CMain
 */
use Your\Tools\Data\Migration\Bitrix\AbstractIBlockMigration;

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $_SERVER['HTTP_HOST'] = 'ksk.kulichkov.pro';
    $_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

while (ob_get_level()) {
    ob_end_flush();
}

if (!CModule::IncludeModule('iblock')) {
    echo 'Unable to include iblock module';
    exit;
}

/**
 * Создает инфоблок «Телефоны»
 *
 * Class CreateHeroSliderIBlockMigration
 */
class CreatePhoneIBlockMigration extends AbstractIBlockMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $logger = new \Your\Tools\Logger\EchoLogger();

        try {
            $this->createIBlock(
                array(
                    'ACTIVE'           => 'Y',
                    'NAME'             => 'Телефоны: футер',
                    'CODE'             => 'phoneFooter',
                    'IBLOCK_TYPE_ID'   => 'dynamic_content',
                    'SITE_ID'          => array('s1'),
                    'SORT'             => 500,
                    'DESCRIPTION_TYPE' => 'text',
                    'GROUP_ID'         => array('2' => 'R'),
                    'VERSION'          => 2,
                )
            );

            $logger->log(
                sprintf('IBlock has been created. Id: "%s". Add to "phoneFooterIBlockId"', $this->iblockId)
            );
        } catch (\Your\Exception\Data\Migration\MigrationException $exception) {
            $logger->log(sprintf('ERROR: %s', $exception->getMessage()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $logger = new \Your\Tools\Logger\EchoLogger();

        $this->deleteIBlock($environment->get('phoneFooterIBlockId'));

        $logger->log(sprintf('IBlock rewards has been removed. Id: "%s"', $this->iblockId));
    }
}

$migration = new CreatePhoneIBlockMigration();
$migration->up();
?>