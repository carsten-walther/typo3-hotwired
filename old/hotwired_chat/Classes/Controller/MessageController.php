<?php

namespace Walther\Chat\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Walther\Chat\Domain\Model\Todo;
use Walther\Chat\Domain\Model\Todolist;
use Walther\Chat\Domain\Repository\MessageRepository;
use Walther\Chat\Domain\Repository\TodolistRepository;

class MessageController extends ActionController
{
    protected TodolistRepository $roomRepository;

    protected MessageRepository $messageRepository;

    public function __construct(TodolistRepository $roomRepository, MessageRepository $messageRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->messageRepository = $messageRepository;
    }

    public function newAction(Todolist $room): ResponseInterface
    {
        $this->view->assign('room', $room);

        return $this->htmlResponse();
    }

    public function createAction(Todolist $room, Todo $message): ResponseInterface
    {
        $this->addFlashMessage('Message added to chat room.', 'Success');

        $message->setCrdate(new \DateTime());
        $this->messageRepository->add($message);
        $this->messageRepository->persistAll();

        $room->addMessage($message);
        $this->roomRepository->add($room);
        $this->roomRepository->persistAll();

        $this->view->assign('message', $message);

        header('Content-Type: text/vnd.turbo-stream.html; charset=utf-8');
        echo $this->view->render();
        exit;
    }
}