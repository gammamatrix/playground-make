<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Contracts;

/**
 * \Playground\Make\Configuration\Contracts\WithFolder
 */
interface WithFolder
{
    public function folder(): string;

    public function setFolder(string $folder): self;
}
