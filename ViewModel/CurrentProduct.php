<?php declare(strict_types=1);

namespace Buckaroo\Example\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CurrentProduct implements ArgumentInterface
{
    private RequestInterface $request;
    private ProductRepositoryInterface $productRepository;
    private UrlInterface $url;

    public function __construct(
        RequestInterface $request,
        ProductRepositoryInterface $productRepository,
        UrlInterface $url
    ) {
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->url = $url;
    }

    public function getProduct(int $productId = 0): ProductInterface
    {
        if ($productId === 0) {
            $productId = (int)$this->request->getParam('id');
        }

        return $this->productRepository->getById($productId);
    }

    public function getProductUrl(int $productId = 0): string
    {
        $productId = $this->getProduct($productId)->getId();
        return $this->url->getUrl('catalog/product/view', ['id' => $productId]);
    }
}
