<?php declare(strict_types=1);

namespace App\Action;

use App\Action\Input\AddSlotsInput;
use App\Domain\Model\Doctor;
use App\Domain\Model\Slot;
use App\Infrastructure\Repository\DoctrineSlots;
use App\Domain\Model\Doctors;
use App\Domain\Model\Slots;
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

    public function __invoke(AddSlotsInput $input): JsonResponse
    {
        $doctor = $this->doctors->getById((int) $input->getDoctorId());

        $slot = $this->createSlotFromRequest(
            $doctor,
            new \DateTime($request->get('day')),
            (int)$request->get('duration'),
            $request->get('from_hour')
        );

        $this->slots->add($slot);

        return new JsonResponse(['id' => $slot->id()]);
    }

    private function createSlotFromRequest(Doctor $doctor, \DateTime $day, int $duration, $fromHour): Slot
    {
        return new Slot($doctor, $day, $duration, $fromHour);
    }
}
