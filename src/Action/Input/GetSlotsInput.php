<?php declare(strict_types=1);

namespace App\Action\Input;

final class GetSlotsInput
{
    private int $doctorId;

    public function __construct(int $doctorId)
    {
        $this->doctorId = $doctorId;
    }

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }
}
