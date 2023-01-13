<?php
namespace Employee\Details\Controller\Index;

class EmployeeDetails extends \Magento\Framework\App\Action\Action
{
	protected $resultPageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory)
	{
		$this->resultPageFactory = $resultPageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$resultPage =  $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Employee Details FrontEnd')));
		return $resultPage;
	}

}