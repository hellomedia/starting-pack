<?php

namespace Pack\AutoChecker\Message;

use App\Message\Interface\LowPriorityMessageInterface;

final class ListingChecks implements LowPriorityMessageInterface
{
    public function __construct(
        private int $listingId,
    )
    {
    }

    public function getListingId(): int
    {
        return $this->listingId;
    }
}
