<?php declare(strict_types=1);

namespace App\Model\Factory;

use App\Model\Specialization;

final class SpecializationFactory
{
    public function createFromName(string $name): Specialization
    {
        return new Specialization($name);
    }
}
