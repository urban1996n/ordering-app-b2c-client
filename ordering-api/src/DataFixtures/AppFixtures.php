<?php

namespace App\DataFixtures;

use App\Entity\MenuSettings;
use App\Entity\Restaurant;
use App\Entity\RestaurantSettings;
use App\Entity\Settings\Menu\MenuCategory;
use App\Entity\Settings\Menu\MenuItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
        $menu       = new MenuSettings();
        $categories = [];
        $items      = [];

        foreach (['Main Dishes', 'Soups', 'Apetizers', 'Drinks'] as $categoryName) {
            $categories[] = $this->createMenuCategory($categoryName);
        }

        foreach (['Fish', 'Pork chop', 'Hamburger'] as $mainDish) {
            $item    = $this->createMenuItem($mainDish);
            $items[] = $item; 

            $categories[0]->addMenuItem($item);
        }

        foreach (['Chicken soup', 'Brocolli creme', 'Fish soup'] as $soup) {
            $item = $this->createMenuItem($soup);
            $items[] = $item;
            
            $categories[1]->addMenuItem($item);
        }

        foreach (['Fries', 'Onion rings'] as $apetizer) {
            $item = $this->createMenuItem($apetizer);
            $items[] = $item;

            $categories[2]->addMenuItem($item);
        }

        foreach (['Beer', 'Tea', 'Cola', 'Pepsi', 'Vodka'] as $drink) {
            $item = $this->createMenuItem($drink);
            $items[] = $item;
            $categories[3]->addMenuItem($item);
        }

        foreach ($categories as $category) {
            $menu->addMenuCategory($category);

            $this->manager->persist($category);
        }

        foreach ($items as $menuItem) { 
            $menu->addMenuItem($menuItem);

            $this->manager->persist($menuItem);
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
            ->setValue(\rand(0, 120))
            ->setImage('no-image');
        
        return $menuItem;
    }
}
