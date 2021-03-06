<?php declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Action\Input\AddDoctorInput;
use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
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

    public function createFromData(string $firstName, string $lastName, string $specialization): AddDoctorInput
    {
        return new AddDoctorInput(
            $firstName,
            $lastName,
            $specialization
        );
    }

    public static function supportedInput(): string
    {
        return AddDoctorInput::class;
    }
}
