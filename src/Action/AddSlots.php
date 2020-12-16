<?php declare(strict_types=1);

namespace App\Action;

use App\Action\Input\AddSlotsInput;
use App\Domain\Model\Factory\SlotFactory;
use App\Domain\Model\Slots;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddSlots
{
    private Slots $slots;

    private SlotFactory $slotFactory;

    public function __construct(Slots $slots, SlotFactory $slotFactory)
    {
        $this->slots = $slots;
        $this->slotFactory = $slotFactory;
    }

    public function __invoke(AddSlotsInput $input): JsonResponse
    {
        $slot = $this->slotFactory->fromRequest($input);

        $this->slots->add($slot);

        return new JsonResponse(['id' => $slot->id()]);
    }
}
