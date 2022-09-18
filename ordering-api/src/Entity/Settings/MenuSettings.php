<?php

namespace App\Entity;

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
    private ?ArrayCollection $menuCategories = null;

    #[ORM\ManyToMany(targetEntity: MenuItem::class)]
    #[ORM\JoinTable(name: 'menu_settings_items')]
    private ?ArrayCollection $menuItems = null;

    public function __construct()
    {
        $this->menuCategories = new ArrayCollection();
        $this->menuItems = new ArrayCollection();
    }

    public function getMenuCategories(): ArrayCollection
    {
        return $this->menuCategories;
    }

    public function getMenuItems(): ArrayCollection
    {
        return $this->menuItems;
    }
}