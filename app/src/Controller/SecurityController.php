<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Security Controller
 *
 * @Route("/auth")
 */
class SecurityController extends AbstractController
{
    /**
     * User profile route.
     *
     * @return JsonResponse
     *
     * @Route("/profile", name="profile")
     */
    public function profile(Security $security): JsonResponse
    {
        $user = $security->getUser();

        return new JsonResponse(
            [
                'firstName' => $user->getFirstName(),
                'lastName'  => $user->getLastName(),
                'email'     => $user->getEmail()
            ],
            JsonResponse::HTTP_OK
        );
    }
}
