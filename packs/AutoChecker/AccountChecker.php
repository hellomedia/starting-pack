<?php

namespace Pack\AutoChecker;

use Pack\AutoChecker\Mailer\AccountCheckerMailer;
use App\Entity\Contact;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class AccountChecker
{
    public function __construct(
        private EntityManager $entityManager,
        private AccountCheckerMailer $mailer
    ) {
    }

    public function hellbanDemarchage(User $user): User
    {
        // $user->setHellbanned(true);
        // $user->setDemarchage(true);

        // if ($user->getHellbannedAt() == null) {
        //     // avoid resetting hellbanned_at if already hellbanned
        //     // orginal helbanned date is the one to keep.
        //     $user->setHellbannedAt();
        // }

        // $user->addAdminComment('Account Hellbanned - Demarchage');

        // $this->entityManager->flush();

        return $user;
    }

    public function hellbanScamAndSendWarningMessages(User $scammer): iterable
    {
        // $this->_hellbanScam($scammer);

        // $scammer->addAdminComment('Account Hellbanned - Scam');

        // $this->entityManager->flush();

        // $contacts = $this->entityManager->getRepository(Message::class)
        //     ->findContactsOfScamForStudents($scammer);

        $warned = [];
        // foreach ($contacts as $contact) {
        //     $this->mailer->sendScamWarningEmail($scammer, $contact);
        //     $warned[] = $contact['email'];
        // }

        // $phoneNumberContacts = $this->entityManager->getRepository(Contact::class)
        //     ->findPhoneNumberViewsOfScam($scammer);

        // foreach ($phoneNumberContacts as $contact) {
        //     if (in_array($contact['email'], $warned) == false) {
        //         // With this test, we might miss a warning (for a phone contact) to an email
        //         // that was already warned (for a message contact) for a *different* listing,
        //         // in case the scammer has posted multiple listings.
        //         // It is highly unlikely to happen (scammers post 1 listing per account).
        //         $this->mailer->sendScamWarningEmail($scammer, $contact);
        //         $warned[] = $contact['email'];
        //     }
        // }

        return $warned;
    }

    public function hellbanScamWithoutSendingWarningMessages(User $scammer): void
    {
        // $this->_hellbanScam($scammer);

        // $scammer->addAdminComment('[Kotcop] Account auto Hellbanned - Scam. No warnings sent, waiting for manual check.');

        // $this->entityManager->flush();
    }

    public function hellbanScamForPostersAndSendWarningMessages(User $scammer): iterable
    {
        // $this->_hellbanScam($scammer);

        // $scammer->addAdminComment('Account Hellbanned - Scam for posters');

        // $this->entityManager->flush();

        // // if he is already hellbanned, we don't want to send a warning
        // // message to users who never received the demarchage messages in the first place
        // // ==> Query only accounts for conversations that are not in STATE_REMOVED
        // // -- the state hellbaning puts new messages in.
        // $contacts = $this->entityManager->getRepository(Message::class)
        //     ->findContactsOfScamForPosters($scammer);

        $warned = [];
        // foreach ($contacts as $contact) {
        //     $this->mailer->sendScamforPostersWarningEmail($scammer, $contact);
        //     $warned[] = $contact['email'];
        // }

        return $warned;
    }

    public function justHellban(User $user): User
    {
        // $user->setHellbanned(true);

        // if ($user->getHellbannedAt() == null) {
        //     // avoid resetting hellbanned_at if already hellbanned
        //     // orginal helbanned date is the one to keep.
        //     $user->setHellbannedAt();
        // }

        // $user->addAdminComment('Account "Just" Hellbanned');

        // $this->entityManager->flush();

        return $user;
    }

    public function restoreUserMarkedAsScamByMistake(User $user): void
    {
        // $user->setHellbanned(false);
        // $user->resetHellbannedAt();

        // $user->setScam(false);

        // $user->setKotcopScore(null);

        // $user->addAdminComment('Account restored after marked as scam by mistake');

        // $this->entityManager->flush();
    }

    public function hellbanObviousDemarchageAccounts(User $user, ?string $ip): void
    {
        // Dealing with *obvious* demarchage
        // which requires quick action before watchtower has the time to kick in
        // Spotahome does this with a new account every morning
        // to apparently grab phone numbers for a few minutes after registration
        // every day, and registers another user the next day
        $verySuspiciousEmails = [

        ];

        $verySuspiciousIps = [

        ];

        // $busted = false;

        // foreach ($verySuspiciousEmails as $verySuspiciousEmail) {
        //     if (str_contains((string) $user->getEmail(), $verySuspiciousEmail)) {
        //         $busted = true;
        //     }
        // }

        // foreach ($verySuspiciousIps as $verySuspiciousIp) {
        //     if (str_contains($ip, $verySuspiciousIp)) {
        //         $busted = true;
        //     }
        // }

        // if ($busted) {

        //     $this->hellbanDemarchage($user);

        //     $user->addAdminComment('Account auto hellbanned at registration');

        //     $this->entityManager->flush();

        //     $this->mailer->sendDemarchageAlertToAdmin($user);
        // }
    }

    private function _hellbanScam(User $user): User
    {
        // if ($user->isHellbanned() == false) {
        //     // avoid resetting hellbanned_at if already hellbanned
        //     // orginal helbanned date is the one to keep.
        //     $user->setHellbanned(true);
        //     $user->setHellbannedAt();
        // }

        // $user->setScam(true);

        // $this->entityManager->flush();

        return $user;
    }
}
