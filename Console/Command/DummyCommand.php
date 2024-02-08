<?php declare(strict_types=1);

namespace Buckaroo\Example\Console\Command;

use Buckaroo\Example\Factory\ProductFactory;
use Magento\Framework\App\State;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DummyCommand extends Command
{

    public function __construct(
        private ProductFactory $productFactory,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('buckaroo:product:new');
        $this->setDescription('Generate a new product');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $product = $this->productFactory->create(['data' => ['name' => 'Foobar']]);
        $output->writeln('New product name: '.$product->getName());
        $output->writeln('New product sku: '.$product->getSku());
        return Command::SUCCESS;
    }
}
