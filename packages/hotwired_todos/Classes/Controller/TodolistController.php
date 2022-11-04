<?php

namespace Walther\HotwiredTodos\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Walther\HotwiredTodos\Domain\Model\Todolist;
use Walther\HotwiredTodos\Domain\Repository\TodolistRepository;

class TodolistController extends ActionController
{
    protected TodolistRepository $todolistRepository;

    public function __construct(TodolistRepository $todolistRepository)
    {
        $this->todolistRepository = $todolistRepository;
    }

    public function indexAction(): void
    {
        $this->redirect('list');
    }

    public function listAction(): ResponseInterface
    {
        $this->view->assign('todolists', $this->todolistRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Todolist $todolist): ResponseInterface
    {
        $this->view->assign('todolist', $todolist);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(Todolist $todolist): void
    {
        $this->addFlashMessage(sprintf('Todolist "%s" created.', $todolist->getName()), 'Success');
        $this->todolistRepository->add($todolist);
        $this->redirect('list');
    }

    public function editAction(Todolist $todolist): ResponseInterface
    {
        $this->view->assign('todolist', $todolist);
        return $this->htmlResponse();
    }

    public function updateAction(Todolist $todolist): void
    {
        $this->addFlashMessage(sprintf('Todolist "%s" updated.', $todolist->getName()), 'Success');
        $this->todolistRepository->update($todolist);
        $this->redirect('show', 'Todolist', null, [
            'todolist' => $todolist->getUid()
        ]);
    }

    public function deleteAction(Todolist $todolist): void
    {
        $this->addFlashMessage(sprintf('Todolist "%s" deleted.', $todolist->getName()), 'Success');
        $this->todolistRepository->remove($todolist);
        $this->redirect('list');
    }
}