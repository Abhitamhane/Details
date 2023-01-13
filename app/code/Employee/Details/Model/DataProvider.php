<?php

namespace Employee\Details\Model;

use Employee\Details\Model\ResourceModel\Post\CollectionFactory as CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collection,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collection->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getDetails()
    {
        $items = $this->collection->getFirstItem();
        // $this->_loadedData = array();
        $this->_loadedData= $items->getId();
        return $this->_loadedData;
    }
}