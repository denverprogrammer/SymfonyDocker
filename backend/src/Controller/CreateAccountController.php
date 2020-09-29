<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Models\CreateAccountModel;
use App\Controller\Traits;

/**
 * Create account and send confirmation email.
 */
class CreateAccountController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;

    /**
     * Process request
     *
     * @param Request $request User request.
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $this->getSerializer()->deserialize(
            $request->getContent(),
            CreateAccountModel::class,
            'json'
        );
        $user = $this->getUserRepository()->findByUsername($data->getUsername());

        if ($user) {
            return new JsonResponse(
                [
                    'type'   => 'create_account',
                    'title'  => 'User error',
                    'errors' => 'Username already present.'
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $this->dispatchMessage($data);

        return new JsonResponse(
            [
                'type'   => 'confirm account',
                'title'  => 'A confirmation email has been sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
