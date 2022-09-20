<?php

namespace App\Controller;

use App\Api\Response\Formatter\RestaurantApiFormatter;
use App\Form\Type\RestaurantType;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/restaurant')]
class RestaurantApiEndpoint extends AbstractController
{
    #[Route(path: '/', methods: ['GET'], name: 'restaurant_list')]
    public function getList(
        RestaurantRepository $restaurantRepository,
        RestaurantApiFormatter $formatter
    ): JsonResponse {
        return $this->json($formatter->getFormattedRestaurantList($restaurantRepository->findAll()));
    }

    #[Route(path: '/create', methods: ['POST'], name: 'create_restaurant')]
    public function createRestaurant(Request $request): JsonResponse
    {
        $form = $this->createForm(RestaurantType::class);
        $form->add('submit', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            return $this->json(['result' => 'ok', Response::HTTP_CREATED]);
        }

        return $this->json(['result' => 'Form is invalid'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
