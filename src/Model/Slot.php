<?php
declare(strict_types=1);

namespace App\Model;

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

    public function getId()
    {
        return $this->id;
    }

    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    public function getFromHour()
    {
        return $this->fromHour;
    }

    /**
     * @param mixed $fromHour
     */
    public function setFromHour($fromHour)
    {
        $this->fromHour = $fromHour;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function doctor()
    {
        return $this->doctor;
    }

    /**
     * @param mixed $doctor
     */
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;
    }

}
