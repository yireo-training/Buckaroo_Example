<?php declare(strict_types=1);

namespace Buckaroo\Example\ViewModel;

use Buckaroo\Example\Model\ItemRepository;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Items implements ArgumentInterface
{
    public function __construct(
        private ItemRepository $itemRepository
    ) {
    }

    public function getItems(): array
    {
        return $this->itemRepository->getList()->getItems();
    }
}
