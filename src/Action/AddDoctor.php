<?php declare(strict_types=1);

namespace App\Action;

use App\Model\Doctor;
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

    public function __construct(Doctors $doctors)
    {
        $this->doctors = $doctors;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $doctor = $this->createDoctorFromRequest(
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('specialization')
        );

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
