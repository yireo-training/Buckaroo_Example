<?php declare(strict_types=1);

namespace Buckaroo\Example\ViewModel;

use Buckaroo\Example\Model\ItemModel;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ExampleExtensionAttribute implements ArgumentInterface
{
    private RequestInterface $request;
    private ProductRepositoryInterface $productRepository;
    public function __construct(
        RequestInterface $request,
        ProductRepositoryInterface $productRepository
    ) {
        $this->request = $request;
        $this->productRepository = $productRepository;
    }

    public function getProduct(int $productId = 0): ProductInterface
    {
        if ($productId === 0) {
            $productId = (int)$this->request->getParam('id');
        }

        return $this->productRepository->getById($productId);
    }

    public function getBuckarooExample(): ?ItemModel
    {
        return $this->getProduct()->getExtensionAttributes()->getBuckarooExample();
    }
}
