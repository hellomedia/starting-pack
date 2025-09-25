<?php

namespace Pack\AutoChecker\Mailer;

use App\Entity\Listing;
use App\Mailer\BaseMailer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ListingCheckerMailer extends BaseMailer
{
    public function sendKickedoutOwnerTryingBackdoorAlertEmail(Listing $listing, array $suspiciousItems)
    {
        // $poster = $listing->getPoster();

        // $context = [
        //     'user' => $poster,
        //     'suspicious_items' => $suspiciousItems,
        // ];

        // $email = (new TemplatedEmail())
        //     ->subject('Alerte Proprio Viré essayant de rentrer par l\'arrière')
        //     ->to('nicolas.sauveur@gmail.com')
        //     ->textTemplate('@checker/email/admin/kicked_out_owner_backdoor_alert.txt.twig')
        //     ->context($context)
        // ;

        // $this->send($email);
    }
}
