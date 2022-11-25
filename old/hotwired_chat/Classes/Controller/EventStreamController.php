<?php

namespace Walther\Chat\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Walther\Chat\Domain\Model\Todo;
use Walther\Chat\Domain\Repository\MessageRepository;

class EventStreamController extends ActionController
{
    protected MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function indexAction(): void
    {
        /** @var Todo $message */
        $message = $this->messageRepository->findFirstNotBroadcasted();

        if ($message) {

            $data = sprintf(
                '<turbo-stream action="append" target="messages"><template><div id="message-%s"><p><time datetime="%s">%s</time> %s</p></div></template></turbo-stream>',
                $message->getUid(),
                $message->getCrdate()->format('Y-m-d\TH:i:sY-m-d\TH:i:s'),
                $message->getCrdate()->format('d.m.Y H:i'),
                $message->getText()
            );

            $message->setBroadcasted(true);
            $this->messageRepository->update($message);
            $this->messageRepository->persistAll();

            $this->send($message->getUid(), $data);
        }

        $this->send(0, '');
    }

    private function send(string $id, string $data, string $event = '', int $retry = 1000): void
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        echo "id: $id" . PHP_EOL;
        echo "data: $data" . PHP_EOL;
        echo "event: $event" . PHP_EOL;
        echo "retry: $retry" . PHP_EOL;
        echo PHP_EOL;

        flush();

        exit;
    }
}