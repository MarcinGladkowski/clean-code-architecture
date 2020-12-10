<?php declare(strict_types=1);

namespace App\Action;

use App\Model\Doctor;
use App\Model\Slot;
use App\Infrastructure\Repository\DoctrineSlots;
use App\Model\Doctors;
use App\Model\Slots;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddSlots
{
    /**
     * @var Slots
     */
    private Slots $slots;
    /**
     * @var Doctors
     */
    private Doctors $doctors;

    public function __construct(Slots $slots, Doctors $doctors)
    {
        $this->slots = $slots;
        $this->doctors = $doctors;
    }

    public function __invoke(Request $request, $doctorId): JsonResponse
    {
        $doctor = $this->doctors->getById((int) $doctorId);

        $slot = $this->createSlotFromRequest(
            $doctor,
            new \DateTime($request->get('day')),
            (int)$request->get('duration'),
            $request->get('from_hour')
        );

        $this->slots->add($slot);

        return new JsonResponse(['id' => $slot->getId()]);
    }

    private function createSlotFromRequest(Doctor $doctor, \DateTime $day, int $duration, $fromHour): Slot
    {
        $slot = new Slot();
        $slot->setDay($day);
        $slot->setDoctor($doctor);
        $slot->setDuration($duration);
        $slot->setFromHour($fromHour);

        return $slot;
    }
}
