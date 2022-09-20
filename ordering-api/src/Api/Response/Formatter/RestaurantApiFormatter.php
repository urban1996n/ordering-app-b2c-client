<?php

namespace App\Api\Response\Formatter;

use App\Entity\Settings\MenuSettings;
use App\Entity\Restaurant;
use App\Entity\Settings\RestaurantSettings;
use App\Entity\Settings\Menu\MenuCategory;
use App\Entity\Settings\Menu\MenuItem;

class RestaurantApiFormatter
{
    /** @param Restaurant[] $restaurants */
    public function getFormattedRestaurantList(array $restaurants): array
    {
        $formatRestaurant = function (Restaurant $restaurant) {
            /** @var MenuSettings|null $menu */
            $menu = $restaurant->getSetting(RestaurantSettings::MENU);

            return [
                'name'  => $restaurant->getName(),
                'image' => $restaurant->getPicture(),
                'menu'  => $this->getFormattedMenu($menu)
            ];
        };

        return \array_map($formatRestaurant, $restaurants);
    }

    private function getFormattedMenu(?MenuSettings $menu): array
    {
        if (!$menu) {
            return [];
        }

        return [
            $this->getFormattedMenuCategories($menu->getMenuCategories()->toArray()),
        ];
    }

    /** @param MenuCategory[] $menuCategories */
    private function getFormattedMenuCategories(array $menuCategories): array
    {
        $formatMenuCategory = function (MenuCategory $menuCategory) {
            return [
                $menuCategory->getSlug() => [
                    'name'       => $menuCategory->getName(),
                    'menu_items' => $this->getFormattedMenuItems($menuCategory->getMenuItems()->toArray()),
                ],
            ];
        };

        return \array_map($formatMenuCategory, $menuCategories);
    }

    /**
     * @param MenuItem[] $menuItems
     */
    private function getFormattedMenuItems(array $menuItems): array
    {
        $formatMenuItem = function (MenuItem $menuItem) {
            return [
                'name'  => $menuItem->getName(),
                'price' => $menuItem->getValue(),
                'image' => $menuItem->getImage(),
            ];
        };

        return \array_map($formatMenuItem, $menuItems);
    }
}
