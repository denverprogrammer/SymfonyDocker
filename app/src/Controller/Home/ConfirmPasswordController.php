<?php

namespace App\Controller\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Security\Core\Security;
use App\Form\EmailForm;
use App\Controller\Traits;
use App\Controller\ReactController;

/**
 * Common routes for site.
 */
class ConfirmPasswordController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Reset user password.
     *
     * @return JsonResponse
     *
     * @Route("/confirm_password/{token}", name="confirm_password", methods={"post"})
     */
    public function confirmPassword(Security $security, string $token): JsonResponse
    {
        $user = $security->getUser();

        return new JsonResponse(
            [
                'firstName' => $user->getFirstName(),
                'lastName'  => $user->getLastName(),
                'email'     => $user->getEmail()
            ],
            JsonResponse::HTTP_OK
        );
    }
}
