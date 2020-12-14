<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Action\Input\AddDoctorInput;
use Symfony\Component\HttpFoundation\Request;

class AddDoctorInputFactory implements InputFactory
{
    public function createFromRequest(Request $request): object
    {
        return new AddDoctorInput(
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('specialization')
        );
    }

    public static function supportedInput(): string
    {
        return AddDoctorInput::class;
    }
}
