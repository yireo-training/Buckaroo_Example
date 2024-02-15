<?php
declare(strict_types=1);

namespace Buckaroo\Example\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

// buckaroo_example/index/index = frontName/controller/action
class Index implements HttpGetActionInterface
{
    private JsonFactory $jsonFactory;
    private PageFactory $pageFactory;
    private RedirectFactory $redirectFactory;
    private ForwardFactory $forwardFactory;

    public function __construct(
        JsonFactory $jsonFactory,
        PageFactory $pageFactory,
        RedirectFactory $redirectFactory,
        ForwardFactory $forwardFactory
    ){
        $this->jsonFactory = $jsonFactory;
        $this->pageFactory = $pageFactory;
        $this->redirectFactory = $redirectFactory;
        $this->forwardFactory = $forwardFactory;
    }

    public function execute(): ResultInterface
    {

        $page = $this->pageFactory->create();
        return $page;

        $forward = $this->forwardFactory->create();
        $forward->setModule('checksddout');
        $forward->setController('cart');
        return $forward->forward('index');

        /**
        $redirect = $this->redirectFactory->create();
        $redirect->setUrl('/');
        return $redirect;
         */

        /*$json = $this->jsonFactory->create();
        $json->setData(['foo' => 'bar']);
        return $json;*/

    }
}
