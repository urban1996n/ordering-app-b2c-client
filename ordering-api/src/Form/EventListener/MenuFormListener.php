<?php

namespace App\Form\EventListener;

use App\Entity\Settings\MenuSettings;
use App\Entity\Settings\RestaurantSettings;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\SubmitEvent;

class MenuFormListener implements EventSubscriberInterface
{
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SubmitEvent::class => 'onSubmit'
        ];
    }

    public function onSubmit(SubmitEvent $submitEvent): void
    {
        if ($restaurant = $submitEvent->getForm()->getData()) {
            $restaurantSettings = new RestaurantSettings();
            $restaurantSettings->setMenuSettings($menuSettings = new MenuSettings());
            $restaurant->setSettings($restaurantSettings);

            $om = $this->registry->getManager();

            $om->persist($menuSettings);
            $om->persist($restaurantSettings);
            $om->persist($restaurant);
        }
    }
}