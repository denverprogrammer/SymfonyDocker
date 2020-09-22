<?php

namespace App\Controller\Tasks\Users;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\CreateAccountModel;
use App\Models\SendMessageModel;
use App\Controller\Traits;
use App\Entity\Constants\Enums\MessageType;
use App\Entity\Constants\Enums\RecipientType;

class CreateAccountTask extends AbstractController implements MessageSubscriberInterface
{
    use Traits\RepositoryTrait;

    const TEMPLATE = 'email/create_account.html.twig';

    /**
     * Create account and send confirmation email.
     * 
     * @param CreateAccountModel $data
     *
     * @return JsonResponse
     */
    public function __invoke(CreateAccountModel $data): JsonResponse
    {
        $user = $this->getUserRepository()->findByEmail($data->getEmail());

        if ($user) {
            return new JsonResponse(
                [
                    'type'   => 'create_account_task',
                    'title'  => 'User error',
                    'errors' => 'User email already present.'
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $user = $this->getUserRepository()->findByUsername($data->getUsername());

        if ($user) {
            return new JsonResponse(
                [
                    'type'   => 'create_account_task',
                    'title'  => 'User error',
                    'errors' => 'Username already present.'
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $user = $this->getUserRepository()->create();
        $user->setEmail($data->getEmail());
        $user->setUserName($data->getUsername());
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(md5(random_bytes(255)));
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        $message = new SendMessageModel();
        $message
            ->setMessageType(MessageType::CREATE_ACCOUNT)
            ->setRecipient($data->getEmail())
            ->setRecipientType(RecipientType::EMAIL)
            ->setTitle('Confirm your account')
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

    public static function getHandledMessages(): iterable
    {
        yield CreateAccountModel::class => [
            'bus'            => 'messenger.bus.default',
            'from_transport' => 'async_queue'
        ];
    }
}
