<?php declare(strict_types=1);

namespace Buckaroo\Example\Test\Integration\ViewModel;

use Buckaroo\Example\Model\ItemRepository;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ObjectManager;
use PHPUnit\Framework\TestCase;

class EntityItemTest extends TestCase
{
    /**
     * @return void
     * @test
     */
    public function testEntityInteraction()
    {
        $itemFactory = ObjectManager::getInstance()->get(\Buckaroo\Example\Model\ItemModelFactory::class);
        $item = $itemFactory->create();

        $item->setName('foobar');
        $item->setDescription('sdffsdfds');

        $resourceModel = ObjectManager::getInstance()->get(\Buckaroo\Example\Model\ItemResourceModel::class);
        $resourceModel->save($item);

        $collectionFactory = ObjectManager::getInstance()->get(\Buckaroo\Example\Model\ItemCollectionFactory::class);
        $collection = $collectionFactory->create();
        $collection->addFilter('name', 'foobar');
        $size = $collection->getSize();

        foreach ($collection as $item) {
            $resourceModel->delete($item);
        }

        $this->assertEquals(1, $size);
    }

    public function testRepository()
    {
        $repository = ObjectManager::getInstance()->get(ItemRepository::class);


        $itemFactory = ObjectManager::getInstance()->get(\Buckaroo\Example\Model\ItemModelFactory::class);
        $item = $itemFactory->create();
        $item->setName('foobar');
        $item->setDescription('sdffsdfds');

        $repository->save($item);

        $searchCriteriaBuilder = ObjectManager::getInstance()->get(SearchCriteriaBuilder::class);
        $searchCriteriaBuilder->addFilter('name', 'foobar');
        $searchResults = $repository->getList($searchCriteriaBuilder->create());
        $this->assertEquals(1, $searchResults->getTotalCount());

        foreach ($searchResults->getItems() as $item) {
            $repository->delete($item);
        }

        $searchCriteriaBuilder = ObjectManager::getInstance()->get(SearchCriteriaBuilder::class);
        $searchCriteriaBuilder->addFilter('name', 'foobar');
        $searchResults = $repository->getList($searchCriteriaBuilder->create());
        $this->assertEquals(0, $searchResults->getTotalCount());
    }
}
