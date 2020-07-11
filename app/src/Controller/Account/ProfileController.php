<?php

namespace App\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Controller\ReactController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Security Controller
 *
 * @Route("/api/users/profile", name="profile")
 */
class ProfileController extends AbstractController
{
    /**
     * User profile route.
     *
     * @return JsonResponse
     */
    public function __invoke(Security $security): JsonResponse
    {
        $user = $security->getUser();

        if ($user === null) {
            throw new AccessDeniedException();
        }

        return new JsonResponse(
            [
                'firstName' => $user->getFirstName(),
                'lastName'  => $user->getLastName(),
            ],
            JsonResponse::HTTP_OK
        );
    }
}
