<?php declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Model\Doctor;

interface Doctors
{
    public function add(Doctor $doctor): void;

    public function getById(int $id): ?Doctor;
}
