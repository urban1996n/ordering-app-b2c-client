<?php

namespace App\Entity\Common;
use Symfony\Component\Uid\Uuid;

interface HasUidInterface
{
    public function getUid(): ?Uuid;
}
