<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Concerns;

/**
 * \Playground\Make\Configuration\Concerns\WithSkeleton
 */
trait WithSkeleton
{
    protected bool $skeleton = false;

    public function skeleton(): bool
    {
        return $this->skeleton;
    }

    public function withSkeleton(): self
    {
        $this->skeleton = true;

        return $this;
    }
}
