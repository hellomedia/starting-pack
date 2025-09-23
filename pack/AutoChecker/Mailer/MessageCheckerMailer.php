<?php

namespace Pack\AutoChecker\Mailer;

use App\Entity\Message;
use App\Entity\User;
use App\Mailer\BaseMailer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MessageCheckerMailer extends BaseMailer
{
    public function sendAdminDemarchageAlert(User $sender, Message $message)
    {
        $context = [
            'user' => $sender,
            'message' => $message->getContent(),
            'conversation' => $message->getConversation(),
        ];

        $email = (new TemplatedEmail())
            ->subject('Alerte démarchage !')
            ->to('nicolas.sauveur@gmail.com')
            ->textTemplate('@checker/email/admin/demarchage_message_alert.txt.twig')
            ->context($context)
        ;

        $this->send($email);
    }

    public function sendAdminScamForPosterAlert(User $sender, Message $message)
    {
        $context = [
            'user' => $sender,
            'message' => $message->getContent(),
            'conversation' => $message->getConversation(),
        ];

        $email = (new TemplatedEmail())
            ->subject('Alerte scam for poster !')
            ->to('nicolas.sauveur@gmail.com')
            ->textTemplate('@checker/email/admin/scam_for_poster_alert.txt.twig')
            ->context($context)
        ;

        $this->send($email);
    }

    public function sendAdminWatchistNotification(User $sender, Message $message)
    {
        $context = [
            'user' => $sender,
            'message' => $message->getContent(),
            'conversation' => $message->getConversation(),
        ];

        $email = (new TemplatedEmail())
            ->subject('A user on Watchlist has sent a message')
            ->to('nicolas.sauveur@gmail.com')
            ->textTemplate('@checker/email/admin/watchlist_notification.txt.twig')
            ->context($context)
        ;

        $this->send($email, from: 'notification');
    }
}
