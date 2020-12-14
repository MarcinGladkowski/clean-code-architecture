<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

interface InputFactoryProvider
{
    public function getFactory(string $className): InputFactory;
}
