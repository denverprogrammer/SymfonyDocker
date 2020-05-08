<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\DTO\RegisterUser;
use App\Form\RegistrationForm;

/**
 * Security Controller
 *
 * @Route("/auth")
 */
class SecurityController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Register user route.
     *
     * @param Request                      $request Http Request.
     * @param UserPasswordEncoderInterface $encoder Common security methods.
     *
     * @return JsonResponse
     *
     * @Route("/register", name="register")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder
    ): JsonResponse {
        $form = $this->createForm(RegistrationForm::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if (!$form->isValid()) {
            return new JsonResponse(
                [
                    'type'   => 'validation error',
                    'title'  => 'There was a validation error',
                    'errors' => $this->getErrorsFromForm($form)
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $data = $form->getData();
        $user = $this->getUserRepository()->create();
        $user->setFirstName($data->getFirstName());
        $user->setLastName($data->getLastName());
        $user->setEmail($data->getEmail());
        $user->setRoles(['ROLE_USER']);
        $password = $encoder->encodePassword($user, $data->getPassword());
        $user->setPassword($password);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

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
