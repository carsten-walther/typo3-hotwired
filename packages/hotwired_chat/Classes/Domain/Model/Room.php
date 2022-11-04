<?php

namespace Walther\Chat\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation;

class Room extends AbstractEntity
{
    /**
     * @var string
     * @Annotation\Validate("NotEmpty")
     */
    protected string $name = '';

    /**
     * @var ObjectStorage<Todo>|null
     * @Annotation\ORM\Lazy
     * @Annotation\ORM\Cascade("remove")
     */
    protected ?ObjectStorage $messages = null;

    public function __construct()
    {
        $this->initializeObject();
    }

    public function initializeObject(): void
    {
        $this->messages = $this->messages ?: new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addMessage(Todo $message): void
    {
        $this->messages->attach($message);
    }

    public function removeMessage(Todo $messageToRemove): void
    {
        $this->messages->detach($messageToRemove);
    }

    public function getMessages(): ?ObjectStorage
    {
        return $this->messages;
    }

    public function setMessages(ObjectStorage $messages): void
    {
        $this->messages = $messages;
    }
}
