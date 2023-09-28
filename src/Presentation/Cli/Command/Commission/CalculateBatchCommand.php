<?php

declare(strict_types = 1);

namespace Presentation\Cli\Command\Commission;

use Application\Commission\ValueObject\Money;
use Application\Commission\ValueObject\Transaction;
use Application\Commission\Service\CalculateBatchService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
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
            ->setDescription('Calculate commission');
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {

        $string =
            '{"bin":"45717360","amount":"100","currency":"EUR"}
{"bin":"516793","amount":"50.00","currency":"USD"}
{"bin":"45417360","amount":"10000.00","currency":"JPY"}
{"bin":"41417360","amount":"130.00","currency":"USD"}
{"bin":"4745030","amount":"2000.00","currency":"GBP"}';

        $resource = fopen('php://memory', 'r+');
        fwrite($resource, $string);
        rewind($resource);



        $commissionList = $this->calculateBatchService->calculateBatch($this->getBatchIterator($resource));
        foreach ($commissionList as $commission) {
            $output->writeln((string) $commission->getMoney()->getAmount());
        }

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
