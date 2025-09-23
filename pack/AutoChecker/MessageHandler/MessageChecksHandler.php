<?php

namespace Pack\AutoChecker\MessageHandler;

use Pack\AutoChecker\MessageChecker;
use Pack\AutoChecker\Message\MessageChecks;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
final class MessageChecksHandler
{
    public function __construct(
        private EntityManager $entityManager,
        private MessageChecker $checker,
    )
    {
    }

    public function __invoke(MessageChecks $messengerMessage)
    {
        $em = $this->entityManager;

        $message = $em->getRepository(Message::class)->find($messengerMessage->getMessageId());
        $sender = $em->getRepository(User::class)->find($messengerMessage->getSenderId());
        $recipient = $em->getRepository(User::class)->find($messengerMessage->getRecipientId());
        
        $this->checker->checkDemarchage(
            message: $message,
            sender: $sender,
            recipient: $recipient
        );
    
        $this->checker->checkScamForPoster(
            message: $message,
            sender: $sender,
            recipient: $recipient
        );

        $this->checker->checkWatchList(
            message: $message,
            sender: $sender
        );
    }
}
