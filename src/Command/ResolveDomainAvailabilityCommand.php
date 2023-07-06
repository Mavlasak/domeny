<?php declare(strict_types=1);

namespace App\Command;

use App\Model\Domain\DomainService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:resolve-domain-availability')]
class ResolveDomainAvailabilityCommand extends Command
{
    public function __construct(
        private readonly DomainService $domainService,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('length', InputArgument::REQUIRED, 'Domain letter count');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $length = \intval($input->getArgument('length'));
        $this->domainService->resolveAndSaveDomainsByLength($length);

        return Command::SUCCESS;
    }
}
