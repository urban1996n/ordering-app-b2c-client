<?php

namespace App\Entity\Common;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

trait GetUidITrait
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id;

    public function getUid(): ?Uuid
    {
        return $this->id;
    }
}