<?php

declare(strict_types = 1);

namespace Presentation\Cli\Command\Commission;

use Application\Commission\ValueObject\Money;
use Application\Commission\ValueObject\Transaction;
use Application\Commission\Service\CalculateBatchService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

final class CalculateBatchCommand extends Command
{
    public function __construct(private readonly CalculateBatchService $calculateBatchService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('commission:calculate:batch')
            ->setAliases(['comm:calc:batch'])
            ->setDescription('Calculate commission')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to the file with transactions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $filePath = $input->getArgument('file');
        if (!file_exists($filePath) || !is_readable($filePath)) {
            $output->writeln("<error>Unable to read file {$filePath}</error>");
            return Command::FAILURE;
        }

        $resource = fopen($filePath, 'r');
        if (!$resource) {
            $output->writeln("<error>Error opening file {$filePath}</error>");
            return Command::FAILURE;
        }

        $commissionList = $this->calculateBatchService->calculateBatch($this->getBatchIterator($resource));
        foreach ($commissionList as $commission) {
            $output->writeln((string) $commission->getMoney()->getAmount());
        }

        fclose($resource);
        return Command::SUCCESS;
    }

    private function getBatchIterator($resource): iterable
    {
        while (!feof($resource)) {
            $row = fgets($resource);
            $json = json_decode($row, true);
            yield new Transaction(
                (int) $json['bin'],
                new Money((float) $json['amount'], $json['currency'])
            );
        }
    }
}
