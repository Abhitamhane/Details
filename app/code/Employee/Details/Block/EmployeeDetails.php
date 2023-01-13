<?php

namespace Employee\Details\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Employee\Details\Model\ResourceModel\Post\CollectionFactory as ViewCollectionFactory;

class EmployeeDetails extends Template
{
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_viewCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param ViewCollectionFactory $viewCollectionFactory
     */
    public function __construct(
        Context $context,
        ViewCollectionFactory $_viewCollectionFactory,
    ) {
        $this->_viewCollectionFactory  = $_viewCollectionFactory;
        parent::__construct($context);
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
         if ($this->getEmployees()) {
        $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager', 'employee.details' )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection($this->getEmployees());
        $this->setChild('pager', $pager);
        $this->getEmployees()->load();
        }
        return $this;
        }
    
    public function getEmployees()
    {
         //get values of current page
         $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
         //get values of current limit
         $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;
         
        $empCollection = $this->_viewCollectionFactory->create();
        $empCollection->setPageSize($pageSize); 
        $empCollection->setCurPage($page);
        return $empCollection;
    }

    public function getPagerHtml() 
    {
        return $this->getChildHtml('pager');
    }


}
