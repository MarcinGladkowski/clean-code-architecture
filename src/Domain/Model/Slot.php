<?php
declare(strict_types=1);

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="slot")
 */
final class Slot extends Entity
{
    /**
     * @ORM\Column(type="date")
     */
    protected $day;

    /**
     * @ORM\Column(type="string")
     */
    protected $fromHour;

    /**
     * @ORM\Column(type="integer")
     */
    protected $duration;// minutes

    /**
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="slots")
     */
    protected $doctor;

    public function __construct(Doctor $doctor, \DateTime $day, int $duration, string $fromHour)
    {
        $this->doctor = $doctor;
        $this->day =$day;
        $this->duration = $duration;
        $this->fromHour = $fromHour;
    }

    public function day(): \DateTime
    {
        return $this->day;
    }

    public function fromHour(): string
    {
        return $this->fromHour;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function doctor(): Doctor
    {
        return $this->doctor;
    }
}
