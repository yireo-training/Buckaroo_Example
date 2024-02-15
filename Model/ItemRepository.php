<?php declare(strict_types=1);

namespace Buckaroo\Example\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

class ItemRepository
{
    public function __construct(
        private ItemModelFactory $itemModelFactory,
        private ItemResourceModel $itemResourceModel,
        private ItemCollectionFactory $itemCollectionFactory,
        private CollectionProcessorInterface $collectionProcessor,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private SearchResultsInterfaceFactory $searchResultsFactory
    ) {
    }

    public function get(int $itemId): ItemModel
    {
        $item = $this->itemModelFactory->create();
        $this->itemResourceModel->load($item, $itemId, 'id');
        return $item;
    }

    public function save(ItemModel $item)
    {
        $this->itemResourceModel->save($item);
    }

    public function delete(ItemModel $item)
    {
        $this->itemResourceModel->delete($item);
    }

    public function deleteById(int $itemId)
    {
        $item = $this->itemModelFactory->create();
        $this->itemResourceModel->load($item, $itemId, 'id');
        $this->itemResourceModel->delete($item);
    }

    public function getList(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        if (!$searchCriteria instanceof SearchCriteriaInterface) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        }

        $collection = $this->itemCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);

        return $searchResults;
    }
}
