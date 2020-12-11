<?php declare(strict_types=1);

namespace App\Action;

use App\Model\Doctor;
use App\Model\Factory\DoctorFactory;
use App\Model\Specialization;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\Doctors;

use function Sodium\add;

final class AddDoctor
{
    /**
     * @var Doctors
     */
    private Doctors $doctors;
    /**
     * @var DoctorFactory
     */
    private DoctorFactory $doctorFactory;

    public function __construct(Doctors $doctors, DoctorFactory $doctorFactory)
    {
        $this->doctors = $doctors;
        $this->doctorFactory = $doctorFactory;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $doctor = $this->doctorFactory->fromRequest($request);

        $this->save($doctor);

        return new JsonResponse(['id' => $doctor->id()]);
    }

    private function createDoctorFromRequest($firstName, $lastName, $specialization): Doctor
    {
        return new Doctor($firstName, $lastName, new Specialization($specialization));
    }

    private function save($object): void
    {
        $this->doctors->add($object);
    }
}
