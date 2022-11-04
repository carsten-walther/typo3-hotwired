<?php

namespace Walther\Hotwired;

use Exception;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class Server
{
    protected string $filename = '';
    public int $processId = 0;

    public function __construct()
    {
        $this->filename = (Environment::getVarPath() . '/websocket.pid');

        $this->definePid();

        if (!$this->isRunning() && file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    private function definePid(): void
    {
        if (file_exists($this->filename)) {
            $processId = (int)trim(GeneralUtility::getURL($this->filename));
            if (($processId !== 0) && self::process($processId, 'detect')) {
                $this->processId = $processId;
                return;
            }
        }

        $processId = (int)shell_exec(
            "ps ax | grep 'vendor/bin/typo3 hotwired:server:run' | grep -v grep | awk '{print $1}' | head -1"
        );

        if ($processId !== 0) {
            $this->processId = $processId;
            GeneralUtility::writeFile($this->filename, $this->processId);
        }
    }

    public function isRunning(): bool
    {
        return ($this->processId !== 0);
    }

    public function start(): bool
    {
        if ($this->isRunning()) {
            return true;
        }

        $command = [
            str_replace('-cgi', '', PHP_BINARY),
            Environment::getProjectPath() . '/vendor/bin/typo3',
            'hotwired:server:run',
            '>',
            '/dev/null',
            '2>/dev/null',
            '&'
        ];

        shell_exec(implode(' ', $command));

        return true;
    }

    public function stop(): ?bool
    {
        if (!$this->isRunning()) {
            return null;
        }

        self::process($this->processId, 'kill');

        $this->processId = 0;

        if (file_exists($this->filename)) {
            unlink($this->filename);
        }

        return true;
    }

    public static function process(int $processId, string $action): bool
    {
        return match ($action) {
            'detect' => posix_kill($processId, 0),
            'kill' => posix_kill($processId, 9),
            default => throw new Exception('Action is undefined!'),
        };
    }
}