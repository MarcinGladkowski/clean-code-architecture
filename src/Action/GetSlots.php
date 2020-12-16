<?php declare(strict_types=1);

namespace App\Action;

use App\Action\Input\GetSlotsInput;
use App\Domain\Model\Doctor;
use App\Domain\Model\Slot;
use App\Domain\Model\Doctors;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetSlots
{
    /**
     * @var Doctors
     */
    private Doctors $doctors;

    public function __construct(Doctors $doctors)
    {
        $this->doctors = $doctors;
    }

    public function __invoke(GetSlotsInput $input)
    {
        $doctor = $this->doctors->getById($input->getDoctorId());

        if (!$doctor) {
            return new JsonResponse([], 404);
        }

        $slots = $this->extractDoctorSlots($doctor);
        return new JsonResponse(count($slots) ? $slots : []);
    }

    /**
     * @param Doctor $doctor
     * @return Slot[]
     */
    private function extractDoctorSlots(Doctor $doctor): array
    {
        $slots = $doctor->slots();
        $res = [];
        foreach ($slots as $slot) {
            $res[] = [
                'id' => $slot->id(),
                'day' => $slot->day()->format('Y-m-d'),
                'from_hour' => $slot->fromHour(),
                'duration' => $slot->duration()
            ];
        }
        return $res;
    }
}
