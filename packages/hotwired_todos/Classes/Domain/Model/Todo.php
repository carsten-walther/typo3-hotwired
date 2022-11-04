<?php

namespace Walther\HotwiredTodos\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation;

class Todo extends AbstractEntity
{
    /**
     * @Annotation\Validate("NotEmpty")
     */
    protected string $text = '';

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
