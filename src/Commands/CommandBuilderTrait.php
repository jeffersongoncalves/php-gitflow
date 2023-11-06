<?php

namespace JeffersonSimaoGoncalves\PhpGitflow\Commands;

use JeffersonSimaoGoncalves\PhpGitflow\GitException;
use JeffersonSimaoGoncalves\PhpGitflow\GitRepository;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Process\Process;
use function count;
use function rtrim;
use function sprintf;

trait CommandBuilderTrait
{
    private GitRepository $repository;
    private string        $workingDirectory;
    private array         $arguments = [];

    public function setRepository(GitRepository $repository): void
    {
        $this->repository       = $repository;
        $this->workingDirectory = $repository->getRepositoryPath();
        $this->arguments[]      = $this->repository->getConfig()->getGitExecutablePath();
        $this->initializeProcessBuilder();
    }

    abstract protected function initializeProcessBuilder(): void;

    protected function runProcess(): string
    {
        $process = $this->buildProcess();

        $this->repository->getConfig()
                         ->getLogger()
                         ->debug(sprintf('[php-gitflow] exec [%s] %s', $this->workingDirectory, $process->getCommandLine()));

        $process->run();
        $output = $process->getOutput();
        $output = rtrim($output, "\r\n");

        if (!$process->isSuccessful()) {
            throw GitException::createFromProcess('Could not execute git command', $process);
        }

        return $output;
    }

    protected function buildProcess(): Process
    {
        if (!count($this->arguments)) {
            throw new LogicException('You must add command arguments before the process can build.');
        }

        return new Process($this->arguments, $this->workingDirectory);
    }
}
