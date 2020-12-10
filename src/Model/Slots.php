<?php declare(strict_types=1);

namespace App\Model;

use App\Model\Slot;

interface Slots
{
    public function add(Slot $slotEntity);
}
