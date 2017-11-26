<?php

// src/AppBundle/Command/CreateUserCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class PrinterCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "app/console")
            ->setName('app:printer')

            // the short description shown while running "php app/console list"
            ->setDescription('Prints a message.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to print a message...')
		    ->addArgument('message', InputArgument::REQUIRED, 'The message you would like to print.')
            ->addArgument('count', InputArgument::OPTIONAL, 'The number of times to print.')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Printing Message',
            '================',
            '',
        ]);

        // outputs a message without adding a "\n" at the end of the line
        $count = $input->getArgument('count') ?? 1;
        for ($i = 0; $i < $count; $i++) {
            $output->writeln($input->getArgument('message'));
        }
    }
}
