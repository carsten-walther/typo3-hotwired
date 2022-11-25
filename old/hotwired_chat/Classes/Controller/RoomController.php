<?php

namespace Walther\Chat\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Walther\Chat\Domain\Model\Todolist;
use Walther\Chat\Domain\Repository\TodolistRepository;

class RoomController extends ActionController
{
    protected TodolistRepository $roomRepository;

    public function __construct(TodolistRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function indexAction(): void
    {
        $this->redirect('list');
    }

    public function listAction(): ResponseInterface
    {
        $rooms = $this->roomRepository->findAll();

        $this->view->assign('rooms', $rooms);

        return $this->htmlResponse();
    }

    public function showAction(Todolist $room): ResponseInterface
    {
        $this->view->assign('room', $room);

        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(Todolist $room): void
    {
        $this->addFlashMessage('Message room created.', 'Success');

        $this->roomRepository->add($room);
        $this->roomRepository->persistAll();

        $this->redirect('show', 'Room', null, ['room' => $room->getUid()]);
    }

    public function editAction(Todolist $room): ResponseInterface
    {
        $this->view->assign('room', $room);

        return $this->htmlResponse();
    }

    public function updateAction(Todolist $room): void
    {
        $this->addFlashMessage('Message room updated.', 'Success');

        $this->roomRepository->update($room);
        $this->roomRepository->persistAll();

        $this->redirect('show', 'Room', null, ['room' => $room->getUid()]);
    }

    public function deleteAction(Todolist $room): void
    {
        $this->addFlashMessage('Message room deleted.', 'Success');

        $this->roomRepository->remove($room);

        $this->redirect('list');
    }
}