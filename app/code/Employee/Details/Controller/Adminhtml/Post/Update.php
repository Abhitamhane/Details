<?php

namespace Employee\Details\Controller\Adminhtml\Post;

use \Employee\Details\Model\PostFactory as ViewCollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
// use Employee\Details\Helper\Data as EmployeeHelper;

use Magento\Framework\Controller\ResultFactory;

class Update extends Action
{
    protected $_viewCollectionFactory;

    public function __construct(ViewCollectionFactory $viewCollectionFactory, Context $context)
    {
        $this->_viewCollectionFactory = $viewCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = (int)$this->getRequest()->getParam("id_column");  
        $data= $this->getRequest()->getPost();

        try {

                $model = $this->_viewCollectionFactory->create();
                $model->load($data['general']['id_column']);

                $phone = $data['general']['contact_no'];
                if(preg_match('/^[0-9]{10}+$/', $phone)) {
                $model->setData($data['general']);
                $model->save();
                    if($model)
                    {
                        $this->messageManager->addSuccess( __('Data Update Successfully !') );
                    }
                }   
                else {
                    $this->messageManager->addError(__('Contact Number Invalid !') );
                }
            }catch (\Exception $e) 
                {
                    $this->messageManager->addError(__($e->getMessage()));
                }

            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}