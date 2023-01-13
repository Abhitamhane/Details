<?php

namespace Employee\Details\Unit\Test\Model\Attribute\Frontend;

use Employee\Details\Model\Attribute\Frontend\AgentAttribute;

use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Employee\Details\Helper\Data as EmployeeHelper;
use Magento\Framework\Dataobject as DataObject;
use Employee\Details\Model\Post as Employee;


Class AgentAttributeTest extends TestCase
{
    public $dataObject;

    protected function setUp(): void    
    {
        
        $this->objectManagerHelper = new ObjectManagerHelper($this);

        $this->employeeHelper = $this->getMockBuilder(EmployeeHelper::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->employee = $this->getMockBuilder(Employee::class)
            ->disableOriginalConstructor()
            ->setMethods(['getEmpName'])
            ->getMock();

        $this->dataObject = $this->getMockBuilder(DataObject::class)
        ->disableOriginalConstructor()
        ->setMethods(['getData','getAttribute','getAttributeCode'])
        ->getMock();

        $this->_attribute = $this->getMockBuilder(\Magento\Eav\Model\Entity\Attribute\AbstractAttribute::class)
            ->disableOriginalConstructor()
            ->setMethods(['getAttributeCode'])
            ->getMock();
        
        $this->agentAttribute = $this->objectManagerHelper->getObject(
            AgentAttribute::class,
            [
                'employeeHelper' => $this->employeeHelper,
                '_attribute' => $this->_attribute
            ]
        );

    }

    public function testGetValue()
    {

        $this->dataObject->expects($this->any())
            ->method('getData')
            ->willReturn(123);

        $this->_attribute->expects($this->any())
            ->method('getAttributeCode')
            ->willReturn('AttributeCode');

        $this->employeeHelper->expects($this->any())
            ->method("getEmployeeByID")
            ->willReturn($this->employee);

        $this->employee->expects($this->any())
            ->method("getEmpName")
            ->willReturn("Abhishek");

        
        $this->assertEquals("Agent Id: Abhishek", $this->agentAttribute->getValue($this->dataObject));

    }

}