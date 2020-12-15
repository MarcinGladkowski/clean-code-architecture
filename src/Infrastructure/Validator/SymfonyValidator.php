<?php declare(strict_types=1);

namespace App\Infrastructure\Validator;

use App\Infrastructure\Exception\DataValidationException;
use App\Infrastructure\Service\SymfonyViolationListConverter;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SymfonyValidator implements DataValidator
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;
    /**
     * @var SymfonyViolationListConverter
     */
    private SymfonyViolationListConverter $converter;

    public function __construct(ValidatorInterface $validator, SymfonyViolationListConverter $converter)
    {
        $this->validator = $validator;
        $this->converter = $converter;
    }

    public function validate($data): void
    {
        $errors = $this->validator->validate($data);

        if (count($errors) === 0) {
            return;
        }

        throw new DataValidationException($this->converter->convertToArray($errors));
    }
}
