<?php

namespace Employee\Details\Unit\Test\Block\Adminthml\Post;

use Employee\Details\Block\Adminhtml\Post\ResetButton;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ResetButtonTest extends TestCase
{

    protected function setUp(): void
    {
        $this->block = new ResetButton();
    }

    public function testGetButtonData()
    {
        $expectedResult = [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
            ];


        $this->assertEquals($expectedResult, $this->block->getButtonData());
    }
}


