<?php

namespace App\Entity\Settings\Menu;

use App\Entity\Common\GetUidITrait;
use App\Entity\Common\HasUidInterface;
use App\Entity\Settings\Menu\MenuItem;
use App\Repository\Settings\MenuCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuCategoryRepository::class)]
class MenuCategory implements HasUidInterface
{
    use GetUidITrait;

    #[ORM\Column()]
    private ?string $name = null;

    #[ORM\Column()]
    private ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: MenuItem::class, inversedBy: 'menuCategories')]
    /** 
    * @JoinTasssble(name="menu_item_category",
    *   joinColumns={@JoinColumn(name="menu_category", referencedColumnName="uid")},
    *   inverseJoinColumns={@JoinColumn(name="menu_item", referencedColumnName="uid")}
    *)
    */
    private Collection $menuItems;

    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): MenuCategory
    {
        $this->name = $name;

        return $this;
    }

    public function addMenuItem(MenuItem $menuItem): MenuCategory
    {
        if (!($menuItems = $this->menuItems)->contains($menuItem)) {
            $menuItems->add($menuItem);
        }

        $menuItem->addMenuCategory($this);

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): MenuCategory
    {
        if(!($menuItems = $this->menuItems)->contains($menuItem)) {
            $menuItems->remove($menuItem);
        }

        $menuItem->removeMenuCategory($this);

        return $this;
    }

    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): MenuCategory
    {
        $this->slug = $slug;

        return $this;
    }
}
