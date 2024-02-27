<?php declare(strict_types=1);

namespace Buckaroo\Example\Setup\Patch\Data;

use Magento\Eav\Model\ResourceModel\Attribute;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class Example implements DataPatchInterface
{
    public function __construct(
        private ResourceConnection $resourceConnection,
        private EavSetup $eavSetup
    ) {
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {

       // $color = $this->eavSetup->getAttribute('catalog_product', 'color');
       // $this->eavSetup->addAttribute();

        //$this->resourceConnection->getConnection()->query($sql);
    }
}
