<?php declare(strict_types=1);

namespace App\Action;

use App\Controller\DoctorEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\Doctors;

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

        return new JsonResponse(['id' => $doctor->getId()]);
    }

    private function createDoctorFromRequest($firstName, $lastName, $specialization): DoctorEntity
    {
        $doctor = new DoctorEntity();
        $doctor->setFirstName($firstName);
        $doctor->setLastName($lastName);
        $doctor->setSpecialization($specialization);

        return $doctor;
    }

    private function save($object): void
    {
        $this->doctors->add($object);
    }
}
