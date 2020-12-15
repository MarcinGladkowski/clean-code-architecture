<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter\InputFactory;

use App\Infrastructure\ParamConverter\InputFactory\InputFactory;

interface InputFactoryProvider
{
    public function getFactory(string $className): InputFactory;
}
