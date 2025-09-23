<?php

namespace Pack\AutoChecker\Mailer;

use App\Entity\User;
use App\Mailer\BaseMailer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\InputBag;

class AccountCheckerMailer extends BaseMailer
{
    /**
     * Send Scam warning Email
     * Triggered from Control Room ==> must handle language and site.
     */
    public function sendScamWarningEmail(User $scammer, array $contact)
    {
        $recipientEmail = $contact['email'];
        $recipientName = $contact['name'];
        $reference = $contact['reference'];
        $fullReference = $reference;

        // $listingUrlFr = $this->generateAbsoluteUrl(
        //     route: 'listing_show_alternate',
        //     parameters: ['reference' => $reference, '_locale' => 'fr'],
        // );
        // $listingUrlEn = $this->generateAbsoluteUrl(
        //     route: 'listing_show_alternate',
        //     parameters: ['reference' => $reference, '_locale' => 'en'],
        // );
        // $scamWarningUrlFr = $this->generateAbsoluteUrl(
        //     route: 'conversation_distance_booking_safety',
        //     parameters: ['_locale' => 'fr'],
        // );
        // $scamWarningUrlEn = $this->generateAbsoluteUrl(
        //     route: 'conversation_distance_booking_safety',
        //     parameters: ['_locale' => 'en'],
        // );

        $context = [
            // 'name' => $recipientName,
            // 'reference' => $reference,
            // 'fullReference' => $fullReference,
            // 'listingUrlFr' => $listingUrlFr,
            // 'listingUrlEn' => $listingUrlEn,
            // 'scamWarningUrlFr' => $scamWarningUrlFr,
            // 'scamWarningUrlEn' => $scamWarningUrlEn,
        ];

        $email = (new TemplatedEmail())
            ->subject('Warning : annonce '. $fullReference . ' ' . 'frauduleuse')
            ->to($recipientEmail)
            ->bcc('nicolas.sauveur@gmail.com')
            ->replyTo('support@' . $this->getDomain())
            ->htmlTemplate('@checker/email/scam_warning.html.twig')
            ->textTemplate('@checker/email/scam_warning.txt.twig')
            ->context($context)
        ;

        $this->send($email);
    }

    /**
     * Send Scam warning ***CORRECTION*** Email.
     *
     * Useful when an automated scam warning email was sent by mistake
     * (super rare hopefully)
     *
     * Triggered from Control Room ==> must handle language and site
     */
    public function sendScamWarningCorrectionEmail(User $poster, array $contact)
    {
        $recipientEmail = $contact['email'];
        $recipientName = $contact['name'];
        $reference = $contact['reference'];
        $fullReference = $reference;

        // $listingUrlFr = $this->generateAbsoluteUrl(
        //     route: 'listing_show_alternate',
        //     parameters: ['reference' => $reference, '_locale' => 'fr'],
        // );
        // $listingUrlEn = $this->generateAbsoluteUrl(
        //     route: 'listing_show_alternate',
        //     parameters: ['reference' => $reference, '_locale' => 'en'],
        // );

        $context = [
            // 'name' => $recipientName,
            // 'reference' => $reference,
            // 'fullReference' => $fullReference,
            // 'listingUrlFr' => $listingUrlFr,
            // 'listingUrlEn' => $listingUrlEn,
        ];

        $email = (new TemplatedEmail())
            ->subject('CORRECTION: Warning : annonce '. $fullReference . ' ' . ' frauduleuse')
            ->to($recipientEmail)
            ->bcc('nicolas.sauveur@gmail.com')
            ->replyTo('support@' . $this->getDomain())
            ->htmlTemplate('@checker/email/scam_waning_correction.html.twig')
            ->textTemplate('@checker/email/scam_waning_correction.txt.twig')
            ->context($context)
        ;

        $this->send($email);
    }

    /**
     * Send Scam warning Email
     * Triggered from Control Room ==> must handle language and site.
     */
    public function sendScamforPostersWarningEmail(User $scammer, array $contact)
    {
        $recipientEmail = $contact['email'];
        $recipientName = $contact['name'];
        $conversationId = $contact['conversationId'];
        $accountLanguage = $contact['accountLanguage'];
        $scammerName = (string) $scammer;

        // $conversationUrl = $this->generateAbsoluteUrl(
        //     route: 'conversation_show',
        //     parameters: ['id' => $conversationId, 'folder' => 'inbox'],
        // );

        $context = [
        //     'name' => $recipientName,
        //     'conversationUrl' => $conversationUrl,
        //     'language' => $accountLanguage,
        //     'scammerName' => $scammerName,
        ];

        $email = (new TemplatedEmail())
            ->subject('Warning : contact frauduleux')
            ->to($recipientEmail)
            ->bcc('nicolas.sauveur@gmail.com')
            ->replyTo('support@' . $this->getDomain())
            ->htmlTemplate('@checker/email/scam_for_posters_warning.html.twig')
            ->context($context)
        ;

        $this->send($email);
    }

    public function sendDemarchageAlertToAdmin(User $user)
    {
        $context = [
            'user' => $user,
        ];

        $email = (new TemplatedEmail())
            ->subject('Alerte démarchage')
            ->to('nicolas.sauveur@gmail.com')
            ->textTemplate('@checker/email/admin/demarchage_account_alert.txt.twig')
            ->context($context)
        ;

        $this->send($email);
    }

    public function sendReturningScammerCheckRequestToAdmin(User $user, array $suspiciousItems)
    {
        $context = [
            'user' => $user,
            'suspicious_items' => $suspiciousItems,
        ];

        $email = (new TemplatedEmail())
            ->subject('Suspicious Account (auto-hellbanned) : Check requested')
            ->to('nicolas.sauveur@gmail.com')
            ->textTemplate('@checker/email/admin/returning_scammer_check_request.txt.twig')
            ->context($context);

        $this->send($email);
    }
}
