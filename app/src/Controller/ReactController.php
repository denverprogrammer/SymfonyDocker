<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Common routes for react.
 *
 * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
 */
class ReactController extends AbstractController
{
    /**
     * Initial react page.
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
