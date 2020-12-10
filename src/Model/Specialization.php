<?php declare(strict_types=1);

namespace App\Model;

class Specialization
{
    /**
     * @var string
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function equals(Specialization $specialization): bool
    {
        return $this->name === $specialization->name();
    }
}
