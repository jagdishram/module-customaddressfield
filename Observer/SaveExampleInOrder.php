<?php
/**
 * Copyright ©Jag All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Jag\CustomAddressField\Observer;

class SaveExampleInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
            if ($quote->getBillingAddress()) {
                $order->getBillingAddress()->setDistrict($quote->getBillingAddress()->getExtensionAttributes()->getDistrict());
            }
            if (!$quote->isVirtual()) {            
                $order->getShippingAddress()->setDistrict($quote->getShippingAddress()->getDistrict());
            }
        return $this;
    }
}