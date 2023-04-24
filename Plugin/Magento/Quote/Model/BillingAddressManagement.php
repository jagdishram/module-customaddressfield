<?php
/**
 * Copyright ©Jag All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Jag\CustomAddressField\Plugin\Magento\Quote\Model;

use Magento\Quote\Api\Data\AddressInterface;

class BillingAddressManagement
{
    /**
     * @var \Jag\CustomAddressField\Helper\Data
     */
    protected $helper;

    /**
     * BillingAddressManagement constructor.
     *
     * @param \Jag\CustomAddressField\Helper\Data $helper
     */
    public function __construct(
        \Jag\CustomAddressField\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Quote\Model\BillingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     * @param false $useForShipping
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeAssign(
        \Magento\Quote\Model\BillingAddressManagement $subject,
        $cartId,
        AddressInterface $address,
        $useForShipping = true
    ) {
        $extAttributes = $address->getExtensionAttributes();
        $address->setDistrict($extAttributes->getDistrict());
        if (!empty($extAttributes)) {
            $this->helper->transportFieldsFromExtensionAttributesToObject(
                $extAttributes,
                $address,
                'extra_checkout_billing_address_fields'
            );
        } 
        
        
    }
}
