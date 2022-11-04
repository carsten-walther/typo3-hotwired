<?php

namespace Walther\Hotwired\Service;

use Psr\Log\LoggerInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class Connection implements MessageComponentInterface
{
    private SplObjectStorage $clients;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->clients = new SplObjectStorage();

        $this->logger->emergency('Websockets Server has been started successfully');
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $this->logger->info("An error has occurred: {$e->getMessage()}");
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        foreach ($this->clients as $client) {
            $client->send($msg);
        }

        if ($this->clients->contains($from)) {
            // ...
        } else {
            $from->close();
        }
    }
}