<?php

namespace Employee\Details\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Employee\Details\Model\ResourceModel\Post\CollectionFactory as Collection;
use Magento\Framework\Stdlib\DateTime\DateTime as DateTime;


class Employee implements ResolverInterface
{
    /** @var Collection */
    private $collection;

    private $dateTime;
   
    /**
     * Class Constructor
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection, DateTime $dateTime)
    {
        $this->collection = $collection;
        $this->dateTime = $dateTime;
    }
    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $collect = $this->collection->create();
        $size = $collect->getSize();
        $current_Page = $args['current_Page'];
        $order = ($args['sortOrder'])? 'ASC' : 'DESC';
        $pageSize = $args['pageSize'];
        $totalPages  = ceil($size/$pageSize);
        $collect->getSelect()->order('id_column '.$order);
        $collect->setPageSize($pageSize)->setCurPage($current_Page);


        foreach ($collect as $key => $employee) 
        {
            $employeeData = $employee->getData();
            $formatedDate = $employee->getDob();
            $format = "d-m-Y";
            $formatedDate = $this->dateTime->date($format, $formatedDate);
            unset($employeeData['dob']);
            $employeeData['dob'] = $formatedDate;
            $value[] = $employeeData;
        }
        
        $data['employee'] = $value;
        $data['total_count'] = $size;
        $data['total_pages'] = $totalPages;
        return $data;
    }
}
