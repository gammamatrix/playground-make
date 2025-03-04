<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Contracts;

/**
 * \Playground\Make\Configuration\Contracts\Configuration
 */
interface Configuration
{
    public function type(): string;

    public function apply(): self;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @return array<string, mixed>
     */
    public function properties(): array;

    /**
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options = []): self;
}
