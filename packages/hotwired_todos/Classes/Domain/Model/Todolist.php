<?php

namespace Walther\HotwiredTodos\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation;

class Todolist extends AbstractEntity
{
    /**
     * @Annotation\Validate("NotEmpty")
     */
    protected string $name = '';

    /**
     * @var ObjectStorage<Todo>|null
     * @Annotation\ORM\Lazy
     * @Annotation\ORM\Cascade("remove")
     */
    protected ?ObjectStorage $todos = null;

    public function __construct()
    {
        $this->initializeObject();
    }

    public function initializeObject(): void
    {
        $this->todos = $this->todos ?: new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addTodo(Todo $todo): void
    {
        $this->todos->attach($todo);
    }

    public function removeTodo(Todo $todoToRemove): void
    {
        $this->todos->detach($todoToRemove);
    }

    public function getTodos(): ?ObjectStorage
    {
        return $this->todos;
    }

    public function setTodos(ObjectStorage $todos): void
    {
        $this->todos = $todos;
    }
}
