<?php declare(strict_types=1);

namespace Buckaroo\Example\Test\Integration\ViewModel;

use Buckaroo\Config\DefaultConfig;
use Buckaroo\Example\Util\PaymentConfig;
use Buckaroo\Transaction\Client;
use Buckaroo\Transaction\Request\Request;
use Magento\Framework\App\ObjectManager;
use PHPUnit\Framework\TestCase;

class PaymentConfigTest extends TestCase
{
    /**
     * @return void
     * @test
     */
    public function getMerchantKey()
    {
        $paymentConfig = ObjectManager::getInstance()->get(PaymentConfig::class);
        $this->assertInstanceOf(PaymentConfig::class, $paymentConfig);

        $config = new DefaultConfig($paymentConfig->getMerchantKey(), $paymentConfig->getSecretKey());
        $client = new Client($config);


        //$data = new Request();
        //$client->specification($data, 'foobar');
    }
}
