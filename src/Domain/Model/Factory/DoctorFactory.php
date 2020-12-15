<?php declare(strict_types=1);

namespace App\Domain\Model\Factory;

use App\Action\Input\AddDoctorInput;
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

    public function fromRequest(AddDoctorInput $input): Doctor
    {
        return new Doctor(
            $input->getFirstName(),
            $input->getLastName(),
            $this->specializationFactory->createFromName($input->getSpecialisation())
        );
    }
}
