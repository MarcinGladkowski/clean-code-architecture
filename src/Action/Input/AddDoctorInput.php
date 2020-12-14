<?php declare(strict_types=1);

namespace App\Action\Input;

final class AddDoctorInput
{
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;
    /**
     * @var string
     */
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
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function specialisation(): string
    {
        return $this->specialisation;
    }


}
