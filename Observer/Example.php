<?php declare(strict_types=1);

namespace Buckaroo\Example\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class Example implements ObserverInterface
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function execute(Observer $observer)
    {
        $this->logger->notice('checkout_cart_add_product_complete');
        $event = $observer->getEvent();
        $product = $event->getProduct();
        //$this->logger->debug(var_export(array_keys($event->getData()), true));
    }
}
