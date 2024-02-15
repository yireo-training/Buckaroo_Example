<?php declare(strict_types=1);

namespace Buckaroo\Example\Util;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PaymentConfig
{
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ) {
    }

    public function getMerchantKey(): string
    {
        return (string)$this->scopeConfig->getValue('buckaroo_magento2/account/merchant_key');
    }

    public function getSecretKey(): string
    {
        return (string)$this->scopeConfig->getValue('buckaroo_magento2/account/secret_key');
    }
}
