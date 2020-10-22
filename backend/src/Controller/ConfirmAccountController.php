<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Models\ConfirmAccountModel;
use App\Form\PasswordForm;
use App\Controller\Traits;

/**
 * Confirm password reset
 */
class ConfirmAccountController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;

    /**
     * Encodes password on user entity.
     *
     * @var UserPasswordEncoderInterface
     */
    protected UserPasswordEncoderInterface $encoder;

    /**
     * Class constructor.
     *
     * @param UserPasswordEncoderInterface $encoder Encodes user password.
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Process request.
     *
     * @param Request $request User request.
     * @param string  $token   Random token.
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $token): JsonResponse
    {
        $message = $this->getMessageRepository()->findByToken($token);

        if ($message === null) {
            return new JsonResponse('message not found', JsonResponse::HTTP_NOT_FOUND);
        }

        $user = $this->getUserRepository()->findByEmail($message->getRecipient());

        if ($user === null) {
            return new JsonResponse('user not found', JsonResponse::HTTP_NOT_FOUND);
        }

        $data = $this->getSerializer()->deserialize(
            $request->getContent(),
            ConfirmAccountModel::class,
            'json'
        );
        $message->setToken(null);
        $password = $this->encoder->encodePassword($user, $data->getPassword());
        $user->setPassword($password);
        $user->setAgreement($data->getAgreement());
        $user->setNotifications($data->getNotifications());
        $user->setConfirmed(true);
        $this->getEntityManager()->flush();

        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }
}
