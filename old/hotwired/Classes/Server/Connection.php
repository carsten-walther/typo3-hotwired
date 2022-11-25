<?php

namespace Walther\Hotwired\Server;

use Psr\Log\LoggerInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use RuntimeException;
use SplObjectStorage;

class Connection implements MessageComponentInterface
{
    private SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
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
        $conn->close();

        throw new RuntimeException(sprintf('An error has occurred: %s', $e->getMessage()));
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