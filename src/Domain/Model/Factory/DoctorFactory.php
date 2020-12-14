<?php declare(strict_types=1);

namespace App\Domain\Model\Factory;

use App\Domain\Model\Doctor;
use Symfony\Component\HttpFoundation\Request;

final class DoctorFactory
{
    /**
     * @var SpecializationFactory
     */
    private SpecializationFactory $specializationFactory;

    public function __construct(SpecializationFactory $specializationFactory)
    {
        $this->specializationFactory = $specializationFactory;
    }

    public function fromRequest(Request $request): Doctor
    {
        return new Doctor(
            $request->get('firstName'),
            $request->get('lastName'),
            $this->specializationFactory->createFromName($request->get('specialization'))
        );
    }
}
