<?php declare(strict_types=1);

namespace App\Action;

use App\Model\Doctor;
use App\Controller\SlotEntity;
use App\Model\Doctors;
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

    public function __invoke(Request $request, $doctorId)
    {
        $doctor = $this->doctors->getById((int)$doctorId);

        if (!$doctor) {
            return new JsonResponse([], 404);
        }

        $slots = $this->extractDoctorSlots($doctor);
        return new JsonResponse(count($slots) ? $slots : []);
    }

    /**
     * @param Doctor $doctor
     * @return SlotEntity[]
     */
    private function extractDoctorSlots(Doctor $doctor): array
    {
        $slots = $doctor->slots();
        $res = [];
        foreach ($slots as $slot) {
            $res[] = [
                'id' => $slot->getId(),
                'day' => $slot->getDay()->format('Y-m-d'),
                'from_hour' => $slot->getFromHour(),
                'duration' => $slot->getDuration()
            ];
        }
        return $res;
    }
}
