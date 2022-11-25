<?php

namespace Walther\WebsocketService\Server\Connection;

use Ratchet\ConnectionInterface;
use RuntimeException;
use SplObjectStorage;

abstract class AbstractConnectionComponent implements ConnectionComponentInterface
{
    protected SplObjectStorage $clients;

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
