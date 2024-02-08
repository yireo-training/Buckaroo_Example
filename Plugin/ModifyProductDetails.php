<?php declare(strict_types=1);

namespace Buckaroo\Example\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;

class ModifyProductDetails
{
    public function beforeSetName(ProductInterface $product, string $name): string
    {
        //$name .= '42';
        return $name;
    }

    public function afterGetName(ProductInterface $product, null|string $return): string
    {
        //$return = strtoupper($return);
        return (string)$return;
    }

    public function aroundSetName(ProductInterface $product, callable $proceed, string $name)
    {
        $name .= 'dfsd';
        $return = $proceed($name);
        return $return;
    }
}
