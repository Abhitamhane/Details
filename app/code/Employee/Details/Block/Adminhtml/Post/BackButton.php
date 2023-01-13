<?php

namespace Employee\Details\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\UrlInterface;


/**
 * Class BackButton
 */
class BackButton implements ButtonProviderInterface
{
    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->urlBuilder->getUrl('*/*/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

}