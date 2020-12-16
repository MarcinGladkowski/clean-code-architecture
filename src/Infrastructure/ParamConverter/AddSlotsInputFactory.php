<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Action\Input\AddSlotsInput;
use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
use Symfony\Component\HttpFoundation\Request;

final class AddSlotsInputFactory implements InputFactory
{
    public function createFromRequest(Request $request): object
    {
        return new AddSlotsInput(
            $request->get('doctorId'),
            new \DateTime($request->get('day')),
            (int) $request->get('doctorId'),
            $request->get('from_hour')
        );
    }

    public static function supportedInput(): string
    {
        return AddSlotsInput::class;
    }
}
