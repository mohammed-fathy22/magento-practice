<?php

declare(strict_types=1);

namespace Scandiweb\LatestProductTab\Block\Product;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\View\Element\Template;

/**
 * Block to display latest products in a tab
 */
class LatestProducts extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $productCollectionFactory,
        protected Visibility $productVisibility,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Retrieve latest products collection
     *
     * @param int $limit
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getLatestProducts(int $limit = 10)
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*')
            ->addAttributeToFilter('status', 1)
            ->setVisibility($this->productVisibility->getVisibleInCatalogIds())
            ->setOrder('created_at', 'desc')
            ->setPageSize($limit)
            ->setCurPage(1);

        return $collection;
    }
}
