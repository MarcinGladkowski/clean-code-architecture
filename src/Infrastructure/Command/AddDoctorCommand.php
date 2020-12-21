<?php declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Action\AddDoctor;
use App\Infrastructure\ParamConverter\AddDoctorInputFactory;
use App\Infrastructure\Responder\ConsoleResponder;
use App\Infrastructure\Validator\DataValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddDoctorCommand extends Command
{
    protected static $defaultName = 'doctor:add';

    private const FIRST_NAME = 'firstName';

    private const LAST_NAME = 'lastName';

    private const SPECIALIZATION = 'specialization';

    private DataValidator $validator;

    private AddDoctor $addDoctor;

    private AddDoctorInputFactory $inputFactory;

    private ConsoleResponder $consoleResponder;

    public function __construct(
        DataValidator $validator,
        AddDoctor $addDoctor,
        AddDoctorInputFactory $inputFactory,
        ConsoleResponder $consoleResponder
    )
    {
        $this->validator = $validator;
        $this->addDoctor = $addDoctor;
        $this->inputFactory = $inputFactory;
        $this->consoleResponder = $consoleResponder;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Create new doctor')
            ->addArgument(self::FIRST_NAME, InputArgument::REQUIRED, 'doctor first name')
            ->addArgument(self::LAST_NAME, InputArgument::REQUIRED, 'doctor last name')
            ->addArgument(self::SPECIALIZATION, InputArgument::REQUIRED, 'doctor specialization');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $addDoctorInput = $this->inputFactory->createFromData(
            $input->getArgument(self::FIRST_NAME),
            $input->getArgument(self::LAST_NAME),
            $input->getArgument(self::SPECIALIZATION)
        );

        $this->validator->validate($addDoctorInput);

        $addDoctorOutput = $this->addDoctor->__invoke($addDoctorInput);

        $this->consoleResponder->__invoke($output, $addDoctorOutput);

        return Command::SUCCESS;
    }
}
