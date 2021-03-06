<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Models\ResetPasswordModel;
use App\Controller\Traits;

/**
 * Reset password for user and send email.
 */
class ResetPasswordController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;

    /**
     * Process request.
     *
     * @param Request $request User request.
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $this->getSerializer()->deserialize(
            $request->getContent(),
            ResetPasswordModel::class,
            'json'
        );

        $this->dispatchMessage($data);

        return new JsonResponse(
            [
                'type'   => 'password reset',
                'title'  => 'A confirmation email has been sent.',
                'errors' => null
            ],
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
