<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Settings\RestaurantSettings;
use App\Form\Type\MenuSettingsType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: '/api/menu')]
class MenuApiEndpoint extends AbstractController
{
    #[Route(path: '/edit', methods: ['POST', 'PATCH', 'PUT'], name: 'edit_menu')]
    public function createMenu(Restaurant $restaurant, Request $request): JsonResponse
    {
         $form = $this->createForm(MenuSettingsType::class, $restaurant->getSetting(RestaurantSettings::MENU));

         $form->handleRequest($request);
         if ($form->isSubmitted()) {
             return $this->json(['result' => 'ok', Response::HTTP_CREATED]);
         }
 
         return $this->json(['result' => 'Form is invalid'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}