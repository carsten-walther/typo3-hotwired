<?php

namespace Walther\HotwiredTodos\Server\Connection;

use Ratchet\ConnectionInterface;
use Walther\WebsocketService\Server\Connection\AbstractConnectionComponent;

class Todos extends AbstractConnectionComponent
{
    public function onMessage(ConnectionInterface $from, $msg): void
    {
        foreach ($this->clients as $client) {
            $client->send($msg);
        }

        if ($this->clients->contains($from)) {
            // ...
            $from->send('<turbo-frame id="edit-todo-foo"><div id="todo-foo">
    <p>
        <strong>Foobar</strong>
    </p>
</div></turbo-frame>');
        } else {
            $from->close();
        }
    }
}