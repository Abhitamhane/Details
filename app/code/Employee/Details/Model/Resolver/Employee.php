<?php

namespace Employee\Details\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use \Employee\Details\Model\ResourceModel\Post\CollectionFactory as EmployeeHelper;

class Employee implements ResolverInterface
{
    /** @var EmployeeHelper */
    private $employeeHelper;
   
    /**
     * Class Constructor
     *
     * @param EmployeeHelper $employeeHelper
     */
    public function __construct(EmployeeHelper $employeeHelper)
    {
        $this->employeeHelper = $employeeHelper;
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
        $collect = $this->employeeHelper->create();
        foreach ($collect as $key => $employee) 
        {
            $value [] = $employee->getData();
        }
        return $value;
    }
}
