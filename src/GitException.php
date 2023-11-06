<?php

namespace JeffersonSimaoGoncalves\PhpGitflow;

use RuntimeException;
use Symfony\Component\Process\Process;
use function sprintf;

class GitException extends RuntimeException
{
    /**
     * The working directory path.
     *
     * @var string
     */
    protected $workingDirectory;

    /**
     * The executed command line.
     *
     * @var string
     */
    protected $commandLine;

    /**
     * The git commands standard output.
     *
     * @var string
     */
    protected $commandOutput;

    /**
     * The git commands error output.
     *
     * @var string
     */
    protected $errorOutput;

    /**
     * Create a new git exception.
     *
     * @param string $message The error message.
     *
     * @param string $workingDirectory The working directory.
     *
     * @param string $commandLine The used command line.
     *
     * @param string $commandOutput The command output.
     *
     * @param string $errorOutput The command error output.
     */
    public function __construct($message, $workingDirectory, $commandLine, $commandOutput, $errorOutput)
    {
        parent::__construct($message, 0, null);
        $this->workingDirectory = (string)$workingDirectory;
        $this->commandLine      = (string)$commandLine;
        $this->commandOutput    = (string)$commandOutput;
        $this->errorOutput      = (string)$errorOutput;
    }

    /**
     * Create new exception from process.
     *
     * @param string $message The message to use.
     *
     * @param Process $process The process to create the message from.
     *
     * @return static
     */
    public static function createFromProcess($message, Process $process)
    {
        return new static(sprintf('%s [%s]', $message, $process->getCommandLine()) . PHP_EOL . sprintf('work dir: %s', $process->getWorkingDirectory()) . PHP_EOL . $process->getErrorOutput(), $process->getWorkingDirectory(), $process->getCommandLine(), $process->getOutput(), $process->getErrorOutput());
    }

    /**
     * Return the command line to execute git.
     *
     * @return string
     */
    public function getCommandLine()
    {
        return $this->commandLine;
    }

    /**
     * Return the working directory git was executed in.
     *
     * @return string
     */
    public function getWorkingDirectory()
    {
        return $this->workingDirectory;
    }

    /**
     * Return the git commands error output.
     *
     * @return string
     */
    public function getErrorOutput()
    {
        return $this->errorOutput;
    }

    /**
     * Return the git commands standard output.
     *
     * @return string
     */
    public function getCommandOutput()
    {
        return $this->commandOutput;
    }
}
