<?php
declare(strict_types=1);

namespace Buckaroo\Example\Factory;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\ObjectManagerInterface;

/**
 * Factory class for @see \Magento\Catalog\Api\Data\ProductInterface
 */
class ProductFactory
{
    /**
     * Factory constructor
     *
     * @param ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(
        private ObjectManagerInterface $objectManager,
        private ProductRepositoryInterface $productRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return ProductInterface
     */
    public function create(array $data = []): ProductInterface
    {
        $product = $this->objectManager->create(ProductInterface::class, $data);
        if ($product->getAttributeSetId() < 1) {
            $product->setAttributeSetId(15);
        }

        $this->searchCriteriaBuilder->addSortOrder((new SortOrder())->setField('sku'));
        $this->searchCriteriaBuilder->setPageSize(1);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->productRepository->getList($searchCriteria);
        $items = $searchResult->getItems();
        $lastSkuItem = array_shift($items);
        $lastSku = $lastSkuItem->getSku();
        $newSku = $lastSku . '-1';
        $product->setSku($newSku);

        return $product;
    }
}
