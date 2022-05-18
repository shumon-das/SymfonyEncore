<?php

namespace App\MessageHandler;

use App\Message\PracticeMail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;

final class PracticeMailHandler implements MessageHandlerInterface
{
    protected MailerInterface $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(PracticeMail $message)
    {
        $data = $message->getMailData();
        $email = (new TemplatedEmail())
            ->from(new Address($data['from'], $data['fromName']))
            ->to($data['to'])
            ->subject($data['subject'])
            ->htmlTemplate($data['template'])
            ->context([
                'resetToken' =>$data['context']
            ])
        ;
        $this->mailer->send($email);
    }
}
