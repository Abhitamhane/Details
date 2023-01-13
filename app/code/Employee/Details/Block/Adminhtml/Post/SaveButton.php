<?php
namespace Employee\Details\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;



class SaveButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Save Details'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}