<?php

namespace App\Controller\Tasks\Messages;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Mime\Address;
use App\Entity\Constants\Enums\MessageType;
use App\Entity\Constants\Enums\RecipientType;
use App\Entity\Message;
use App\Models\SendMessageModel;
use App\Controller\Traits;

/**
 * Task for sending a email message to a user.
 */
class SendMessageTask extends AbstractController implements MessageSubscriberInterface
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;

    /**
     * Connection to remote email server
     *
     * @var MailerInterface
     */
    protected MailerInterface $mailer;

    /**
     * Initialize class
     *
     * @param MailerInterface $mailer Mail server connection.
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Invoke request
     *
     * @param SendMessageModel $data DTO that contains data for Message entity.
     *
     * @return JsonResponse
     */
    public function __invoke(SendMessageModel $data): JsonResponse
    {
        $repository = $this->getMessageRepository();
        $message = $repository->create();
        $message->setMessageBody($data->getMessageBody());
        $message->setMessageType($data->getMessageType());
        $message->setRecipientType($data->getRecipientType());
        $message->setRecipient($data->getRecipient());
        $message->setTitle($data->getTitle());
        $message->setToken($data->getToken());
        $this->sendMessage($message);
        $this->getEntityManager()->persist($message);
        $this->getEntityManager()->flush();

        return new JsonResponse(
            [
                'type'   => $data->getMessageType(),
                'title'  => 'message sent',
                'errors' => null
            ],
            JsonResponse::HTTP_ACCEPTED
        );
    }

    /**
     * Sends message to mail server
     *
     * @param Message $message Message entity.
     *
     * @return void
     */
    private function sendMessage(Message $message): void
    {
        $email = new TemplatedEmail();
        $email = $email
            ->from(new Address('test@symfonydocker.com'))
            ->to(new Address($message->getRecipient()))
            ->subject($message->getTitle())
            ->html($message->getMessageBody());
        $this->mailer->send($email);
    }

    /**
     * Register task.
     *
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield SendMessageModel::class => [
            'bus'            => 'messenger.bus.default',
            'from_transport' => 'async_queue'
        ];
    }
}
