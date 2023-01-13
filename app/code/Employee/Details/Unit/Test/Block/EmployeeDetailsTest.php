<?php
namespace Employee\Details\Unit\Test\Block;

use Employee\Details\Block\EmployeeDetails;

use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;
use \Employee\Details\Model\ResourceModel\Post\CollectionFactory as ViewCollectionFactory;
use \Employee\Details\Model\ResourceModel\Post\Collection as Collection;

class EmployeeDetailsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->objectManagerHelper = new ObjectManagerHelper($this);

        $this->collection = $this->createMock(Collection::class);

        $this->_viewCollectionFactory = $this->getMockBuilder(ViewCollectionFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->_layout = $this->getMockBuilder(\Magento\Framework\View\LayoutInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getLayout'])
            ->getf();

        

        $this->GetEmployeeDetails = $this->objectManagerHelper->getObject(
            EmployeeDetails::class,
            ['_viewCollectionFactory' => $this->_viewCollectionFactory]
        );
    }

    public function testGetEmployees()
    {
        $this->_viewCollectionFactory->expects($this->any())
        ->method('create')
        ->willReturn($this->collection);

        $this->collection->expects($this->any())
        ->method('setPageSize')
        ->willReturn($this->collection);
        
        $this->collection->expects($this->any())
        ->method('setCurPage')
        ->willReturn($this->collection);

        $this->assertEquals($this->collection, $this->GetEmployeeDetails->getEmployees());
    }

    public function test_prepareLayout()
    {
        $this->_layout->expects($this->any())
        ->method('getLayout')
        ->willReturn(213);


        $this->GetEmployeeDetails->_prepareLayout();
    }

}
