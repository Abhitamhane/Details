<?php

namespace Employee\Details\Unit\Test\Model;

use  Employee\Details\Model\DataProvider;

use PHPUnit\Framework\TestCase;
use Employee\Details\Model\ResourceModel\Post\CollectionFactory as CollectionFactory;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

Class DataProviderTest extends TestCase
{
    protected $objectManagerHelper;
    public $item;

    protected function setUp(): void
    {
        $this->objectManagerHelper = new ObjectManagerHelper($this);

        $this->collection = $this->getMockBuilder(CollectionFactory::class)
        ->disableOriginalConstructor()
        ->setMethods(['create','getFirstItem','getId'])
        ->getMock();

        $item = $this->collection->expects($this->any())
        ->method('create')
        ->willReturnSelf();

        $this->dataProvider = $this->objectManagerHelper->getObject(
            DataProvider::class,
            ['collection' => $this->collection]
        );

    }

    public function testGetDetails()
    {
            $this->collection->expects($this->once())
            ->method('getFirstItem')
            ->willReturnSelf();

            $this->collection->expects($this->once())
            ->method('getId')
            ->willReturn(123);

        $this->assertEquals(123, $this->dataProvider->getDetails());
    }

}
