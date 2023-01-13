<?php

namespace Employee\Details\Unit\Test\Block\Adminthml\Post;

use Employee\Details\Block\Adminhtml\Post\BackButton;

use Magento\Framework\UrlInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BackButtonTest extends TestCase
{
    protected $block;

    protected $urlBuilderMock;

    protected function setUp(): void
    {
        $this->urlBuilderMock = $this->getMockForAbstractClass(UrlInterface::class);
        $this->block = new BackButton(
            $this->urlBuilderMock
        );
    }

    public function testGetButtonData()
    {
        $backUrl = 'back url';
        $expectedResult = [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $backUrl),
            'class' => 'back',
            'sort_order' => 10
        ];

        $this->urlBuilderMock->expects($this->once())
            ->method('getUrl')
            ->with('*/*/')
            ->willReturn($backUrl);

        $this->assertEquals($expectedResult, $this->block->getButtonData());
    }
}

