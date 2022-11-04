<?php

namespace Walther\Hotwired\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;
use Walther\Hotwired\Server;

final class ServerStartTask extends AbstractTask
{
    public function execute(): bool
    {
        return GeneralUtility::makeInstance(Server::class)->start();
    }
}