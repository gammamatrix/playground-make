<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Concerns;

/**
 * \Playground\Make\Configuration\Concerns\WithFolder
 */
trait WithFolder
{
    public function folder(): string
    {
        return $this->folder;
    }

    public function setFolder(string $folder = ''): self
    {
        $this->folder = $folder;

        return $this;
    }
}
