<?php declare(strict_types=1);

namespace App\Infrastructure\ExceptionHandler;

use App\Infrastructure\Exception\DataValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class DataValidationExceptionHandler
{
    public function __invoke(ExceptionEvent $exceptionEvent)
    {
        $exception = $exceptionEvent->getThrowable();

        if (!$exception instanceof DataValidationException) {
            return;
        }

        $exceptionEvent->setResponse(
            new JsonResponse($exception->getErrors(), $exception->getStatusCode())
        );
    }
}
