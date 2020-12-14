<?php
declare(strict_types=1);

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Model\Slots;

/**
 * @ORM\Entity
 * @ORM\Table(name="doctor")
 */
class Doctor extends Entity
{
    /**
     * @ORM\Column(type="string")
     */
    protected string $firstName;

    /**
     * @ORM\Column(type="string")
     */
    protected string $lastName;

    /**
     * @var Specialization
     * @ORM\Embedded(class="Specialization", columnPrefix="specialization_")
     */
    protected Specialization $specialization;

    /**
     * @ORM\OneToMany(targetEntity="Slot", mappedBy="doctor")
     */
    protected $slots = [];

    public function __construct(string $firstName, string $lastName, Specialization $specialization)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->specialization = $specialization;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function specialization(): Specialization
    {
        return $this->specialization;
    }

    /**
     * @return Slot[]
     */
    public function slots(): array
    {
        return $this->slots->toArray();
    }
}
