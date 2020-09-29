<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Models\CreateAccountModel;
use App\Form\CreateAccountForm;
use App\Controller\Traits;

/**
 * Security controller
 */
class SecurityController extends AbstractController
{
    use Traits\RepositoryTrait;
    use Traits\SerializerTrait;
    use Traits\FormTrait;

    /**
     * Loging route
     *
     * @param Request $request User request.
     *
     * @return JsonResponse
     *
     * @Route("/api/login", name="app_login", methods={"POST"})
     */
    public function login(Request $request): JsonResponse
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') === false) {
            return $this->json([
                'error' => 'Invalid login request: check that the Content-Type header is "application/json".'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->getUser();

        return new JsonResponse([
            'id'       => $user->getId(),
            'username' => $user->getUsername(),
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Logout route
     *
     * @Route("/api/logout", name="app_logout")
     *
     * @return void
     *
     * @throws Exception Throw statement is never hit.
     */
    public function logout(): void
    {
        throw new Exception('This should never be reached!');
    }
}
