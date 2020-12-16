<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Action\Input\GetSlotsInput;
use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
use Symfony\Component\HttpFoundation\Request;

final class GetSlotsInputFactory implements InputFactory
{
    public function createFromRequest(Request $request): object
    {
        return new GetSlotsInput((int) $request->get('doctorId'));
    }

    public static function supportedInput(): string
    {
        return GetSlotsInput::class;
    }
}
