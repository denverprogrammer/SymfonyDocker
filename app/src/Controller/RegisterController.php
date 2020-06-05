<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Security\Core\Security;
use App\Entity\DTO\RegisterUser;
use App\Form\PasswordForm;
use App\Form\RegistrationForm;

/**
 * Common routes for site.
 * 
 * @Route("/home")
 */
class RegisterController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Register user route.
     *
     * @param Request $request Http Request.
     *
     * @return JsonResponse
     *
     * @Route("/register", name="register", methods={"post"})
     */
    public function createAccount(Request $request): JsonResponse
    {
        dump('request');
        $form = $this->createForm(RegistrationForm::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        dump('submit');
        if (!$form->isValid()) {
            return new JsonResponse(
                [
                    'type'   => 'validation error',
                    'title'  => 'There was a validation error',
                    'errors' => $this->getErrors($form)
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        dump('dispatch');
        $this->dispatchMessage($form->getData());
        dump('return');
        return new JsonResponse(
            [
                'type'   => 'user created',
                'title'  => 'A confirmation email has been sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Reset user password.
     *
     * @return JsonResponse
     *
     * @Route("/confirm_account", name="confirm_account", methods={"post"})
     */
    public function confirmAccount(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        string $token
    ): JsonResponse {
        $user = $this->getUserRepository()->findUserByToken($token);

        if (!$user) {
            return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(PasswordForm::class, $user);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($request->isMethod('POST') && $form->isValid()) {
            $user = $form->getData();
            $password = $user->getPassword();
            $password = $encoder->encodePassword($user, $password);
            $user->setPassword($password);
            $this->getEntityManager()->flush();

            return new RedirectResponse('/');
        }

        return new JsonResponse(
            [
                'firstName' => $user->getFirstName(),
                'lastName'  => $user->getLastName()
            ],
            JsonResponse::HTTP_OK
        );
    }
}
