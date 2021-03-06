<?php declare(strict_types=1);

namespace App\Action\Input;

use Symfony\Component\Validator\Constraints as Assert;

final class AddDoctorInput
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private string $firstName;
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private string $lastName;

    private string $specialisation;

    public function __construct(string $firstName, string $lastName, string $specialisation)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->specialisation = $specialisation;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getSpecialisation(): string
    {
        return $this->specialisation;
    }
}
