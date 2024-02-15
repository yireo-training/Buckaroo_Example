<?php

declare(strict_types=1);

use Buckaroo\Example\ViewModel\Foobar;
use Magento\Framework\App\RequestInterface;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testHello()
    {
        $request = $this->getMockBuilder(RequestInterface::class)
            ->getMock()
        ;

        $request->method('getParam')->willReturn('foobar');

        $viewModel = new Foobar($request);
        $this->assertTrue(class_exists(Foobar::class));
        $this->assertEquals('foobar', $viewModel->getFoobar());
    }
}
