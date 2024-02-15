<?php declare(strict_types=1);

namespace Buckaroo\Example\Model;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ItemResourceModel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('buckaroo_items', 'id');
    }
}
