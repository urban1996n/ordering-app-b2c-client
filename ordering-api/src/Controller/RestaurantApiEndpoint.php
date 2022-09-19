<?php

namespace App\Controller;

use App\Api\Response\Formatter\RestaurantApiFormatter;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantApiEndpoint extends AbstractController
{
    /** @Route(methods={"GET"}, path="/api", name="get_restaurant_list") */
    public function getList(RestaurantRepository $restaurantRepository, RestaurantApiFormatter $formatter): JsonResponse
    {
        return $this->json($formatter->getFormattedRestaurantList($restaurantRepository->findAll()));
    }
}
