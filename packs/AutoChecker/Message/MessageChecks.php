<?php

namespace Pack\AutoChecker\Message;

use App\Message\Interface\LowPriorityMessageInterface;

final class MessageChecks implements LowPriorityMessageInterface
{
    public function __construct(
        private int $messageId,
        private int $senderId,
        private int $recipientId,
    )
    {
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getRecipientId(): int
    {
        return $this->recipientId;
    }
}
