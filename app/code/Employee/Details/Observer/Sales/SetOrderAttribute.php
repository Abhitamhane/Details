<?php
namespace Employee\Details\Observer\Sales;

use Magento\Framework\Dataobject;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Employee\Details\Helper\Data as EmployeeHelper;
use \Employee\Details\Model\AgentFactory as commissionTable;

class SetOrderAttribute implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Checkout\Model\Session $checkoutSession,
        EmployeeHelper $employeeHelper,
        commissionTable $commissionTable
    ) {
        $this->logger = $logger;
        $this->_checkoutSession = $checkoutSession;
        $this->employeeHelper = $employeeHelper;
        $this->commissionTable = $commissionTable;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) 
    {
        $quote = $observer->getEvent()->getQuote();
        $quoteItems = $quote->getAllItems(); 
        $totalCommission = 0;

        foreach($quoteItems as $_item)
        {
            // $this->logger->info("inside for Event triggered....");
            $agent = $_item->getProduct()->getAgentProductAttribute();

                $collect = $this->employeeHelper->getEmployeeByID($agent);
                $agentPercentage = $collect->getPercentage();
                $agentNo = $collect->getEmpNo();

            $sku = $_item->getProduct()->getSku();
            $itemTotal = $_item->getRowTotal();

            $this->logger->info($_item->getRowTotal());
            $agentCommission = $agentPercentage/100*$itemTotal;
            $orderId = $quote->getReservedOrderId();

            $commissionData = $this->commissionTable->create();
            $commissionData->setAgentId($agentNo);
            $commissionData->setAgentCommission($agentPercentage);
            $commissionData->setProductSku($sku);
            $commissionData->setOrderNo($orderId);
            $commissionData->setCommission($agentCommission);
            $commissionData->save();

            $totalCommission = $agentCommission + $totalCommission;
            $order= $observer->getData('order');
            $order->setAgentCommission("$totalCommission");
            $order->save();
        }
        // $this->logger->info("Outside for Event triggered....");
    }
}   
