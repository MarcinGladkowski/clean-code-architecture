<?php declare(strict_types=1);

namespace App\Action\Input;

final class GetDoctorInput
{
    /**
     * @var int
     */
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}
