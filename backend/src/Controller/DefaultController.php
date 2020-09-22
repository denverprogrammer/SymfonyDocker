<?php

namespace App\Controller;
    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Default React controller
 */
class DefaultController extends AbstractController
{
    /**
     * Default React controller
     *
     * @Route(
     *     "/{reactRouting}",
     *     name="home",
     *     defaults={"reactRouting": null},
     *     requirements={"reactRouting"="^(?!api).+"}
     * )
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
