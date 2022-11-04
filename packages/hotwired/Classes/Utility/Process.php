<?php

namespace Walther\Hotwired\Utility;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class Process
{
    protected string $filename = '';

    public bool $alreadyRunning = false;

    public int $processId = 0;

    public function __construct()
    {
        $this->filename = (Environment::getVarPath() . '/websocket.pid');

        if (file_exists($this->filename)) {

            $this->processId = (int)trim(GeneralUtility::getURL($this->filename));
            $this->alreadyRunning = posix_kill($this->processId, 0);
        }

        if (!$this->alreadyRunning) {
            $this->processId = getmypid();
            GeneralUtility::writeFile($this->filename, $this->processId);
        }
    }

    public function __destruct()
    {
        if (!$this->alreadyRunning) {
            unlink($this->filename);
        }
    }
}