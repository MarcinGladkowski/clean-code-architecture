<?php declare(strict_types=1);

namespace App\Infrastructure\Responder;

use Symfony\Component\Console\Output\OutputInterface;

interface ConsoleResponder
{
    public function __invoke(OutputInterface $output, $data): void;
}
