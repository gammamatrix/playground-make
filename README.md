# Playground: Make

[![Playground CI Workflow](https://github.com/gammamatrix/playground-make/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-make/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-make/testing/develop/coverage.svg)](tests)
[![PHPStan Level 9](https://img.shields.io/badge/PHPStan-level%209-brightgreen)](.github/workflows/ci.yml#L120)

The Playground Make Tool for building out [Laravel](https://laravel.com/docs/11.x) applications.

## Installation

**NOTE:** This is a development tool and not meant for normal installations.

## `artisan about`

Playground Make provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-make.png" alt="screenshot of artisan about command with Playground Make."> -->

## Configuration

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Playground\Make\ServiceProvider" --tag="playground-config"
```

See the contents of the published config file: [config/playground-make.php](config/playground-make.php)

## Commands

This application utilizes Laravel make commands.

## PHPStan

Tests at level 9 on:
- `config/`
- `lang/`
- `src/`
- `tests/Feature/`

```sh
composer analyse
```

## Coding Standards

```sh
composer format
```

## Testing

```sh
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Jeremy Postlethwaite](https://github.com/gammamatrix)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
