<?php

namespace Walther\Hotwired\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Walther\Hotwired\Server\Todos;

final class ServerCommand extends Command
{
    protected function configure(): void
    {
        $this->setHelp('Starts the websocket server');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Todos()
                )
            ),
            8080
        )->run();

        return Command::SUCCESS;
    }
}