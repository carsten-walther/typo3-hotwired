<?php

namespace Walther\HotwiredTodos\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Walther\HotwiredTodos\Domain\Model\Todo;
use Walther\HotwiredTodos\Domain\Model\Todolist;
use Walther\HotwiredTodos\Domain\Repository\TodoRepository;
use Walther\HotwiredTodos\Domain\Repository\TodolistRepository;

class TodoController extends ActionController
{
    protected TodolistRepository $todolistRepository;

    protected TodoRepository $todoRepository;

    public function __construct(TodolistRepository $todolistRepository, TodoRepository $todoRepository)
    {
        $this->todolistRepository = $todolistRepository;
        $this->todoRepository = $todoRepository;
    }

    public function newAction(Todolist $todolist): ResponseInterface
    {
        $this->view->assign('todolist', $todolist);
        return $this->htmlResponse();
    }

    public function createAction(Todolist $todolist, Todo $todo): ResponseInterface
    {
        $this->addFlashMessage(sprintf('Todo "%s" created.', $todo->getText()), 'Success');

        $this->todoRepository->add($todo);
        $this->todoRepository->persistAll();

        $todolist->addTodo($todo);
        $this->todolistRepository->update($todolist);
        $this->todolistRepository->persistAll();

        $this->view->assign('todolist', $todolist);
        $this->view->assign('todo', $todo);

        $context = new \ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');
        $socket->connect("ws://typo3-hotwired.dev.local:8080/todo");
        $socket->send("Foobar");

        return $this->responseFactory->createResponse()
            ->withAddedHeader('Content-Type', 'text/vnd.turbo-stream.html; charset=utf-8')
            ->withBody($this->streamFactory->createStream($this->view->render()));

//        $this->redirect('show', 'Todolist', null, [
//            'todolist' => $todolist->getUid()
//        ]);
    }

    public function editAction(Todolist $todolist, Todo $todo): ResponseInterface
    {
        $this->view->assign('todolist', $todolist);
        $this->view->assign('todo', $todo);
        return $this->htmlResponse();
    }

    public function updateAction(Todolist $todolist, Todo $todo): void
    {
        $this->addFlashMessage(sprintf('Todo "%s" updated.', $todo->getText()), 'Success');
        $this->todoRepository->update($todo);

        $this->redirect('show', 'Todolist', null, [
            'todolist' => $todolist->getUid()
        ]);
    }

    public function deleteAction(Todolist $todolist, Todo $todo): void
    {
        $this->addFlashMessage(sprintf('Todo "%s" deleted.', $todo->getText()), 'Success');

        $todolist->removeTodo($todo);
        $this->todolistRepository->update($todolist);
        $this->todolistRepository->persistAll();

        $this->todoRepository->remove($todo);
        $this->todoRepository->persistAll();

        $this->redirect('show', 'Todolist', null, [
            'todolist' => $todolist->getUid()
        ]);
    }
}