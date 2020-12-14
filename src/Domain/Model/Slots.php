<?php declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Model\Slot;

interface Slots
{
    public function add(Slot $slotEntity);
}
