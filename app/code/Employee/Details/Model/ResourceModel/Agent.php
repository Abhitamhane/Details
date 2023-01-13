<?php

namespace Employee\Details\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Agent extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('order_commission', 'entity_id');
    }
}