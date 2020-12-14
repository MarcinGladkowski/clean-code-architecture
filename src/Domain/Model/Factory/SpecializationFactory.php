<?php declare(strict_types=1);

namespace App\Domain\Model\Factory;

use App\Domain\Model\Specialization;

final class SpecializationFactory
{
    public function createFromName(string $name): Specialization
    {
        return new Specialization($name);
    }
}
