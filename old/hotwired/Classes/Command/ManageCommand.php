<?php

namespace Walther\Hotwired\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Walther\Hotwired\Server\Process;

final class ManageCommand extends Command
{
    private Process $process;

    private array $actions = [
        'start',
        'stop',
        'status'
    ];

    public function __construct(Process $process, string $name = null)
    {
        $this->process = $process;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setHelp('Manages the websocket server')
            ->addArgument(
                'action',
                InputArgument::REQUIRED,
                implode('|', $this->actions)
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        switch ($input->getArgument('action')) {

            case 'start':
                $this->process->start();
                return Command::SUCCESS;

            case 'stop':
                $this->process->stop();
                return Command::SUCCESS;

            case 'status':
                if ($this->process->status()) {
                    $io->info('WebSocket server is running');
                } else {
                    $io->info('WebSocket server is not running');
                }
                return Command::SUCCESS;

            default:
                $io->warning('Invalid action');
                return Command::INVALID;
        }
    }
}