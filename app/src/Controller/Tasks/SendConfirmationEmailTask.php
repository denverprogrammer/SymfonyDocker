<?php

namespace App\Controller\Tasks;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\DTO\ConfirmAccount;
use App\Controller\Traits;

class SendConfirmationEmailTask extends AbstractController implements MessageHandlerInterface
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send account confirmation email.
     *
     * @return JsonResponse
     */
    public function __invoke(ConfirmAccount $data): JsonResponse
    {
        $user = $this->getUserRepository()->find($data->getId());

        if (!$user) {
            return new JsonResponse(null, JsonResponse::HTTP_NOT_FOUND);
        }

        $token = $user->getToken();
        $href = "/confirm_account/${token}";
        $email = new Email();
        $email = $email
            ->from('test@symfonydocker.com')
            ->to($user->getEmail())
            ->subject('Confirm your account')
            ->text("Confirm your account here. ${href}")
            ->html("<p>Confirm your account <a href=\"${href}\">here.</a></p>");
        $this->mailer->send($email);

        return new JsonResponse(
            [
                'type'   => 'email sent',
                'title'  => 'Account confirmation email sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_OK
        );
    }
}
