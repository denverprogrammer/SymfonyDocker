<?php

namespace App\Controller\Tasks;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\DTO\RegisterUser;
use App\Entity\DTO\ConfirmAccount;
use App\Form\EmailForm;
use App\Controller\Traits;

class CreateUserTask extends AbstractController implements MessageHandlerInterface
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Create account and send confirmation email.
     *
     * @return JsonResponse
     */
    public function __invoke(RegisterUser $data): JsonResponse
    {
        $user = $this->getUserRepository()->findUserByEmail($data->getEmail());

        if ($user) {
            return new JsonResponse(
                [
                    'type'   => 'create_user_task',
                    'title'  => 'User error',
                    'errors' => 'User already present.'
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $user = $this->getUserRepository()->create();
        $user->setFirstName($data->getFirstName());
        $user->setLastName($data->getLastName());
        $user->setEmail($data->getEmail());
        $user->setRoles(['ROLE_USER']);
        $user->setConfirmed(false);
        $user->setPassword(md5(random_bytes(255)));
        $user->setToken(md5(random_bytes(255)));
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        $message = new ConfirmAccount();
        $message->setId($user->getId());
        $this->dispatchMessage($message);

        return new JsonResponse(
            [
                'type'   => 'confirm account',
                'title'  => 'A confirmation email has been sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
