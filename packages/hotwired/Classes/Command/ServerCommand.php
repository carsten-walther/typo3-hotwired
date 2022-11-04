<?php

namespace Walther\Hotwired\Command;

use Psr\Log\LoggerInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Walther\Hotwired\Service\Connection;
use Walther\Hotwired\Utility\Process;

final class ServerCommand extends Command
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, string $name = null)
    {
        $this->logger = $logger;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setHelp('Runs the websocket server');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process();

        if (!$process->alreadyRunning) {
            IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new Connection($this->logger)
                    )
                ),
                8080
            )->run();
        } else {
            $this->logger->notice('Attempting to start WebSockets Server while it is already running');
        }

        return Command::SUCCESS;
    }
}