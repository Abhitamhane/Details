<?php
namespace Employee\Details\Model\ResourceModel\Agent;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Employee\Details\Model\Agent as Model;
use Employee\Details\Model\ResourceModel\Agent as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}