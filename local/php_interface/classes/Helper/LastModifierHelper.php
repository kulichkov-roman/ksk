<?
namespace KSK\Helper;

/**
 * Class LastModifierHelper
 */
class LastModifierHelper
{
    /**
     * @var LastModifierHelper
     */
    protected static $instance = null;

    /**
     * @var $strLastModifier
     */
    private $strLastModifier;

    /**
     * @return LastModifierHelper
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __construct()
    {}

    private function __clone()
    {}

    /**
     * Сохранить $strLastModifier
     */
    public function setLastModifier($lastModifier)
    {
        $this->strLastModifier = $lastModifier;
    }

    /**
     * Сохранить $strLastModifier
     */
    public function getLastModifier()
    {
        return $this->strLastModifier;
    }
}
?>
