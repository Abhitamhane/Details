<?php

namespace Employee\Details\Unit\Test\Resolver;

use PHPUnit\Framework\TestCase;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;

use \Employee\Details\Model\ResourceModel\Post\CollectionFactory as DataHelper;
use Employee\Details\Model\Resolver\Employee;

class GetEmployeeTest extends TestCase
{
    protected $objectManagerHelper;

    protected function setUp(): void
    {
        $this->objectManagerHelper = new ObjectManagerHelper($this);

        $this->fieldMock = $this->getMockBuilder(Field::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->employeeHelper = $this->createMock(DataHelper::class);

        $this->context = $this->createMock(ContextInterface::class);

        $this->resolveInfoMock = $this->getMockBuilder(ResolveInfo::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->GetEmployeeDetailsResolver = $this->objectManagerHelper->getObject(
            Employee::class,
            ['employeeHelper' => $this->employeeHelper]
        );
    }

    public function testResolve()
    {
        $args = [];

        $value = [];

        $apiResponse = [
            // 'success' => true,
            // 'message' => __('OK'),
            'contact_no' => [],
            'dob' => [],
            'emp_name' => [],
            'emp_no' => [],
            'id_column' => []
        ];

        $this->employeeHelper->expects($this->once())
        ->method('create')
        ->willReturn($this->employeeHelper);

        $this->assertEquals(
            $value,
            $this->GetEmployeeDetailsResolver->resolve(
                $this->fieldMock,
                $this->context,
                $this->resolveInfoMock,
                $value,
                $args
            )
        );

    }

}