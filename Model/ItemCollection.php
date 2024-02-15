<?php declare(strict_types=1);

namespace Buckaroo\Example\Model;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class ItemCollection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Buckaroo\Example\Model\ItemModel::class, \Buckaroo\Example\Model\ItemResourceModel::class);
    }
}
