<?php

namespace App\Controller\Tasks\Users;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\ResetPasswordModel;
use App\Models\SendMessageModel;
use App\Controller\Traits;
use App\Entity\Constants\Enums\MessageType;
use App\Entity\Constants\Enums\RecipientType;

/**
 * Task for resetting password and send reset password email.
 */
class ResetPasswordTask extends AbstractController implements MessageSubscriberInterface
{
    use Traits\RepositoryTrait;

    /**
     * Path to email template
     *
     * @var string
     */
    protected const TEMPLATE = 'email/reset_password.html.twig';

    /**
     * Invoke request
     *
     * @param ResetPasswordModel $data DTO that contains data for Message entity.
     *
     * @return JsonResponse
     */
    public function __invoke(ResetPasswordModel $data): JsonResponse
    {
        $user = $this->getUserRepository()->findByEmail($data->getEmail());

        if ($user === null) {
            return new JsonResponse(
                [
                    'type'   => 'reset_password_task',
                    'title'  => 'User error',
                    'errors' => 'User email not found.'
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        }

        $message = new SendMessageModel();
        $message
            ->setMessageType(MessageType::RESET_PASSWORD)
            ->setRecipient($data->getEmail())
            ->setRecipientType(RecipientType::EMAIL)
            ->setTitle('Reset Password')
            ->setToken(md5(random_bytes(255)));
        $message->setMessageBody($this->renderView(self::TEMPLATE, [
            'model'  => $message,
            'entity' => $user
        ]));

        $this->dispatchMessage($message);

        return new JsonResponse(
            [
                'type'   => $message->getMessageType(),
                'title'  => 'task scheduled',
                'errors' => null
            ],
            JsonResponse::HTTP_ACCEPTED
        );
    }

    /**
     * Register task.
     *
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield ResetPasswordModel::class => [
            'bus'            => 'messenger.bus.default',
            'from_transport' => 'async_queue'
        ];
    }
}
