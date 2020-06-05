<?php

namespace App\Controller\Tasks;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Entity\DTO\RegisterUser;
use App\Form\EmailForm;

class SendPasswordEmailTask extends AbstractController implements MessageHandlerInterface
{
    /**
     * Send reset password email.
     *
     * @return JsonResponse
     */
    public function __invoke(
        UserPasswordEncoderInterface $encoder,
        RegisterUser $data
    ): JsonResponse {
        $user = $this->getUserRepository()->create();
        $user->setFirstName($data->getFirstName());
        $user->setLastName($data->getLastName());
        $user->setEmail($data->getEmail());
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(md5(random_bytes(255)));
        $user->setToken(md5(random_bytes(255)));
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return new JsonResponse(
            [
                'type'   => 'forgot password',
                'title'  => 'A confirmation email has been sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
