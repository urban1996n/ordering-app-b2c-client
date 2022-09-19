<?php

namespace App\Entity\Settings\Menu;

use App\Entity\Common\HasUidInterface;
use App\Entity\Common\GetUidITrait;
use App\Repository\Settings\MenuItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: MenuItemRepository::class)]
class MenuItem implements HasUidInterface
{
    use GetUidITrait;

    #[ORM\Column()]
    private ?string $name = null;

    #[ORM\Column(type: 'float')]
    private ?float $value = null;

    /** Will be @var File in the future. - for development only*/
    #[ORM\Column()]
    private ?string $image;

    #[ORM\ManyToMany(targetEntity: MenuCategory::class, mappedBy: 'menuItems')]
    private ?Collection $menuCategories = null;

    public function __construct()
    {
        $this->menuCategories = new ArrayCollection();
    }

    public function addMenuCategory(MenuCategory $menuCategory): MenuItem
    {
        if (!($menuCategories = $this->menuCategories)->contains($menuCategory)) {
            $menuCategories->add($menuCategory);
        }

        return $this;
    }

    public function removeMenuCategory(MenuCategory $menuCategory): MenuItem
    {
        if(!($menuCategories = $this->menuCategories)->contains($menuCategories)) {
            $menuCategories->remove($menuCategory);
        }

        return $this;
    }

    public function getCategories(): ?Collection
    {
        return $this->menuCategories;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): MenuItem
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): MenuItem
    {
        $this->value = $value;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): MenuItem
    {
        $this->image = $image;

        return $this;
    }
}
