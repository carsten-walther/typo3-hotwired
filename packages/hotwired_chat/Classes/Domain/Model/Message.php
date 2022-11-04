<?php

namespace Walther\Chat\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation;

class Message extends AbstractEntity
{
    /**
     * @Annotation\Validate("NotEmpty")
     */
    protected string $text = '';

    /**
     * @Annotation\Validate("NotEmpty")
     */
    protected $username = '';

    protected ?\DateTime $crdate = null;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getCrdate(): ?\DateTime
    {
        return $this->crdate;
    }

    public function setCrdate(?\DateTime $crdate): void
    {
        $this->crdate = $crdate;
    }
}
