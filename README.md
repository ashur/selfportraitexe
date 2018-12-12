# selfportrait.exe

Generate updates for [@selfportraitexe](https://twitter.com/selfportraitexe)

## Installation

Clone the repository along with its submodules:

```
$ git clone --recursive https://github.com/ashur/selfportraitexe.git
```

### Requirements

The following packages are required:

- `php7.0` (or newer)
- `imagemagick`
- `php-imagick`

### Setup

Configure the Git user name and email for commit history:

```
$ ./git-config.sh
```

## Usage

```
$ php generate.php
```

> 👻 Posting to Mastodon and Twitter relies on a separate tool, [ppppost](https://github.com/ashur/ppppost)

## Notes

This is an old project and a poor example of constructing a bot using PHP:

- Several old, abandoned dependencies broken up in weird ways
- Odd organization owing to its original implementation as a standalone command-line application

You would do well not to use this project as any sort of guide, except maybe as an example of how _not_ to build a bot.