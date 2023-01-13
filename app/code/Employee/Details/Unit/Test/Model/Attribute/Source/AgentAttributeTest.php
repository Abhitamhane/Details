<?php

namespace Employee\Details\Unit\Test\Model\Attribute\Source;

use Employee\Details\Model\Attribute\Source\AgentAttribute;

use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;



Class AgentAttributeTest extends TestCase
{
    protected function setUp(): void    
    {
        
        $this->objectManagerHelper = new ObjectManagerHelper($this);

        $this->postFactory = $this->getMockBuilder(\Employee\Details\Model\PostFactory::class)
        ->disableOriginalConstructor()
        ->setMethods(['create','getCollection'])
        ->getMock();

        $this->postCollection = $this->getMockBuilder(\Employee\Details\Model\ResourceModel\Post\Collection::class)
            ->disableOriginalConstructor()
            ->setMethods(['getCollection','getIterator','getEmpName','getIdColumn'])
            ->getMock();

        $this->post = $this->getMockBuilder(\Employee\Details\Model\Post::class)
            ->disableOriginalConstructor()
            ->setMethods(['getEmpName','getIdColumn'])
            ->getMock();

      
        $this->agentAttribute = $this->objectManagerHelper->getObject(
            AgentAttribute::class,
            ['postFactory' => $this->postFactory]
        );

    }

    public function testgetAllOptions()
    {

        $this->postFactory->expects($this->once())
            ->method('create')
            ->willReturnSelf();

        $this->postFactory->expects($this->any())
            ->method('getCollection')
            ->willReturn($this->postCollection);
        
        $this->postCollection->expects($this->once())->method('getIterator')->willReturn(
                new \ArrayIterator([$this->post, $this->post])
            );

        $this->post->expects($this->any())
            ->method('getEmpName')
            ->willReturnOnConsecutiveCalls('Abhishek', 'Mokshik');

        $this->post->expects($this->any())
            ->method('getIdColumn')
            ->willReturnOnConsecutiveCalls('123', '124');


        $value = [
            [
                "label" => 'Abhishek',
                "value"=> 123
            ],
            [
                "label" => 'Mokshik',
                "value"=> 124
            ]
        ];

        $this->assertEquals($value, $this->agentAttribute->getAllOptions());
    }
}