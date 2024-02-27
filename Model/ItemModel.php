<?php declare(strict_types=1);

namespace Buckaroo\Example\Model;

use Magento\Framework\Model\AbstractModel;

class ItemModel extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Buckaroo\Example\Model\ItemResourceModel::class);
    }

    public function setName(string $name)
    {
        $this->setData('name', $name);
    }

    public function getName(): string
    {
        return (string) $this->getData('name');
    }

    public function setDescription(string $description)
    {
        $this->setData('description', $description);
    }

    public function getDescription(): string
    {
        return (string) $this->getData('description');
    }
}
