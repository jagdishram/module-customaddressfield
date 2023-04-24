<?php
/**
 * Copyright ©Jag All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Jag\CustomAddressField\Plugin\Magento\Quote\Model;

use Jag\CustomAddressField\Helper\Data;
use Magento\Quote\Api\Data\AddressInterface;

class ShippingAddressManagement
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * ShippingAddressManagement constructor.
     *
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Quote\Model\ShippingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeAssign(
        \Magento\Quote\Model\ShippingAddressManagement $subject,
        $cartId,
        AddressInterface $address
    ) {
        $extAttributes = $address->getExtensionAttributes();  
       // $address->setDistrict($extAttributes->getDistrict());     
       if (!empty($extAttributes)) {
            $this->helper->transportFieldsFromExtensionAttributesToObject(
                $extAttributes,
                $address,
                'extra_checkout_shipping_address_fields'
            );
        }
        $address->setDistrict($extAttributes->getDistrict());
        
    }
}
