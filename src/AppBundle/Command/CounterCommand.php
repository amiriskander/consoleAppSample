<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CounterCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "app/console")
            ->setName('app:counter')

            // the short description shown while running "php app/console list"
            ->setDescription('Just Counts.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to count from zero to a number, showing a progress bar.')
            ->addArgument('count', InputArgument::OPTIONAL, 'The number of times to print.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Starting the counter',
            'Tick Tock Tick Tock',
            '--------------------',
            '',
        ]);

        // outputs a message without adding a "\n" at the end of the line
        $count = $input->getArgument('count') ?? 1;

        $progress = new ProgressBar($output, $count);

        $progress->setBarCharacter('+');
        $progress->setEmptyBarCharacter('-');

        $progress->start();

        $progress->setFormatDefinition('custom', ' %current%/%max% Wasting your time in progress - [%bar%] %percent%%');
        $progress->setFormat('custom');

        for ($i = 0; $i < $count; $i++) {
            // $progress->setMessage("count: $count");

            $progress->setMessage($i, 'current');
            $progress->setMessage($count, 'max');
            sleep(1);
            $progress->advance();
        }

        $progress->finish();

        $output->writeln([
            '',
            '',
            "Congratulations! You just wasted $count seconds :D",
            '',
        ]);
    }
}
