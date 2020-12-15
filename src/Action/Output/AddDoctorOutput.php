<?php declare(strict_types=1);

namespace App\Action\Output;

final class AddDoctorOutput
{
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
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
}
