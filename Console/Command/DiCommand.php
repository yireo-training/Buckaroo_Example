<?php declare(strict_types=1);

namespace Buckaroo\Example\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\State;
use Magento\Framework\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DiCommand extends Command
{
    public function __construct(
        private ObjectManagerInterface $objectManager,
        string $name = null)  {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('buckaroo:example:di');
        $this->setDescription('sdfsd');
        $this->addArgument('className', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $className = $input->getArgument('className');
        $object = $this->objectManager->get($className);
        $output->writeln('Object: '.get_class($object));

        return Command::SUCCESS;
    }
}
