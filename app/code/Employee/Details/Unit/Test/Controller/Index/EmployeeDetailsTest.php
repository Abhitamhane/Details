<?php

namespace Employee\Details\Unit\Test\Controller\Index;

use PHPUnit\Framework\TestCase;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Page\Title;
use Employee\Details\Controller\Index\EmployeeDetails as EmployeeDetailsPage;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;


Class EmployeeDetailsTest extends TestCase
{
    protected $objectManagerHelper;

    protected function setUp(): void
    {
        $context = $this->getMockBuilder(\Magento\Backend\App\Action\Context::class)
        ->disableOriginalConstructor()
        ->getMock();

        $title = $this->getMockBuilder(Title::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        
        $this->page = $this->getMockBuilder(Page::class)
        ->disableOriginalConstructor()
        ->onlyMethods(['getConfig'])
        ->addMethods(['getTitle'])
        ->getMock();

        $this->page->expects($this->once())->method('getConfig')->willReturn($this->page);
        $this->page->expects($this->once())->method('getTitle')->willReturn($title);

        $this->resultPageFactory = $this->getMockBuilder(PageFactory::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create'])
            ->getMock();

        $this->resultPageFactory->expects($this->any())
            ->method('create')
            ->willReturn($this->page);

        $this->objectManagerHelper = new ObjectManagerHelper($this);
        
        $this->employeeDetailsPage = $this->objectManagerHelper->getObject(
            EmployeeDetailsPage::class,
            [
                'context' => $context,
                'resultPageFactory' => $this->resultPageFactory
            ]
        );
    }

    public function testExecute(): void
    {
        $this->assertEquals($this->page, $this->employeeDetailsPage->execute());
    }


}
