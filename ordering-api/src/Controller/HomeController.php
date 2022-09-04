<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /** @Route(methods={"GET"}, path="/api", name="home") */
    public function indexAction(): JsonResponse
    {
        return $this->json(['data'=>'Hello world']);
    }
}