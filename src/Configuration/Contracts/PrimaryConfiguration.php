<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Contracts;

/**
 * \Playground\Make\Configuration\Contracts\PrimaryConfiguration
 */
interface PrimaryConfiguration
{
    public function class(): string;

    public function setClass(string $class): self;

    public function config(): string;

    public function setConfig(string $config): self;

    public function fqdn(): string;

    public function setFqdn(string $fqdn): self;

    /**
     * @return array<string, class-string>
     */
    public function implements(): array;

    public function model(): string;

    public function setModel(string $model): self;

    public function model_fqdn(): string;

    public function setModelFqdn(string $model_fqdn): self;

    /**
     * @return array<string, string>
     */
    public function models(): array;

    public function module(): string;

    public function setModule(string $module): self;

    public function module_slug(): string;

    public function setModuleSlug(string $module_slug): self;

    public function name(): string;

    public function setName(string $name): self;

    public function namespace(): string;

    public function setNamespace(string $namespace): self;

    public function organization(): string;

    public function setOrganization(string $organization): self;

    public function package(): string;

    public function setPackage(string $package): self;

    public function playground(): bool;

    public function type(): string;

    public function setType(string $type): self;

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

    /**
     * @return array<int, class-string>
     */
    public function uses(): array;

    public function extends_use(): string;
}
