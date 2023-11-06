<?php

namespace JeffersonSimaoGoncalves\PhpGitflow\Commands;

use JeffersonSimaoGoncalves\PhpGitflow\GitException;
use JeffersonSimaoGoncalves\PhpGitflow\GitRepository;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Process\Process;

trait CommandBuilderTrait
{
    private GitRepository $repository;
    private string        $workingDirectory;
    private array         $arguments = [];
    private ?string       $output    = null;

    public function setRepository(GitRepository $repository): void
    {
        $this->repository       = $repository;
        $this->workingDirectory = $repository->getRepositoryPath();
        $this->arguments[]      = $this->repository->getConfig()->getGitExecutablePath();
        $this->initializeProcessBuilder();
    }

    abstract protected function initializeProcessBuilder(): void;

    protected function runProcess(): ?string
    {
        $process = $this->buildProcess();

        if ($this->output !== null) {
            throw new GitException('Command cannot be executed twice', $process->getWorkingDirectory(), $process->getCommandLine(), $this->output, '');
        }

        $this->repository->getConfig()
                         ->getLogger()
                         ->debug(\sprintf('[ccabs-repository-git] exec [%s] %s', $this->workingDirectory, $process->getCommandLine()));

        $process->run();
        $this->output = $process->getOutput();
        $this->output = \rtrim($this->output, "\r\n");

        if (!$process->isSuccessful()) {
            throw GitException::createFromProcess('Could not execute git command', $process);
        }

        return $this->output;
    }

    protected function buildProcess(): Process
    {
        if (!\count($this->arguments)) {
            throw new LogicException('You must add command arguments before the process can build.');
        }

        return new Process($this->arguments, $this->workingDirectory);
    }

    public function getOutput(): ?string
    {
        return $this->output;
    }
}
