<?php declare(strict_types=1);

namespace App\Action\Output;

final class GetDoctorOutput
{

    private int $id;

    private string $firstName;

    private string $lastName;

    private string $specialization;

    public function __construct(int $id, string $firstName, string $lastName, string $specialization)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->specialization = $specialization;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getSpecialization(): string
    {
        return $this->specialization;
    }

}
