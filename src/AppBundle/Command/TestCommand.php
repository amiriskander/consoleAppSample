<?php

// src/AppBundle/Command/CreateUserCommand.php
namespace AppBundle\Command;

use Jstewmc\UspsAddress\UspsAddress;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class TestCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "app/console")
            ->setName('app:test')

            // the short description shown while running "php app/console list"
            ->setDescription('Test something.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to test some functionality ...')
            ->addArgument('param1', InputArgument::OPTIONAL, 'Parameter 1.')
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
        $param1 = $input->getArgument('param1');
        $address = new UspsAddress();
        $address->setStreet1('8614 Honley St');
        $address->setCity('San Antonio');
        $address->setState('Texas');
        $address->setZip('78254');
        dump($address);
        dump($address->getNorm());
        die;
    }
}
