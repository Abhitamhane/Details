<?php

namespace Employee\Details\Unit\Test\Block\Adminthml\Post;

use Employee\Details\Block\Adminhtml\Post\SaveButton;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SaveButtonTest extends TestCase
{

    protected function setUp(): void
    {
        $this->block = new SaveButton();
    }

    public function testGetButtonData()
    {
        $expectedResult = [
            'label' => __('Save Details'),
            'class' => 'save primary',
            'data_attribute' => [
            'mage-init' => ['button' => ['event' => 'save']],
            'form-role' => 'save',
            ],
            'sort_order' => 90,
            ];


        $this->assertEquals($expectedResult, $this->block->getButtonData());
    }
}


