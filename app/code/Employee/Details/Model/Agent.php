<?php

namespace Employee\Details\Model;

use Magento\Framework\Model\AbstractModel;
use Employee\Details\Model\ResourceModel\Agent as ResourceModel;

class Agent extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}