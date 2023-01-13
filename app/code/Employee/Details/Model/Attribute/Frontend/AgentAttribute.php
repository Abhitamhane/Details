<?php 

namespace Employee\Details\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\Dataobject;
use Employee\Details\Helper\Data as EmployeeHelper;


class AgentAttribute extends AbstractFrontend
{
    public function __construct(EmployeeHelper $employeeHelper)
    {
        $this->employeeHelper = $employeeHelper;
    }

    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        $collect = $this->employeeHelper->getEmployeeByID($value);
        $name = $collect->getEmpName();
        return "Agent Id: $name";
    }
}