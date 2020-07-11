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

/**
 * Common routes for site.
 */
class ConfirmAccountController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Initial react page.
     *
     * @Route("/confirm_account/{token}", name="confirm_account_get", methods={"get"})
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Reset user password.
     *
     * @Route("/confirm_account/{token}", name="confirm_account_post", methods={"post"})
     *
     * @return JsonResponse
     */
    public function confirmAccount(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        string $token
    ): Response {

        $user = $this->getUserRepository()->findUserByToken($token);

        if (!$user) {
            return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
        }

        if ($request->isMethod('GET')) {
            return new JsonResponse(
                [
                    'firstName' => $user->getFirstName(),
                    'lastName'  => $user->getLastName()
                ],
                JsonResponse::HTTP_OK
            );
        }

        $form = $this->createForm(PasswordForm::class, $user);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($request->isMethod('POST') && $form->isValid()) {
            $user = $form->getData();
            $password = $user->getPassword();
            $password = $encoder->encodePassword($user, $password);
            $user->setPassword($password);
            $user->setConfirmed(true);
            $this->getEntityManager()->flush();

            return new RedirectResponse('/');
        }

        return new JsonResponse(null, JsonResponse::HTTP_BAD_REQUEST);
    }
}
