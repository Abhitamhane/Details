<?php

namespace Employee\Details\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		
		$this->resultPageFactory = $resultPageFactory;
     parent::__construct($context);
	}

	public function execute()
	{ 
		$resultPage = $this->resultPageFactory->create();	
        $resultPage->getConfig()->getTitle()->prepend( __('Edit Employee Details'));
        // $this->_setActiveMenu('Employee_Details::employeedetails');
        return $resultPage;
	}
}