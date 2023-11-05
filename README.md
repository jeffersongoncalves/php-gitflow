<h1 align="center">PHP CLI Gitflow</h1>

## Install

This CLI application is a small game written in PHP and is installed using [Composer](https://getcomposer.org):

```
composer global require jeffersonsimaogoncalves/php-gitflow
```

Make sure the `~/.composer/vendor/bin` directory is in your system's `PATH`.

<details>
<summary>Show me how</summary>

If it's not already there, add the following line to your Bash configuration file (usually `~/.bash_profile`, `~/.bashrc`, `~/.zshrc`, etc.):

```
export PATH=~/.composer/vendor/bin:$PATH
```

If the file doesn't exist, create it.

Run the following command on the file you've just updated for the change to take effect:

```
source ~/.bash_profile
```
</details>

## Use

[//]: # (All you need to do is call the `play` command to start the game:)

[//]: # ()
[//]: # (```)

[//]: # (demo play)

[//]: # (```)

## Update

```
composer global update jeffersonsimaogoncalves/php-gitflow
```

## Delete

```
composer global remove jeffersonsimaogoncalves/php-gitflow
```
