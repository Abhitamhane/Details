<?php

namespace Employee\Details\Unit\Test\Resolver;

use PHPUnit\Framework\TestCase;

use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

use Employee\Details\Helper\Data as DataHelper;
use Employee\Details\Model\Resolver\AddEmployee;



Class AddEmployeeTest extends TestCase
{
    protected $objectManagerHelper;

    protected function setUp(): void
    {
        $this->objectManagerHelper = new ObjectManagerHelper($this);

        $this->fieldMock = $this->getMockBuilder(Field::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->context = $this->createMock(ContextInterface::class);

        $this->resolveInfoMock = $this->getMockBuilder(ResolveInfo::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->employeeHelper = $this->createMock(DataHelper::class);

        $this->employee = $this->createMock(\Employee\Details\Model\Post::class);

        $this->AddEmployeeResolver = $this->objectManagerHelper->getObject(
            AddEmployee::class,
            ['employeeHelper' => $this->employeeHelper]
        );
    }

    public function testResolve()
    {
        $args = [
            'input' => [
                'empNo' => 12345,
                'empName' => 'online',
                'contactNo' => '',
                'dob' => ''
            ]
        ];
        
        $value = [];
        
        $apiResponse = [
           
                'empNo' => 12345,
                'empName' => 'online',
                'contactNo' => '',
                'dob' => ''
            
        ];

        $this->employeeHelper->expects($this->any())
        ->method('addEmployee')
        ->willReturn($apiResponse);

        $this->assertEquals(
            $apiResponse,
            $this->AddEmployeeResolver->resolve(
                $this->fieldMock,
                $this->context,
                $this->resolveInfoMock,
                $value,
                $args
            )
        );
    }


}