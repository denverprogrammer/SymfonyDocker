<?php

namespace App\Controller\Home;

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
use App\Controller\Traits;
use App\Controller\ReactController;

/**
 * Common routes for site.
 */
class CreateAccountController extends ReactController
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
     * @Route("/create_account", name="create_account", methods={"post"})
     */
    public function createAccount(Request $request): JsonResponse
    {
        $form = $this->createForm(RegistrationForm::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

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

        $this->dispatchMessage($form->getData());

        return new JsonResponse(
            [
                'type'   => 'user created',
                'title'  => 'A confirmation email has been sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
