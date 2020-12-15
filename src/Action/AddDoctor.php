<?php declare(strict_types=1);

namespace App\Action;

use App\Action\Input\AddDoctorInput;
use App\Domain\Model\Factory\DoctorFactory;
use App\Domain\Model\Doctors;
use App\Action\Output\AddDoctorOutput;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * @ParamConverter(converter="converter.action_input", name="input")
     * @param AddDoctorInput $input
     * @return AddDoctorOutput
     */
    public function __invoke(AddDoctorInput $input): AddDoctorOutput
    {
        $doctor = $this->doctorFactory->fromRequest($input);

        $this->save($doctor);

        return new AddDoctorOutput($doctor->firstName(), $doctor->lastName());
    }

    private function save($object): void
    {
        $this->doctors->add($object);
    }
}
