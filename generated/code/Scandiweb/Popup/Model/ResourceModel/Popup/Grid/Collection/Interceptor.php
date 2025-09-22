<?php
namespace Scandiweb\Popup\Model\ResourceModel\Popup\Grid\Collection;

/**
 * Interceptor class for @see \Scandiweb\Popup\Model\ResourceModel\Popup\Grid\Collection
 */
class Interceptor extends \Scandiweb\Popup\Model\ResourceModel\Popup\Grid\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timeZone, \Magento\Framework\EntityManager\MetadataPool $metadataPool, $mainTable = 'scandiweb_popup', $resourceModel = 'Scandiweb\\Popup\\Model\\ResourceModel\\Popup', $identifierName = null, $connectionName = null)
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $timeZone, $metadataPool, $mainTable, $resourceModel, $identifierName, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurPage($displacement = 0)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurPage');
        return $pluginInfo ? $this->___callPlugins('getCurPage', func_get_args(), $pluginInfo) : parent::getCurPage($displacement);
    }
}
