<?php

namespace JeffersonSimaoGoncalves\PhpGitflow\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayInfo extends Command
{
    /**
     * The name of the command (the part after "bin/php-gitflow").
     *
     * @var string
     */
    protected static $defaultName = 'display-info';

    /**
     * The command description shown when running "php bin/php-gitflow list".
     *
     * @var string
     */
    protected static $defaultDescription = 'Mostrar as informações do git!';

    protected ?string $rootPath = null;

    public function setRootPath(string $rootPath): void
    {
        $this->rootPath = $rootPath;
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int 0 if everything went fine, or an exit code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        return Command::SUCCESS;
    }
}
