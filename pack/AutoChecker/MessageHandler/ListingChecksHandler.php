<?php

namespace Pack\AutoChecker\MessageHandler;

use Pack\AutoChecker\ListingChecker;
use Pack\AutoChecker\Message\ListingChecks;
use App\Entity\Listing;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
final class ListingChecksHandler
{
    public function __construct(
        private EntityManager $entityManager,
        private ListingChecker $checker,
    )
    {
    }

    public function __invoke(ListingChecks $message)
    {
        $listing = $this->entityManager->getRepository(Listing::class)->find($message->getListingId());

        $this->checker->checkForKickedoutOwnerTryingBackdoor($listing);

        $this->checker->checkForReturningScammer($listing);
    }
}
