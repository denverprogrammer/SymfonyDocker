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
class ResetPasswordController extends ReactController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Reset password route.
     *
     * @param Request $request Http Request.
     *
     * @return JsonResponse
     *
     * @Route("/reset_password", name="reset_password", methods={"post"})
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $form = $this->createForm(EmailForm::class);
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

        $data = $form->getData();

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
