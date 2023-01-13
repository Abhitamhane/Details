<?php

namespace Employee\Details\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
// use Employee\Details\Model\ResourceModel\Post\CollectionFactory as EmployeeHelper;


class AgentAttribute extends AbstractSource
{
    protected $postFactory;
    public function __construct(\Employee\Details\Model\PostFactory $postFactory)
    {
        
        $this->postFactory = $postFactory;
    }

 
    public function getAllOptions()
    {   
        $agent = $this->postFactory->create();
        $collection = $agent->getCollection();
        
		foreach($collection as $item)
        {
            $data[] = ['label' =>$item->getEmpName(), 'value'=>$item->getIdColumn()];
		}
        
        return $data;
    }
}