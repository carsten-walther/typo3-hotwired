<?php

namespace Walther\HotwiredTodos\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class TodoRepository extends Repository
{
    public function persistAll() : void
    {
        $this->persistenceManager->persistAll();
    }
}
