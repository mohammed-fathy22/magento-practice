<?php

namespace Scandiweb\Popup\Model\ResourceModel\Popup\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface;

/**
 * Grid Collection for Popup entity.
 */
class Collection extends SearchResult implements SearchResultInterface
{
    /**
     * @var AggregationInterface|null
     */
    protected $aggregations;

    /**
     * @var TimezoneInterface
     */
    private $timeZone;

    /**
     * Collection constructor.
     *
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param TimezoneInterface $timeZone
     * @param MetadataPool $metadataPool
     * @param string $mainTable
     * @param string $resourceModel
     * @param string|null $identifierName
     * @param string|null $connectionName
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        TimezoneInterface $timeZone,
        MetadataPool $metadataPool,
        $mainTable = 'scandiweb_popup',
        $resourceModel = \Scandiweb\Popup\Model\ResourceModel\Popup::class,
        $identifierName = null,
        $connectionName = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel,
            $identifierName,
            $connectionName
        );

        $this->timeZone = $timeZone;
    }

    /**
     * Add field filter with UTC conversion for date fields.
     *
     * @param string $field
     * @param mixed $condition
     * @return $this
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if (in_array($field, ['created_at', 'updated_at']) && is_array($condition)) {
            foreach ($condition as $key => $value) {
                $condition[$key] = $this->timeZone->convertConfigTimeToUtc($value);
            }
        }

        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * Get aggregations.
     *
     * @return AggregationInterface|null
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Set aggregations.
     *
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(?\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[]|null $items
     * @return $this
     */
    public function setItems(?array $items = null)
    {
        return $this;
    }
}
