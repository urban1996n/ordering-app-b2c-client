<?php

namespace App\Entity\Settings;

use App\Entity\Common\GetUidITrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RestaurantSettingsRepository;
use App\Entity\Common\HasUidInterface;
use App\Entity\Settings\Interface\SettingInterface;
use App\Entity\Settings\MenuSettings;

#[ORM\Entity(repositoryClass: RestaurantSettingsRepository::class)]
class RestaurantSettings implements HasUidInterface
{
    use GetUidITrait;

    public const MENU = 1; 
    private const METHOD_MAP = [
        self::MENU => 'getMenuSettings',
    ];

    #[ORM\OneToOne(targetEntity:MenuSettings::class)]
    #[ORM\JoinColumn(name: 'menu_settings', referencedColumnName:'id')]
    private ?MenuSettings $menuSettings = null;

    public function get(int $settings): ?SettingInterface
    {
        if (!\in_array($settings, \array_keys(self::METHOD_MAP))) {
            return null;
        }

        return \call_user_func([$this, self::METHOD_MAP[$settings]]);
    }

    public function setMenuSettings(MenuSettings $menuSettings): RestaurantSettings
    {
        $this->menuSettings = $menuSettings;

        return $this;
    }

    private function getMenuSettings(): ?MenuSettings
    {
        return $this->menuSettings;
    }
}
