<?php declare(strict_types=1);

namespace Buckaroo\Example\Console\Command;

use Buckaroo\Example\Factory\ProductFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\State;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{

    public function __construct(
        private ProductRepositoryInterface $productRepository,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('buckaroo:example');
        $this->setDescription('Show a product');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $product = $this->productRepository->getById(42);

        $output->writeln('Product name: '.$product->getExtensionAttributes()->getBuckarooExample()->getName());
        return Command::SUCCESS;
    }
}
