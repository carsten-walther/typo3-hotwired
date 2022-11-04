<?php

namespace Walther\HotwiredTodos\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class TodolistRepository extends Repository
{
    public function persistAll() : void
    {
        $this->persistenceManager->persistAll();
    }
}
