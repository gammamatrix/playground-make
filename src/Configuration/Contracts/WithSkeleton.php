<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Contracts;

/**
 * \Playground\Make\Configuration\Contracts\WithSkeleton
 */
interface WithSkeleton
{
    public function withSkeleton(): self;

    public function skeleton(): bool;
}
