<?php declare(strict_types=1);

namespace App\Action;

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

    public function __invoke(Request $request)
    {
        $doctor = $this->doctors->getById((int) $request->get('id'));

        if (!$doctor) {
            return new JsonResponse([], 404);
        }

        return new JsonResponse(
            [
                'id' => $doctor->id(),
                'firstName' => $doctor->firstName(),
                'lastName' => $doctor->lastName(),
                'specialization' => $doctor->specialization()->name(),
            ]
        );
    }
}
