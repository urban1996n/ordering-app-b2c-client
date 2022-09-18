<?php

namespace App\Entity;

use App\Entity\Common\HasUidInterface;
use App\Entity\Settings\Interface\SettingInterface;
use App\Repository\RestaurantRepositroy;
use App\Entity\Common\GetUidITrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: RestaurantRepositroy::class)]
class Restaurant implements HasUidInterface
{
    use GetUidITrait;

    #[ORM\OneToOne(targetEntity:RestaurantSettings::class)]
    #[ORM\JoinColumn(name: 'settings_id', referencedColumnName: 'id')]
    private ?RestaurantSettings $settings = null;

    #[ORM\Column()]
    private ?string $name = null;

    /** Will be @var Symfony\Component\HttpFoundation\File\File in the future. - for development only*/
    #[ORM\Column()]
    private ?string $picture = null;

    public function getSetting(string $setting): ?SettingInterface
    {
        if (!($settings = $this->settings)) {
            return null;
        }

        return $settings->get($setting);
    }

    public function getSettings(): ?RestaurantSettings 
    {
        return $this->RestaurantSettings;
    }

    public function setSettings(RestaurantSettings $restaurantSettings): Restaurant
    {
        $this->settings = $restaurantSettings;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }
    
    public function setPicture(?string $picture): Restaurant
    {
        $this->picture = $picture;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function setName(?string $name): Restaurant
    {
        $this->name = $name;

        return $this;
    }
}