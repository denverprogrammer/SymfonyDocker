<?php

namespace App\Controller\Tasks;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\DTO\RegisterUser;
use App\Form\EmailForm;
use App\Controller\Traits;

class SendAccountEmailTask extends AbstractController implements MessageHandlerInterface
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Create account and send confirmation email.
     *
     * @return JsonResponse
     */
    public function __invoke(RegisterUser $data): JsonResponse {
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
