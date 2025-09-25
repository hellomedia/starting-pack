<?php

namespace Pack\AutoChecker\Message;

use App\Message\Interface\LowPriorityMessageInterface;

final class AccountChecks implements LowPriorityMessageInterface
{
    public function __construct(
        private int $userId,
        private string $ip,
    )
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
