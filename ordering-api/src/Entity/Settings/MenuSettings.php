<?php

namespace App\Entity\Settings;

use App\Entity\Common\GetUidITrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Common\HasUidInterface;
use App\Entity\Settings\Interface\SettingInterface;
use App\Entity\Settings\Menu\MenuCategory;
use App\Entity\Settings\Menu\MenuItem;
use App\Repository\Settings\MenuSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: MenuSettingsRepository::class)]
class MenuSettings implements HasUidInterface, SettingInterface
{
    use GetUidITrait;
    #[ORM\ManyToMany(targetEntity: MenuCategory::class)]
    #[ORM\JoinTable(name: 'menu_settings_categories')]
    private ?Collection $menuCategories = null;

    #[ORM\ManyToMany(targetEntity: MenuItem::class)]
    #[ORM\JoinTable(name: 'menu_settings_items')]
    private ?Collection $menuItems = null;

    public function __construct()
    {
        $this->menuCategories = new ArrayCollection();
        $this->menuItems = new ArrayCollection();
    }

    public function getMenuCategories(): Collection
    {
        return $this->menuCategories;
    }

    public function addMenuCategory(MenuCategory $menuCategory): MenuSettings
    {
        if (!($menuCategories = $this->menuCategories)->contains($menuCategories)) {
            $menuCategories->add($menuCategory);
        }
        

        return $this;
    }

    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem): MenuSettings
    {
        if (!($menuItems = $this->menuItems)->contains($menuItem)) {
            $menuItems->add($menuItem);
        }
        

        return $this;
    }
}
