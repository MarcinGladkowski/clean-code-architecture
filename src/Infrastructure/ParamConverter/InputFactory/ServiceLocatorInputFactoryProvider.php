<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter\InputFactory;

use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
use App\Infrastructure\ParamConverter\InputFactory\InputFactoryProvider;
use Symfony\Component\DependencyInjection\ServiceLocator;

class ServiceLocatorInputFactoryProvider implements InputFactoryProvider
{
    /**
     * @var ServiceLocator
     */
    private ServiceLocator $serviceLocator;

    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getFactory(string $className): InputFactory
    {
        return $this->serviceLocator->get($className);
    }
}
