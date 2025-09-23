<?php

namespace Pack\AutoChecker\MessageHandler;

use Pack\AutoChecker\AccountChecker;
use Pack\AutoChecker\Message\AccountChecks;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
final class AccountChecksHandler
{
    public function __construct(
        private EntityManager $entityManager,
        private AccountChecker $checker,
    )
    {
    }

    public function __invoke(AccountChecks $message)
    {
        $user = $this->entityManager->getRepository(User::class)->find($message->getUserId());

        $this->checker->hellbanObviousDemarchageAccounts(
            user: $user,
            ip: $message->getIp(),
        );
    }
}
