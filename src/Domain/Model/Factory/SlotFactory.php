<?php declare(strict_types=1);

namespace App\Domain\Model\Factory;

use App\Action\Input\AddSlotsInput;
use App\Domain\Model\Doctors;
use App\Domain\Model\Slot;

final class SlotFactory
{
    /**
     * @var Doctors
     */
    private Doctors $doctors;

    public function __construct(Doctors $doctors)
    {
        $this->doctors = $doctors;
    }

    public function fromRequest(AddSlotsInput $input): Slot
    {
        return new Slot(
            $this->doctors->getById($input->getDoctorId()),
            $input->getDay(),
            $input->getDuration(),
            $input->getFromHour()
        );
    }
}
