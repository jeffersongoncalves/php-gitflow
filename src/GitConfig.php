<?php

namespace JeffersonSimaoGoncalves\PhpGitflow;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class GitConfig
{
    protected string $gitExecutablePath = 'git';

    protected LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function getGitExecutablePath(): string
    {
        return $this->gitExecutablePath;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    public function setLogger(LoggerInterface $logger): static
    {
        $this->logger = $logger;

        return $this;
    }
}
