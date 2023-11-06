<?php

namespace JeffersonSimaoGoncalves\PhpGitflow;

class GitRepository
{
    public function __construct(private readonly string $repositoryPath, private readonly GitConfig $config = new GitConfig())
    {
    }

    public function getRepositoryPath(): string
    {
        return $this->repositoryPath;
    }

    public function getConfig(): GitConfig
    {
        return $this->config;
    }

    public function isInitialized(): bool
    {
        return \is_dir($this->repositoryPath . DIRECTORY_SEPARATOR . '.git');
    }
}
