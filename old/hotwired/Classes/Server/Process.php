<?php

namespace Walther\Hotwired\Server;

final class Process
{
    public function getProcessId(): ?int
    {
        $command = "ps ax | grep 'vendor/bin/typo3 hotwired:server:run' | grep -v grep | grep -v ps | awk '{print $1}' | head -1";
        return (int)shell_exec($command);
    }

    public function start(): void
    {
        if (!$this->getProcessId()) {
            $command = "vendor/bin/typo3 hotwired:server:run > /dev/null 2>/dev/null &";
            shell_exec($command);
        }
    }

    public function stop(): void
    {
        if ($processId = $this->getProcessId()) {
            posix_kill($processId, 9);
        }
    }

    public function status(): bool
    {
        return (bool)$this->getProcessId();
    }
}