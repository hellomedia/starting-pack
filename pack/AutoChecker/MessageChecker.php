<?php

namespace Pack\AutoChecker;

use Pack\AutoChecker\Mailer\MessageCheckerMailer;
use App\Entity\Message;
use App\Entity\User;

class MessageChecker
{
    public function __construct(
        private MessageCheckerMailer $mailer,
    )
    {
    }

    public function checkDemarchage(Message $message, User $sender, User $recipient): void
    {
        $suspicious = $this->isSuspiciousDemarchage(
            message: $message,
            sender: $sender,
            recipient: $recipient
        );

        if ($suspicious) {
            $this->mailer->sendAdminDemarchageAlert(
                sender: $sender,
                message: $message,
            );
        }
    }

    public function checkScamForPoster(Message $message, User $sender, User $recipient): void
    {
        $suspicious = $this->isSuspiciousScamForPosters(
            message: $message,
            sender: $sender,
            recipient: $recipient
        );

        if ($suspicious) {
            $this->mailer->sendAdminScamForPosterAlert(
                sender: $sender,
                message: $message,
            );
        }
    }

    public function checkWatchList(Message $message, User $sender): void
    {
        if ($sender->isWatchlist()) {
            $this->mailer->sendAdminWatchistNotification(
                sender: $sender,
                message: $message,
            );
        }
    }

    /**
     * If user is hellbanned, block a new conversation unless recipient is the
     * hellbaned user.
     *
     * NB: This only happens for a *new* conversation.
     * When a hellbanned user replies to an *existing* conversation
     * we do not touch the metadata for the recipient.
     * The idea is to leave an *existing* conversation visible with proper
     * warnings, depending on the use case (demarchage, scam, ...)
     */
    // public function blockNewConversationFromHellbannedUser(User $sender, User $recipient, ConversationMetadata $recipientMetadata): void
    // {
    //     if ($sender->isHellbanned() && $sender != $recipient) {
    //         $recipientMetadata->setState(ConversationMetadata::STATE_REMOVED);
    //     }
    // }

    /**
     * Any notification for a new message from a hellbanned user is blocked.
     *
     * In some cases (existing conversation), the message itself will be
     * persisted (which helps feeding kotcop) but will not reach the recipient
     * since proper warnings will be shown in the message section.
     */
    // public function blockHellbannedMessageNotification(User $sender): bool
    // {
    //     if ($sender->isHellbanned()) {
    //         return true;
    //     }

    //     return false;
    // }

    public function isSuspiciousDemarchage(Message $message, User $sender, User $recipient): bool
    {
        if ($sender->isSafe() || $sender->isWhitelisted()) {
            return false;
        }

        $recipientIsListingPoster = ($recipient == $message->getConversation()->getPoster());

        if (false == $recipientIsListingPoster) {
            return false;
        }

        $suspicious = false;

        $suspiciousWords = [];

        $messageContent = $message->getContent();

        foreach ($suspiciousWords as $suspiciousWord) {
            if (stripos($messageContent, $suspiciousWord) !== false) {
                $suspicious = true;
                break;
            }
        }

        return $suspicious;
    }

    public function isSuspiciousScamForPosters(Message $message, User $sender, User $recipient): bool
    {
        if ($sender->isSafe() || $sender->isWhitelisted()) {
            return false;
        }

        $recipientIsListingPoster = ($recipient == $message->getConversation()->getPoster());

        if (false == $recipientIsListingPoster) {
            return false;
        }

        $suspicious = false;

        $suspiciousWords = [];

        $messageContent = $message->getContent();

        foreach ($suspiciousWords as $suspiciousWord) {
            if (stripos($messageContent, $suspiciousWord) !== false) {
                $suspicious = true;
                break;
            }
        }

        return $suspicious;
    }
}
