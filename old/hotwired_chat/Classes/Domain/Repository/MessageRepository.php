<?php

namespace Walther\Chat\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class MessageRepository extends Repository
{
    public function persistAll() : void
    {
        $this->persistenceManager->persistAll();
    }
}
