<?php

namespace Scandiweb\Popup\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Popup extends AbstractDb
{
    protected const TABLE_NAME = 'scandiweb_popup';
    protected const PRIMARY_KEY = 'popup_id';
    /**
     * Define main table and primary key
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}
