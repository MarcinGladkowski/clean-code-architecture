<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Action\Input\GetDoctorInput;
use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
use Symfony\Component\HttpFoundation\Request;

final class GetDoctorInputFactory implements InputFactory
{
    public function createFromRequest(Request $request): object
    {
        return new GetDoctorInput((int) $request->get('id'));
    }

    public static function supportedInput(): string
    {
        return GetDoctorInput::class;
    }
}
