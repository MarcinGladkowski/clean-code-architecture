<?php declare(strict_types=1);

namespace App\Action;

use App\Action\Input\GetDoctorInput;
use App\Action\Output\GetDoctorOutput;
use App\Domain\Model\Doctors;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetDoctor
{
    /**
     * @var Doctors
     */
    private Doctors $doctors;

    public function __construct(Doctors $doctors)
    {
        $this->doctors = $doctors;
    }

    public function __invoke(GetDoctorInput $input)
    {
        $doctor = $this->doctors->getById($input->getId());

        if (!$doctor) {
            return new JsonResponse([], 404);
        }

        return new GetDoctorOutput(
            $doctor->id(),
            $doctor->firstName(),
            $doctor->lastName(),
            $doctor->specialization()->name()
        );
    }
}
