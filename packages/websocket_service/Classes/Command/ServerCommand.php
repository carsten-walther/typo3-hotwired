<?php

namespace Walther\WebsocketService\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Http\Router;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Loop;
use React\Socket\SocketServer;
use React\ZMQ\Context;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Walther\WebsocketService\Server\Connection\ConnectionComponentRegistry;

final class ServerCommand extends Command
{
    private array $connectionComponents;

    public function __construct(string $name = null)
    {
        $this->connectionComponents = ConnectionComponentRegistry::getConnectionComponents();
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $identifiers = [];

        foreach ($this->connectionComponents as $key => $value) {
            $identifiers[] = $key;
        }

        $this
            ->setHelp('Starts the websocket server')
            ->addArgument(
                'identifier',
                InputArgument::REQUIRED,
                implode('|', $identifiers)
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $loop = Loop::get();

        if ($this->connectionComponents[$input->getArgument('identifier')]['options']['pusher']) {
            $pusher = GeneralUtility::makeInstance($this->connectionComponents[$input->getArgument('identifier')]['options']['pusher']);

            // Listen for the web server to make a ZeroMQ push after an ajax request
            $context = new Context($loop);
            $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
            $pull->bind('tcp://127.0.0.1:5555'); // Binding to 127.0.0.1 means the only client that can connect is itself
            $pull->on('message', [
                $pusher, $this->connectionComponents[$input->getArgument('identifier')]['options']['onENtry']
            ]);
        }

        $wsServer = new WsServer(ConnectionComponentRegistry::getConnectionComponentInstance($input->getArgument('identifier')));
        $wsServer->enableKeepAlive($loop);

        $routes = new RouteCollection();
        $routes->add(
            $this->connectionComponents[$input->getArgument('identifier')]['options']['port'],
            new Route(
                sprintf('/%s', $this->connectionComponents[$input->getArgument('identifier')]['options']['path']),
                [
                    '_controller' => $wsServer
                ]
            )
        );

        $app = new HttpServer(
            new Router(
                new UrlMatcher(
                    $routes,
                    new RequestContext()
                )
            )
        );

        $socketServer = new SocketServer(
            sprintf('0.0.0.0:%s', $this->connectionComponents[$input->getArgument('identifier')]['options']['port']),
            $pusher,
            $loop
        );

        $ioServer = new IoServer(
            $app,
            $socketServer,
            $loop
        );
        $ioServer->run();

        return Command::SUCCESS;
    }
}