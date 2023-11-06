<?php

namespace JeffersonSimaoGoncalves\PhpGitflow\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DisplayInfo extends Command
{
    use CommandBuilderTrait;

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

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int 0 if everything went fine, or an exit code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$this->repository->isInitialized()) {
            $io->error('Não foi possível encontrar a pasta .git.');
            return Command::SUCCESS;
        }
        $result = $this->runProcess();
        if (str_contains($result, 'gitflow.branch.')) {
            $io->success('Git Flow está configurado.');
        } else {
            $io->error('Git Flow não está configurado.');
        }

        return Command::SUCCESS;
    }

    protected function initializeProcessBuilder(): void
    {
        $this->arguments[] = 'config';
        $this->arguments[] = '-l';
        $this->arguments[] = '--local';
    }
}
