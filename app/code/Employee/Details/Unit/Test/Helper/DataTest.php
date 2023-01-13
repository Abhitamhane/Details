<?php
namespace Employee\Details\Unit\Test\Helper;

use Employee\Details\Helper\Data;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use \Employee\Details\Model\ResourceModel\Post\CollectionFactory as ViewCollectionFactory;
use \Employee\Details\Model\ResourceModel\Post\Collection as Collection;
use \Employee\Details\Model\PostFactory as employeeTable;

class DataTest extends \PHPUnit\Framework\TestCase
{
    
    protected $context;

    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);

        $this->_viewCollectionFactory = $this->getMockBuilder(ViewCollectionFactory::class)
        ->disableOriginalConstructor()
        ->setMethods(['create'])
        ->getMock();

        $this->collection = $this->createMock(Collection::class);

        $this->employeeTable = $this->getMockBuilder(employeeTable::class)
        ->disableOriginalConstructor()
        ->setMethods(['create','load','setData','save'])
        ->getMock();

        $this->employee = $this->createMock(\Employee\Details\Model\Post::class);

        

        $this->helper = $objectManager->getObject(
            Data::class,
            [
               "context" => $this->context,
               "_viewCollectionFactory" => $this->_viewCollectionFactory,
               "employeeTable" => $this->employeeTable,
            ]
        );
    }

    public function testgetCollection()
    {
        $this->_viewCollectionFactory->expects($this->any())
        ->method('create')
        ->willReturn($this->collection);
    
        $this->assertEquals($this->collection, $this->helper->getCollection());
    }


    public function testgetEmployeeByID()
    {
        $idColumn = 1;
      
            $this->employeeTable->expects($this->any())
            ->method('create')
            ->willReturn($this->employee);

        $this->employee->expects($this->any())
        ->method('load')
        ->willReturnSelf();

        $this->assertEquals($this->employee, $this->helper->getEmployeeByID($idColumn));
    }

    public function testaddEmployee()
    {   
        $empNo = 123;
        $empName = 123; 
        $contactNo =123; 
        $dob = 123;

        $response = [
            'emp_no' => 123,
            'emp_name' => 123,
            'contact_no' => 123,
            'dob' => 123,
        ];

        $this->employeeTable->expects($this->any())
        ->method('create')
        ->willReturn($this->employee);

        $this->employee->expects($this->any())
        ->method('setData')
        ->willReturn($this->employee);
        
        // $this->employeeTable->expects($this->once())
        // ->method('save')
        // ->willReturn($this->employee);


        // $this->assertEquals($this->employee, $this->helper->addEmployee($empNo,$empName,$contactNo,$dob));
        $this->helper->addEmployee($empNo,$empName,$contactNo,$dob);
    }
  
    public function testGetData()
    {
        $this->helper->getData();
    }

}