<?php

namespace JeffersonSimaoGoncalves\PhpGitflow;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class GitConfig
{
    protected string $gitExecutablePath = 'git';

    protected ?string $signCommitUser;

    protected ?string $signTagUser;

    protected LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function getGitExecutablePath(): string
    {
        return $this->gitExecutablePath;
    }

    public function setGitExecutablePath(string $gitExecutablePath): static
    {
        $this->gitExecutablePath = $gitExecutablePath;
        return $this;
    }

    public function enableSignCommits(string $signUser): static
    {
        $this->signCommitUser = (string)$signUser;
        return $this;
    }

    public function disableSignCommits(): static
    {
        $this->signCommitUser = null;
        return $this;
    }

    public function isSignCommitsEnabled(): bool
    {
        return (bool)$this->signCommitUser;
    }

    public function getSignCommitUser(): ?string
    {
        return $this->signCommitUser;
    }

    public function enableSignTags(string $signUser): static
    {
        $this->signTagUser = $signUser;
        return $this;
    }

    public function disableSignTags(): static
    {
        $this->signTagUser = null;
        return $this;
    }

    public function isSignTagsEnabled(): bool
    {
        return (bool)$this->signTagUser;
    }

    public function getSignTagUser(): ?string
    {
        return $this->signTagUser;
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
