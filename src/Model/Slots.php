<?php declare(strict_types=1);

namespace App\Model;

use App\Controller\SlotEntity;

interface Slots
{
    public function add(SlotEntity $slotEntity);
}
