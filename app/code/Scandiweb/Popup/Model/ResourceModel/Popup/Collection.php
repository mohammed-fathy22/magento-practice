<?php

namespace Scandiweb\Popup\Model\ResourceModel\Popup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Scandiweb\Popup\Model\Popup as PopupModel;
use Scandiweb\Popup\Model\ResourceModel\Popup as PopupResource;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(PopupModel::class, PopupResource::class);
    }
}
