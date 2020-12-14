<?php declare(strict_types=1);

namespace App\Infrastructure\Validator;

interface DataValidator
{
    public function validate($data): void;
}
