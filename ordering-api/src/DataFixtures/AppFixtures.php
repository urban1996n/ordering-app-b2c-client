<?php

namespace App\DataFixtures;

use App\Entity\Settings\MenuSettings;
use App\Entity\Restaurant;
use App\Entity\Settings\RestaurantSettings;
use App\Entity\Settings\Menu\MenuCategory;
use App\Entity\Settings\Menu\MenuItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private ?ObjectManager $manager = null;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        foreach(['Januszeks browar', 'Pizzeria MiGracion'] as $restaurantName) {
            $this->createRestaurant($restaurantName);
        }

        $manager->flush();
    }

    private function createRestaurant(string $restaurantName): Restaurant
    {
        $restaurant = new Restaurant();

        $restaurant
            ->setName($restaurantName)
            ->setPicture('no-image.jpg');

        $restaurantSettings = new RestaurantSettings();
        $restaurantSettings->setMenuSettings($this->createMenu());

        $restaurant->setSettings($restaurantSettings);

        $this->manager->persist($restaurant);
        $this->manager->persist($restaurantSettings);

        return $restaurant;
    }

    private function createMenu(): MenuSettings
    {
        $menu           = new MenuSettings();
        $menuCategories = [
            0 => [
                'name' => 'Main Dishes',
                'items' => ['Fish', 'Pork chop', 'Hamburger']
            ],
            1=> [
                'name' => 'Soups',
                'items' => ['Chicken soup', 'Brocolli creme', 'Fish soup'],
            ],
            2 => [
                'name' => 'Apetizers',
                'items' => ['Fries', 'Onion rings'],

            ],
            3 => [
                'name' => 'Drinks',
                'items' => ['Beer', 'Tea', 'Cola', 'Pepsi', 'Vodka']
            ]
        ];
        
        foreach ($menuCategories as $index => [$categoryName, $menuItems]) {
            $menuCategory = $this->createMenuCategory($categoryName);

            foreach ($menuItems as $menuItemName) {
                $menuCategory->addMenuItem($menuItem = $this->createMenuItem($menuItemName));
                $this->manager->persist($menuItem);
            }

            $menu->addMenuCategory($menuCategory);
            $this->manager->persist($menuCategory);
        }

        $this->manager->persist($menu);

        return $menu;
    }

    private function createMenuCategory(string $category): MenuCategory
    {
        $menuCategory = new MenuCategory();

        $menuCategory
            ->setName($category)
            ->setSlug(\strtolower(\preg_replace('/\s/', '-', $category)));

        return $menuCategory;
    }

    private function createMenuItem(string $name): MenuItem
    {
        $menuItem = new MenuItem();
        $menuItem
            ->setName($name)
            ->setValue(\rand(1, 120))
            ->setImage('no-image');
        
        return $menuItem;
    }
}
