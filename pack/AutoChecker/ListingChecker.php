<?php

namespace Pack\AutoChecker;

use Pack\AutoChecker\Mailer\AccountCheckerMailer;
use Pack\AutoChecker\Mailer\ListingCheckerMailer;
use App\Entity\Listing;

class ListingChecker
{
    public function __construct(
        private ListingCheckerMailer $mailer,
        private AccountCheckerMailer $accountCheckerMailer,
    ) {
    }

    /**
     * For kicked out owners owners ( not scam )
     * that have real housing (real addresses that do not change much )
     * and come back after being kicked out
     * They should be hellbanned manually when caught and checked.
     */
    public function checkForKickedoutOwnerTryingBackdoor(Listing $listing)
    {
        // $poster = $listing->getPoster();

        // if ($poster->isWhitelisted()) {
        //     return;
        // }

        // if ($suspicious ?? false) {
        //     $this->mailer->sendKickedoutOwnerTryingBackdoorAlertEmail(
        //         $listing,
        //         $suspiciousItems ?? []
        //     );
        // }
    }

    /**
     * When relevant, add obvious identifiers from scammers
     * who seem to keep using the same info.
     * -- like whatstapp phone number --
     */
    public function checkForReturningScammer(Listing $listing): void
    {
        // $poster = $listing->getPoster();

        // $scammerPhoneNumbers = [
        //     '465214552',
        // ];

        // foreach ($scammerPhoneNumbers as $phoneNumber) {
        //     if ($poster->getPhoneNumber()
        //         && stripos($poster->getPhoneNumber(), $phoneNumber) !== false
        //     ) {
        //         $scam = true;
        //         $scammer = $poster;
        //         $suspiciousItems[] = $phoneNumber;
        //     }
        // }

        // if ($scam ?? false) {
        //     $this->accountChecker->hellbanScamWithoutSendingWarningMessages($scammer);

        //     $this->accountCheckerMailer->sendReturningScammerCheckRequestToAdmin($scammer, $suspiciousItems);
        // }
    }
}
