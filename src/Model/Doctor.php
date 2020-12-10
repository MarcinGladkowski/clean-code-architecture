<?php
declare(strict_types=1);

namespace App\Model;

use App\Controller\SlotEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="doctor")
 */
class Doctor extends Entity
{
    /**
     * @ORM\Column(type="string")
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string")
     */
    protected $specialization;

    /**
     * @ORM\OneToMany(targetEntity="SlotEntity", mappedBy="doctor")
     */
    protected $slots = [];

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return SlotEntity[]
     */
    public function slots(): array
    {
        return $this->slots->toArray();
    }
}
