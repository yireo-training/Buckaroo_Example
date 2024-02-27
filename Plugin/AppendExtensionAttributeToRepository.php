<?php declare(strict_types=1);

namespace Buckaroo\Example\Plugin;

use Buckaroo\Example\Model\ItemModelFactory;
use Buckaroo\Example\Model\ItemRepository;
use Buckaroo\Example\Model\ItemResourceModel;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class AppendExtensionAttributeToRepository
{
    public function __construct(
        private ItemResourceModel $itemResourceModel,
        private ItemModelFactory $itemModelFactory
    ) {
    }

    public function afterGetById(ProductRepositoryInterface $productRepository, ProductInterface $product): ProductInterface
    {
        if ($product->getExtensionAttributes() === null) {
            return $product;
        }

        $itemModel = $this->itemModelFactory->create();
        $this->itemResourceModel->load($itemModel, $product->getId(), 'product_id');
        if (!$itemModel->getId() > 0) {
            return $product;
        }

        $product->getExtensionAttributes()->setBuckarooExample($itemModel);
        return $product;
    }

    public function afterGet(ProductRepositoryInterface $productRepository, ProductInterface $product): ProductInterface
    {
        if ($product->getExtensionAttributes() === null) {
            return $product;
        }

        $itemModel = $this->itemModelFactory->create();
        $this->itemResourceModel->load($itemModel, $product->getId(), 'product_id');

        $product->getExtensionAttributes()->setBuckarooExample($itemModel);
        return $product;
    }

    public function afterSave(ProductRepositoryInterface $productRepository, ProductInterface $product)
    {
        if ($product->getExtensionAttributes() === null) {
            return $product;
        }

        $buckarooExample = (string)$product->getExtensionAttributes()->getBuckarooExample();
        if (empty($buckarooExample)) {
            return $product;
        }

        $itemModel = $this->itemModelFactory->create();
        $this->itemResourceModel->load($itemModel, $product->getId(), 'product_id');

        $itemModel->setName($buckarooExample->getName());
        $itemModel->setId($buckarooExample->getId());
        $itemModel->setDescription($buckarooExample->getDescription());
        $this->itemResourceModel->save($itemModel);

        return $product;
    }
}
