<?php declare(strict_types=1);

namespace Buckaroo\Example\Setup\Patch\Data;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class Example implements DataPatchInterface
{
    public function __construct(
        private ResourceConnection $resourceConnection
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
        //$this->resourceConnection->getConnection()->query($sql);
    }
}
