<?php declare(strict_types=1);

namespace App\Action\Input;

use App\Domain\Model\Doctor;

final class AddSlotsInput
{
    private int $doctorId;

    private \DateTime $day;

    private int $duration;

    private string $fromHour;

    public function __construct(int $doctorId, \DateTime $day, int $duration, string $fromHour)
    {
        $this->doctorId = $doctorId;
        $this->day = $day;
        $this->duration = $duration;
        $this->fromHour = $fromHour;
    }

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }

    public function getDay(): \DateTime
    {
        return $this->day;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getFromHour(): string
    {
        return $this->fromHour;
    }

}
